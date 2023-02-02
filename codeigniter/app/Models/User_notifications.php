<?php

namespace App\Models;

use CodeIgniter\Model;

class User_notifications extends Model{
    protected $table = 'User_notifications';
    protected $allowedFields = [
        'UserId',
        'Time',
        'TypeOfNotification',
        'ProductId'
    ];

    public function getNotifications($userId){
        $db = \Config\Database::connect();
        return $db->query("SELECT Time, TypeOfNotification, Title, User_notifications.ProductId, B.Media_name FROM User_notifications, Products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B WHERE UserId = $userId AND Products.ProductId = User_notifications.ProductId AND B.productId = Products.ProductId")->getResult();
    }

    public function getProductReviewNotification($userId){
        $db = \Config\Database::connect();
        return $db->query("SELECT Ordered_products.ProductId
                            FROM Ordered_products, Orders
                            WHERE Orders.OrderId = Ordered_products.OrderId AND CustomerId = $userId AND DeliveryDate <= CURRENT_TIMESTAMP and HasNotification = 0")->getResult();
    }

    public function sendNotification($productId){
        $productNotficationModel = model(Product_notification::class);
        foreach ($productNotficationModel->getUserNotifications($productId) as $user){
            $data = [
                'UserId' => $user->UserId,
                'TypeOfNotification' => 'Product',
                'ProductId' => $productId
            ];
            $this->insert($data);
            $productNotficationModel->where('UserId', $user->UserId)->where('ProductId', $productId)->delete();
        }
    }
}

