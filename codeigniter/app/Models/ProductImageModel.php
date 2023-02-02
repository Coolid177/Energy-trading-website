<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model{
    protected $table = 'Product_media';

    protected $allowedFields = [
        'ProductId',
        'Media_name',
    ];

    public function getAmountOfMedia($productId){
        $db = \Config\Database::connect();
        return $db->query("SELECT COUNT(Media_name) as amount
                           FROM Product_media
                           WHERE ProductId = $productId")->getResult()[0]->amount;
    }
} 