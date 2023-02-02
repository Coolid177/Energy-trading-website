<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductStatisticsModel extends Model{ 
    protected $table = 'Product_statistics';
    protected $primaryKey = 'ProductId';
    protected $allowedFields = [
        'ProductId',
        'ProductVisits',
        'ProductSolds',
        'ProductRevenue',
        'OwnerId'
    ];

    public function incrementVisits($product){
        $db = \Config\Database::connect();
        $db->query("UPDATE Product_statistics SET ProductVisits = ProductVisits + 1 WHERE ProductId = $product");
        return;
    }

    public function decreaseRevenueAndQuantity($productId, $price, $quantity){
        $db = \Config\Database::connect();
        $revenue = $price[0]*$quantity;
        $db->query("UPDATE Product_statistics 
                    SET ProductRevenue = ProductRevenue - $revenue, ProductSolds = ProductSolds - $quantity 
                    WHERE ProductId = $productId");
        return;
    }

    public function increaseRevenueAndQuantity($productId, $price, $quantity){
        $db = \Config\Database::connect();
        $revenue = $price[0]*$quantity;
        $db->query("UPDATE Product_statistics 
                    SET ProductRevenue = ProductRevenue + $revenue, ProductSolds = ProductSolds + $quantity 
                    WHERE ProductId = $productId");
        return;
    }

    public function getStatistics($userId){
        $db = \Config\Database::connect();
        return $db->query("SELECT ProductVisits, ProductSolds, ProductRevenue, Title FROM Product_statistics, Products WHERE OwnerId = $userId AND Products.ProductId = Product_statistics.ProductId")->getResult();
    }
}