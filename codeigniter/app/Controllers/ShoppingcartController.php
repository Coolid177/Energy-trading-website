<?php

namespace App\Controllers;

class ShoppingcartController extends BaseController
{
    /**
     * sets the product to a new value
     */
    public function incrementProduct() {
        for($i = 0; $i < count(session('ShoppingCart')); $i++){
            if(session('ShoppingCart')[$i]['ProductId'] == $this->request->getPost('productId')){
                if($this->request->getPost('quantity') == 0){
                    unset($_SESSION['ShoppingCart'][$i]);
                    $_SESSION['ShoppingCart'] = array_values($_SESSION['ShoppingCart']);
                    return;
                }
                $_SESSION['ShoppingCart'][$i]['Quantity'] = $this->request->getPost('quantity');
                return;
            }
        }
    }

    /** 
     * fetches the users shoppingcart items' data
     * @return the shoppingcart with items
     */ 
    public function viewShoppingcart(){
        $model = model(OrdersModel::class);
        $data['items'] = $model->getShoppingCart(session('ShoppingCart'));
        return view('shoppingcart/shoppingcart', $data);
    }
 
    /**
     * adds a product to the users shopping cart
     */
    public function addProduct(){
        for($i = 0; $i < count(session('ShoppingCart')); $i++){
            if(session('ShoppingCart')[$i]['ProductId'] == $this->request->getPost('productId')){
                $_SESSION['ShoppingCart'][$i]['Quantity']++;
                return redirect()->to('/shoppingcart');
            }
        }

        array_push($_SESSION['ShoppingCart'], array(
            'ProductId' => $this->request->getPost('productId'), 
            'Quantity' => 1));
        return redirect()->to('/shoppingcart');
    }

    private function sendNotifications($availableQuantity, $productId){
        if($availableQuantity == 0){
            $userNotificationsModel = model(User_notifications::class);
            $userNotificationsModel->sendNotification($productId);
        }
    }

    /**
     * cancels an order
     */
    public function removeOrder(){
        $Ordered_ProductsModel = model(Ordered_productsModel::class);
        $productModel = model(ProductModel::class);
        $productStatisticsModel = model(ProductStatisticsModel::class);

        $products = $Ordered_ProductsModel->select('ProductId')->select('Quantity')->select('Price_per_item')->where('OrderId', $this->request->getPost('orderId'))->findAll();

        $quantityAvailable = $productModel->getAvailableQuantity($products);
        
        for($item = 0; $item < count($products); $item++){
            //send notifications to users who wanted to buy it as well
            $this->sendNotifications($quantityAvailable[$item]->Quantity, $products[$item]['ProductId']);

            //add products quantity to database
            $data = [
                'Quantity' => $products[$item]['Quantity'] + $quantityAvailable[$item]->Quantity,
            ];
            $productModel->update($products[$item]['ProductId'], $data);
            //update product statistics
            $productStatisticsModel->decreaseRevenueAndQuantity($products[$item]['ProductId'], $products[$item]['Price_per_item'], $products[$item]['Quantity']);
        }

        $orderModel = model(OrdersModel::class);
        $AddressModel = model(AddressModel::class);

        //remove orderId's
        $orderModel->delete($this->request->getPost('orderId'));
        $AddressModel->delete($this->request->getPost('orderId'));
        return redirect()->back();
    }

    private function updateOrderAndRevenue($productModel, $primaryKey){
        $orderedProductsModel = model(Ordered_productsModel::class);
        $productStatisticsModel = model(ProductStatisticsModel::class);
        foreach(session('ShoppingCart') as $item){
            //save products belonging to order
            $price_per_item = $productModel->where('ProductId', $item['ProductId'])->findColumn('Price');
            $data = [
                'Price_per_item' => $price_per_item,
                'Quantity' => $item['Quantity'],
                'ProductId' => $item['ProductId'],
                'OrderId' => $primaryKey,
            ];
            $orderedProductsModel->insert($data);

            //increase product revenue
            $productStatisticsModel->increaseRevenueAndQuantity($item['ProductId'], $price_per_item, $item['Quantity']);
        }
    }

    /**
     * remove a product from shopping cart
    */
    public function removeProduct(){
        for ($i = 0; $i < count(session('ShoppingCart')); $i++){
            if (session('ShoppingCart')[$i]['ProductId'] == $this->request->getPost('productId')){
                unset($_SESSION['ShoppingCart'][$i]);
                return redirect()->back();
            }
        } 
    }

    private function verifyPostValues($validator){
        $validation = \Config\Services::validation();
        if (!$validation->run($this->request->getPost(), $validator)){
            session()->setFlashData($validation->getErrors());
            return false;
        } 
        return true;
    } 

    private function checkProductAvailability($quantity){
        $quantityShortage = [];
        $removed = [];
        for ($product = 0; $product < count($quantity); $product++){
            if ($quantity[$product]->ProductId == session('ShoppingCart')[$product]['ProductId'] && $quantity[$product]->Quantity < session('ShoppingCart')[$product]['Quantity']){
                array_push($quantityShortage, array(
                    'ProductName' => $quantity[$product]->ProductId,
                    'Quantity' => $quantity[$product]->Quantity
                ));
            }
            if($quantity[$product]->IsActive == 0){
                array_push($removed, array(
                    'ProductName' => $quantity[$product]->ProductId
                ));
            }
        }
        return [
            'QuantityShortage' => $quantityShortage,
            'Removed' => $removed
        ];
    }

    private function handleRemovedItems($removed, $productModel){
        if(!empty($removed)){
            for($removedItem = 0; $removedItem < count($removed); $removedItem++){
                for ($productItem = 0; $productItem < count(session('ShoppingCart')); $productItem++){
                    if($removed[$removedItem]['ProductName'] == session('ShoppingCart')[$productItem]['ProductId']){
                        unset($_SESSION['ShoppingCart'][$productItem]);
                        $_SESSION['ShoppingCart'] = array_values($_SESSION['ShoppingCart']);
                    }
                }
            }
            $productNames = $productModel->getProductNames($removed);
            for ($index = 0; $index < count($productNames); $index++){
                $removed[$index]['ProductName'] = $productNames[$index]->Title;
            }
            session()->setFlashData('noLongerAvailable', $removed);
            return false;
        }
        return true;
    }

    private function handleQuantityShortage($quantityShortage, $productModel){
        if(!empty($quantityShortage)){
            $productNames = $productModel->getProductNames($quantityShortage);
            for ($index = 0; $index < count($productNames); $index++){
                $quantityShortage[$index]['ProductName'] = $productNames[$index]->Title;
            }
            session()->setFlashData('errors',$quantityShortage);
            return false;
        }
        return true;
    }

    /** 
     * places an order
     */ 
    public function placeOrder(){
        //verify user address input

        if($this->request->getPost('deliver_option') == 'Delivery' && !$this->verifyPostValues('orderDelivery')){ 
            return redirect()->back();
        } else if (!$this->verifyPostValues('orderCollect')){
            return redirect()->back();
        }

        //check if enough products are in storage
        $productModel = model(ProductModel::class);
        $quantity = $productModel->getProductsAvailability(session('ShoppingCart'));
        $problems = $this->checkProductAvailability($quantity);
        if(!$this->handleRemovedItems($problems['Removed'], $productModel)){
            return redirect()->to('/shoppingcart');
        }
        if(!$this->handleQuantityShortage($problems['QuantityShortage'], $productModel)){
            return redirect()->to('/shoppingcart');
        }

        $AddressPrimaryKey = NULL;
        if($this->request->getPost('deliver_option') == 'Delivery'){
            $AddressPrimaryKey = $this->saveAddressData();
        }

        $OrderedProductsPrimaryKey = $this->saveOrderData($AddressPrimaryKey);

        $this->updateOrderAndRevenue($productModel, $OrderedProductsPrimaryKey);
        
        $this->removeAvailableQuantity($quantity, $productModel);
        //reset shoppingcart
        $_SESSION['ShoppingCart'] = array();
        return redirect()->to('/profile/orders')->with('success', 'Order placed succesfully');
    }


    private function removeAvailableQuantity($quantity, $productModel){
        //remove products quantity from database
        for($item = 0; $item < count(session('ShoppingCart')); $item++){
            $data = [
                'Quantity' => $quantity[$item]->Quantity - session('ShoppingCart')["$item"]["Quantity"],
            ];
            $productModel->update(session('ShoppingCart')["$item"]['ProductId'], $data);
        }
    }

    private function saveAddressData(){
        //save address data
        if($this->request->getPost('deliver_option') == 'Delivery'){
            $data = [
                'Street' => $this->request->getPost('street'),
                'Number' => $this->request->getPost('number'),
                'City' => $this->request->getPost('city'),
                'Postal_code' => $this->request->getPost('postal_code'),
                'Country' => $this->request->getPost('country')
            ];
            $addressmodel = model(AddressModel::class);
            return $addressmodel->insert($data);
        }
        return NULL;
    }
    private function saveOrderData($AddressPrimaryKey){
        $data = [
            'AddressId' => $AddressPrimaryKey,
            'Delivery_choice' => $this->request->getPost('deliver_option'),
            'CustomerId' => session('UserId'),
            'DeliveryDate' => $this->request->getPost('date_of_delivery'),
            'DeliveryTime' => $this->request->getPost('delivery_time')
        ];
        $OrderModels = model(OrdersModel::class);
        return $OrderModels->insert($data);
    }
} 