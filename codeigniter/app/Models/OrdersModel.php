<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model{
    protected $table = 'Orders';
    protected $primaryKey = 'OrderId';

    protected $allowedFields = [
        'AddressId',
        'Delivery_choice',
        'CustomerId',
        'DeliveryDate',
        'DeliveryTime',
        'HasNotification'
    ];
 
    public function getShoppingCart($products){ 
        /*configure array*/
        $array = [];
        foreach($products as $productId){ 
            array_push($array, $productId['ProductId']);
        }
        if(count($array) != 0) {
            $db = \Config\Database::connect();
            $array = join(', ', $array);
            return $db->query("SELECT Products.ProductId, Title, ProductType, Price, Origin, B.Media_name 
                               FROM Products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B 
                               WHERE B.ProductId = Products.ProductId And Products.ProductId IN ($array)")->getResult();
        }
        return [];
    }

    public function getOrderLocationDate($customerId){
        $db = \Config\Database::connect();
        $orderData = $db->query("SELECT Street, Number, City, Postal_code, Country, Delivery_choice, DATE(Orders.Orderdate) as orderedOn, DeliveryDate, DeliveryTime, Orders.OrderId
                                FROM Orders
                                LEFT OUTER JOIN Address ON Address.AddressId = Orders.AddressId
                                WHERE CustomerId = $customerId")->getResult();
        return $orderData;
    }

    public function updateNotifications($customerId){
        $db = \Config\Database::connect();
        $db->query("UPDATE Orders SET HasNotification = 1 WHERE CustomerId = $customerId and DeliveryDate < CURRENT_TIMESTAMP");
    }
}