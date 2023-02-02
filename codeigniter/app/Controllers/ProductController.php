<?php
namespace App\Controllers;

use App\Models\ProductsModel;

class ProductController extends BaseController
{ 
    /**
     * @return the product creation page
     */
    public function viewCreate(){
        return view('profile/createproduct');
    }

    /**
     * get all products 
     * @return products page with list of all products 
     */
    public function products(){
        $model = model(ProductModel::class);
        $data['items'] = $model->getProducts();
        return view('product/products', $data);
    }
 
    /**
     * filters a product based on criteria
     * @post returned products met the users criteria
     * @return products
     */
    public function filterProducts(){
        $model = model(ProductModel::class);
        $data['items'] = $model->filterProducts($_GET);
        return view('product/products', $data);
    }

    /**
     * @post all products match $this->request->getPost('search') string value
     * @return products that match the search request
     */
    public function searchProducts(){
        $model = model(ProductModel::class);
        $data['items'] = $model->SearchProducts($this->request->getPost('search'));
        return view('product/products', $data);
    }

    /**
     * updates the review a user posted on product with $productId
     * @param $productId the product to update the review on
     * @return redirect to the product page
     */
    public function updateReview($productId){
        if(!$this->verifyPostValues('validateReview')){
            return redirect()->to("/product/$productId");
        }   
        $data = [
            'Description' => $this->request->getPost('Description'),
            'Title' => $this->request->getPost('Title'),
            'Rating' => $this->request->getPost('Stars'),
        ];
        $reviewModel = model(ReviewModel::class);
        $reviewModel->where('ProductId', $productId)->where('ReviewerId', session('UserId'))->set($data)->update();
        return redirect()->back();
    }

    /**
     * stores a review to the database
     * @return the /product/$productId page with a status message
     */
    public function storeReview($productId){
        if(!$this->verifyPostValues('validateReview')){
            return redirect()->to("/product/$productId");
        }   
        
        $model = model(ReviewModel::class);
        $data = [
            'ProductId' => $productId,
            'ReviewerId' => session('UserId'),
            'Title' => $this->request->getPost('Title'),
            'Description' => $this->request->getPost('Description'),
            'Rating' => $this->request->getPost('Stars')
        ]; 
        $model->insert($data);
        return redirect()->to("/product/$productId")->with('status', 'Review saved successfully');
    }

    /**
     * displays the product page of $productId
     * @param $productId the products ID that needs to be display
     * @pre $productId is a valid product
     * @post the data passed to the view is of $productId
     * @return $productIds product details
     */
    public function product($productId){
        $productStatisticsModel = model(ProductStatisticsModel::class);
        $productStatisticsModel->incrementVisits($productId);
        $dataModel = model(ProductModel::class);
        $data['product'] = $dataModel->getProduct($productId);
        $imageModel = model(ProductImageModel::class);
        $data['images'] = $imageModel->where('ProductId', $productId)->findColumn('Media_name');
        $reviewModel = model(ReviewModel::class);
        $reviews = $reviewModel->getReviews($productId);
        $data['reviews'] = $reviews['reviews'];
        $data['userReview'] = $reviews['userReview'];
        if($data['product'][0]->Quantity == 0){
            $productNotificationModel = model(Product_notification::class);
            $data['notification'] = $productNotificationModel->where('UserId', session('UserId'))->where('ProductId', $productId)->first();
        }
        if(empty($data['userReview'])){
            $data['canUserLeaveReview'] = $reviewModel->canUserLeaveReview($productId);
        }
        return view('product/product', $data);
    }

    /**
     * displays the editProduct page with the products current data
     * @param $productId the product
     * @pre $productId is a product owned by session('UserId');
     * @post the data passed to view is from $productId
     */
    public function editProductView($productId){
        $dataModel = model(ProductModel::class);
        $sellerId = $dataModel->where('ProductId', $productId)->findColumn('SellerId');
        if ($sellerId[0] != session('UserId')){
            return redirect()->to('/home');
        }
        $data['product'] = $dataModel->getProductOverview($productId);
        $data['product'][0]->ProductId = $productId;
        $imageModel = model(ProductImageModel::class);
        $data['images'] = $imageModel->where('ProductId', $productId)->findColumn('Media_name');
        return view('profile/editProduct', $data);
    }

    /**
     * deletes a product from the users products
     * @pre $productId is a product owned by session('UserId');
     * @post the product is deleted
     */
    public function deleteProduct($productId){
        $dataModel = model(ProductModel::class);
        $sellerId = $dataModel->where('ProductId', $productId)->findColumn('SellerId');
        if ($sellerId[0] == session('UserId')){            
            $dataModel->whereIn('ProductId', [$productId])->set(['IsActive' => 0])->update();
            return redirect()->to('/profile/myproducts')->with('status', 'product successfully deleted!');
        } 
        return redirect()->to('/home');
    }

    /**
     * updates a product  
     * @pre $productId is a product owned by session('UserId');
     * @post the product is updated
     * @return myproducts page with success or error message
     */
    public function updateProduct($productId){
        if(!$this->verifyPostValues('editProduct')){
            return redirect()->to("/profile/myProducts/edit/$productId");
        }   
        //minimum files
        if(!$this->verifyMinUpdateImages($productId)){
            return redirect()->to("/profile/myProducts/edit/$productId")->with('failed', 'product must have at least one image or video');
        }
        //maximum files
        if(!$this->verifyMaxUpdateImages($productId)){
            return redirect()->to("/profile/myProducts/edit/$productId")->with('failed', "product can't have more than 10 images and/or videos");
        }
        //update product data
        $this->updateProductData($productId);
        //send notifications that stock is back
        $this->sendStockNotifications($productId);
        //add new files to database
        $files = $this->request->getFiles();
        $this->saveProductImages($files, $productId);
        //delete old files in database
        $this->deleteOldFiles();
        return redirect()->to('/profile/myproducts')->with('status', 'product succesfully updated');
    }

    /**
     * stores a product to the database
     * @post the product is stored in the database
     * @return 
     */
    public function store() { 
        if(!$this->verifyPostValues('product')){
            return redirect()->to('/profile/create_product');
        }        
        /* check the file upload */        
        $files = $this->request->getFiles(); 
        if (count($files) > 10){
            return redirect()->to('/profile/create_product')->with('error', 'You are uploading to many files. Please upload less than 10 files');
        }
        //database insertion
        $primaryKey = $this->saveProductData();
        //insert images
        if (!$this->saveProductImages($files, $primaryKey)){
            return redirect()->to('/profile/create_product')->with('failed', 'Something went wrong, please try again');
        }
        //create the product statistics
        $this->createProductStatistics($primaryKey);
        return redirect()->to('/profile/create_product')->with('succes', 'product added succesfully');
    } 

    private function verifyPostValues($validator){
        $validation = \Config\Services::validation();
        if (!$validation->run($this->request->getPost(), $validator)){
            session()->setFlashData($validation->getErrors());
            return false;
        } 
        return true;
    }

    private function createProductStatistics($primaryKey){
        $productStatisticsModel = model(ProductStatisticsModel::class);
        $data = [
            'ProductId' => $primaryKey,
            'OwnerId' => session('UserId')
        ];
        $productStatisticsModel->insert($data);
    }

    private function saveProductData(){
        $model = model(ProductModel::class);
        $data = [
            'Title' => $this->request->getPost('title'),
            'Price' => $this->request->getPost('price'),
            'ProductType' => $this->request->getPost('type'),
            'Description' => $this->request->getPost('description'),
            'Origin' => $this->request->getPost('origin'),
            'Quantity' => $this->request->getPost('quantity'),
            'SellerId' => session()->get('UserId')
        ];
        return $model->insert($data);
    }

    private function updateProductData($productId){
        $dataModel = model(ProductModel::class);
        $data = [
            'Title' => $this->request->getPost('title'),
            'Price' => $this->request->getPost('price'),
            'ProductType' => $this->request->getPost('type'),
            'Description' => $this->request->getPost('description'),
            'Origin' => $this->request->getPost('origin'),
            'Quantity' => $this->request->getPost('quantity'),
            'SellerId' => session()->get('UserId'),
        ];
        $dataModel->update($productId, $data); //update database data
    }

    private function saveProductImages($files, $productId){
        $imageModel = model(ProductImageModel::class);
        foreach($files['images'] as $file){
            if (is_uploaded_file($file) && $file->isValid() && ! $file->hasMoved()){
                $filename = date("d-m-y h-i-s").$file->getRandomName();
                $file->move('Product_uploads/', $filename);
                $data = [
                    'ProductId' => $productId,
                    'Media_name' => $filename,
                ];
                $imageModel->insert($data);
            } else {
                return false;
            } 
        }
        return true;
    }

    private function verifyMaxUpdateImages($productId){
        $imageModel = model(ProductImageModel::class);
        if(($this->request->getFiles()['images'][0]->isValid())){
            if(!empty($this->request->getPost('delete_image'))){
                if(($imageModel->getAmountOfMedia($productId) + count($this->request->getFiles()['images']) - count($this->request->getPost('delete_image'))) > 10){
                    return false;
                }
            } else {
                if(($imageModel->getAmountOfMedia($productId) + count($this->request->getFiles()['images'])) > 10){
                    return false;
                }
            }
        }
        return true;
    }
    private function verifyMinUpdateImages($productId){
        $imageModel = model(ProductImageModel::class);
        if(!($this->request->getFiles()['images'][0]->isValid())){
            if(!empty($this->request->getPost('delete_image'))){
                if($imageModel->getAmountOfMedia($productId) == count($this->request->getPost('delete_image'))){
                    return false;
                }
            }
        }
        return true;
    }

    private function sendStockNotifications($productId){
        if($this->request->getPost('quantity') > 0){
            $userNotificationsModel = model(User_notifications::class);
            $userNotificationsModel->sendNotification($productId);
        }
    }

    private function deleteOldFiles(){
        $imageModel = model(ProductImageModel::class);
        if (!empty($this->request->getPost('delete_image'))){
            foreach ($this->request->getPost('delete_image') as $imageDelete){
                $imageModel->where('Media_name', $imageDelete)->delete();
            }

            //remove files from folder
            foreach ($this->request->getPost('delete_image') as $imageDelete){
                if(file_exists('Product_uploads/'.$imageDelete)){
                    unlink('Product_uploads/'.$imageDelete);
                }
            }
        }
    }
}
