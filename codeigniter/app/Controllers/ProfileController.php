<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    /**
     * fetches the user data and passes it to view
     * @return the privateprofile page
     */
    public function viewProfile() 
    {
        $model = model(ProfileModel::class);
        $data = $model->findUserData(session('UserId'), session('isVendor'));
        return view('profile/privateprofile', $data);
    } 

    /** 
     * fetches the users past and present orders
     * @return the orders page with data
     */
    public function viewOrders() 
    {
        $model = model(OrdersModel::class);
        $data["AddressData"] = $model->getOrderLocationDate(session('UserId'));
        $productModel = model(ProductModel::class);
        $data["ProductData"] = $productModel->getOrderProducts(session('UserId'));
        return view('profile/orders', $data);
    }

    /** 
     * fetches the sellers' statistics
     * @return the orders with data
     */
    public function viewStatistics()
    {
        return view('profile/statistics');
    }

    public function askStatistics(){
        $statisticsModel = model(ProductStatisticsModel::class);
        echo json_encode(['stats' => $statisticsModel->getStatistics(session('UserId'))]);    
    }

    /**
     * fetches the sellers' active products
     * @return myproducts with active products data
     */
    public function viewMyProducts()
    {
        $productModel = model(ProductModel::class);
        $data['products'] = $productModel->getProductsOfSeller(session('UserId'));
        return view('profile/myproducts', $data);
    }
    
    /**
     * fetches the sellers' data
     * @pre $userId is a valid vendor
     * @return the $userId page with data
     */
    public function PublicProfile($userId){
        $model = model(ProfileModel::class);
        $data = $model->findUserData($userId, true);
        return view('profile/publicprofile', $data);
    }

    private function verifyPostValues($validator){
        $validation = \Config\Services::validation();
        if (!$validation->run($this->request->getPost(), $validator)){
            session()->setFlashData($validation->getErrors());
            return false;
        } 
        return true;
    }

    private function hasMimimumImages($imageModel){
        $mediaCount = $imageModel->getAmountOfMedia(session('UserId')); 
        if($mediaCount == 0 && !($this->request->getFiles()['images'][0]->isValid())){
            return false;
        }
        if(!($this->request->getFiles()['images'][0]->isValid())){
            if(!empty($this->request->getPost('delete_image'))){
                if($mediaCount == count($this->request->getPost('delete_image'))){
                    return false;
                }
            }
        }
        return true;
    }

    private function hasMaximumImages($imageModel){
        $mediaCount = $imageModel->getAmountOfMedia(session('UserId')); 
        if(($this->request->getFiles()['images'][0]->isValid())){ //we uploaden files
            if(!empty($this->request->getPost('delete_image'))){
                if($mediaCount + count($this->request->getFiles()['images']) - count($this->request->getPost('delete_image')) > 10){
                    return false;
                }
            } else {
                if($mediaCount + count($this->request->getFiles()['images']) > 10){
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * updates the users profile data and deletes old images from database and filesystem
     * @post the profile is updated
     * @return to profile page
     */
    public function updateProfile()
    { 
        if (!$this->verifyPostValues('validateProfile')){
            return redirect()->back();
        } 
        $imageModel = model(UserImageModel::class);
        if(!$this->hasMimimumImages($imageModel)){
            return redirect()->to("/profile/profile")->with('fail', "you're profile must have at least one image");
        }
        if(!$this->hasMaximumImages($imageModel)){
            return redirect()->to("/profile/profile")->with('fail', "profile can't have more than 10 images and/or videos");
        }
        $this->addProfileData();
        $this->addFiles($imageModel);
        $this->removeFiles($imageModel);

        return redirect()->to('/profile/profile')->with('success', 'Profile updated successfully');
    }

    private function addProfileData(){
        $dataModel = model(VendorModel::class);
        $data = [
            'Phone_number' => $this->request->getPost('new_phone_number'),
            'Description' => $this->request->getPost('new_description'),
            'Company' => $this->request->getPost('new_company'),
        ];
        $dataModel->insertData(session('UserId'), $data);
    }

    private function addFiles($imageModel){
        foreach($this->request->getFiles()['images'] as $file){
            if (is_uploaded_file($file)){
                if ($file->isValid() && ! $file->hasMoved()){
                    $filename = date("d-m-y h-i-s").$file->getRandomName();
                    $file->move('Profile_uploads/', $filename);

                    $data = [
                        'UserId' => session('UserId'),
                        'Media_name' => $filename,
                    ];

                    $imageModel->insert($data);
                } else {
                    return redirect()->to('/profile/profile')->with('fail', 'Something went wrong, please try again');
                } 
            }
        }
    }

    private function removeFiles($imageModel){
        if (!empty($this->request->getPost('delete_image'))){
            foreach ($this->request->getPost('delete_image') as $imageDelete){
                $imageModel->where('Media_name', $imageDelete)->delete();
            }
 
            //remove files from folder
            foreach ($this->request->getPost('delete_image') as $imageDelete){
                if(file_exists('Profile_uploads/'.$imageDelete)){
                    unlink('Profile_uploads/'.$imageDelete);
                }
            }
        }
    }
}  