<?php

namespace App\Models;

use CodeIgniter\Model;

class Product_notification extends Model{
    protected $table = 'Product_notification';
    protected $allowedFields = [
        'UserId',
        'ProductId'
    ];
    
    public function getUserNotifications($productId){
        $db = \Config\Database::connect();
        return $db->query("SELECT UserId FROM Product_notification WHERE ProductId = $productId")->getResult();
    }
}

 