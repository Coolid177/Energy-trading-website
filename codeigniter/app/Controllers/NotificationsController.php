<?php

namespace App\Controllers;

use App\Models\UsersModel;

class NotificationsController extends BaseController
{
    /**
     * adds a product notification for the user
     */
    public function addNotification(){
        $productNotificationModel = model(Product_notification::class);
        //does the notification exist?
        if(empty($productNotificationModel->where('UserId', session('UserId'))->where('ProductId', $this->request->getPost('productId'))->first())){ //no
            $data = [
                'UserId' => session('UserId'),
                'ProductId' => $this->request->getPost('productId')
            ];
            $productNotificationModel->insert($data);
        } else { //yes
            $productNotificationModel->where('UserId', session('UserId'))->where('ProductId', $this->request->getPost('productId'))->delete();
        }                             
        return redirect()->back();
    }

    /**
     * @return the notification view with notifications
     */
    public function viewNotifications()
    {
        //check which products need a review notification
        $userNotificationsModel = model(User_notifications::class);
        $productIds = $userNotificationsModel->getProductReviewNotification(session('UserId'));
        foreach($productIds as $productId){
            //send user a notification
            $notification = [
                'UserId' => session('UserId'),
                'TypeOfNotification' => 'Review',
                'ProductId' => $productId->ProductId
            ];
            $userNotificationsModel->insert($notification);
        }
        if(!empty($productIds)){
            $orderModel = model(OrdersModel::class);
            $orderModel->updateNotifications(session('UserId'));
        }
        $data["notifications"] = $userNotificationsModel->getNotifications(session('UserId'));
        return view('profile/notifications', $data);
    }
}