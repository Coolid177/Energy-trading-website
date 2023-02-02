<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    protected $table = 'Products';
    protected $primaryKey = 'ProductId';

    protected $allowedFields = [
        'SellerId',
        'Title',
        'ProductType',
        'Description',
        'Price',
        'Origin',
        'Quantity',
        'IsActive'
    ];

    public function getProductNames($products){
        /*configure array*/
        $array = [];
        foreach($products as $productId){
            array_push($array, $productId['ProductName']);
        }
        if(count($array) != 0) {
            $db = \Config\Database::connect();
            $array = join(', ', $array);
            return $db->query("SELECT Title
                               FROM Products
                               WHERE Products.ProductId IN ($array)")->getResult();
        }
        return [];
    }

    public function getAvailableQuantity($products){
        $array = [];
        foreach($products as $productId){
            array_push($array, $productId['ProductId']);
        }
        $db = \Config\Database::connect();
        $array = join(', ', $array); 
        return $db->query("SELECT ProductId, Quantity
                           FROM Products 
                           WHERE Products.ProductId IN ($array)")->getResult();
    }

    public function getProductsAvailability($products){
        $array = [];
        foreach($products as $productId){
            array_push($array, $productId['ProductId']);
        }
        $db = \Config\Database::connect();
        $array = join(', ', $array); 
        return $db->query("SELECT ProductId, Quantity, IsActive
                           FROM Products 
                           WHERE Products.ProductId IN ($array)")->getResult();
    }
 
    public function getOrderProducts($customerId){
        $db = \Config\Database::connect();
        $orders = $db->query("SELECT OrderId 
                              FROM Orders 
                              WHERE CustomerId = $customerId")->getResult();

        /* fetching all products for each order */
        $productData = [];
        foreach($orders as $order){
            array_push($productData, $db->query("SELECT Title, ProductType, Price, Origin, B.Media_name, Ordered_products.Quantity, Ordered_products.Price_per_item, Products.ProductId
                                                 FROM Products, Orders, Ordered_products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B 
                                                 WHERE B.ProductId = Products.ProductId AND B.ProductId = Ordered_products.ProductId AND Ordered_products.OrderId = Orders.OrderId AND Orders.CustomerId = $customerId AND Orders.OrderId = $order->OrderId")->getResult());
        }
        return $productData;
    }

    /**
     * searches the database for a string match with $search
     */
    public function searchProducts($search){
        $db = \Config\Database::connect();
        return $db->query("SELECT Products.ProductId, Title, ProductType, Price, Origin, B.Media_name AS Media_name, Quantity 
                           FROM Products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B 
                           WHERE IsActive = 1 and B.ProductId = Products.ProductId AND Title like '%$search%'")->getResult();
    }

    public function getProduct($productId){
        $db = \Config\Database::connect();
        return $db->query("SELECT ProductId, Users.UserId AS VendorId, Users.Fname AS VendorFname, Users.Lname AS VendorLname, Title, ProductType, Price, Origin, Description, Quantity, IsActive
                           FROM Products, Users 
                           WHERE Users.UserId = Products.SellerId AND Products.ProductId = $productId")->getResult();
    }

    public function getProducts(){
        $db = \Config\Database::connect();
        return $db->query("SELECT Products.ProductId, Title, ProductType, Price, Origin, Quantity, B.Media_name
                           FROM Products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B 
                           WHERE B.ProductId = Products.ProductId and IsActive = 1")->getResult();
    }

    public function getProductOverview($productId){
        $db = \Config\Database::connect();
        return $db->query("SELECT Products.ProductId, Title, ProductType, Price, Origin, Description, Quantity 
                           FROM Products, Users 
                           WHERE Users.UserId = Products.SellerId AND Products.ProductId = $productId")->getResult();
    } 

    public function getProductsOfSeller($sellerId){
        $db = \Config\Database::connect();
        return $db->query("SELECT Products.ProductId, Title, ProductType, Description, Price, Origin, Quantity 
                           FROM Products 
                           WHERE Products.SellerId = $sellerId and IsActive = 1")->getResult();
    }

    public function filterProducts($criteria){
        $allowedTypes = [];
        if(!isset($criteria['gas']) && !isset($criteria['oil']) && !isset($criteria['wood']) && !isset($criteria['sharingEnergy'])){
            array_push($allowedTypes, 'Aardgas', 'Biogas', 'Butaan', 'Propaan', 'Aardolie', 'Synthetische olie', 'Pellets', 'Briketten', 'Brandhout', 'Deelbare energie');
        }
        if(isset($criteria['gas'])){
            if(isset($criteria['aardgas']))
                array_push($allowedTypes, 'Aardgas');
            if(isset($criteria['biogas']))
                array_push($allowedTypes, 'Biogas');
            if(isset($criteria['butaan']))
                array_push($allowedTypes, 'Butaan');
            if(isset($criteria['propaan']))
                array_push($allowedTypes, 'Propaan');
        }
        if(isset($criteria['oil'])){
            if(isset($criteria['aardolie']))
                array_push($allowedTypes, 'Aardolie');
            if(isset($criteria['synthetische_olie']))
                array_push($allowedTypes,'Synthetische olie');
        }
        if(isset($criteria['wood'])){
            if(isset($criteria['pellets']))
                array_push($allowedTypes, 'Pellets');
            if(isset($criteria['briketten']))
                array_push($allowedTypes,'Briketten');
            if(isset($criteria['brandhout']))
                array_push($allowedTypes,'Brandhout');
        }
        if(isset($criteria['sharingEnergy'])){
            array_push($allowedTypes, 'Deelbare energie');
        }
        $allowedTypes = join("', '", $allowedTypes);
        $query = "SELECT Products.ProductId, Title, ProductType, Price, Origin, Quantity, B.Media_name 
                  FROM Products, (SELECT ProductId, Media_name FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY ProductId ORDER BY (SELECT NULL)) rn FROM Product_media) A WHERE rn = 1) as B 
                  WHERE B.ProductId = Products.ProductId and IsActive = 1 AND ProductType IN ('$allowedTypes')";
        if (isset($criteria['max_price']) && $criteria['max_price'] != ''){
            $query = $query." and price < ".$criteria['max_price'];
        } 
        if (isset($criteria['supply'])){
            $query .= " and Quantity > 0";
        }
        $db = \Config\Database::connect();
        return $db->query($query)->getResult();
    }
}