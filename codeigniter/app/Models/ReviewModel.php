<?php 

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model{
    protected $table = 'Reviews';
    protected $primaryKey = 'ReviewId';

    protected $allowedFields = [
        'ProductId',
        'ReviewerId',
        'Title',
        'Description',
        'Rating',
    ];

    public function getReviews($ProductId){
        $db = \Config\Database::connect();
        $userId = $_SESSION['UserId'];
        $data ['userReview'] = $db->query("SELECT Title, Description, ReviewerId, DATE_FORMAT(Date, '%d/%m/%y') as Date, Rating, Fname, Lname 
                                            FROM Users, Reviews 
                                            WHERE Reviews.ReviewerId = Users.UserId AND ProductId =  $ProductId and Users.UserId = $userId")->getResult(); 
        $data['reviews'] = $db->query("SELECT Title, Description, ReviewerId, DATE_FORMAT(Date, '%d/%m/%y') as Date, Rating, Fname, Lname 
                                        FROM Users, Reviews 
                                        WHERE Reviews.ReviewerId = Users.UserId AND ProductId =  $ProductId and Users.UserId <> $userId")->getResult();
        return $data;
    }

    public function canUserLeaveReview($ProductId){
        $db = \Config\Database::connect();
        $userId = $_SESSION['UserId'];
        return $db->query("SELECT ($ProductId in 
                            (SELECT ProductId
                            FROM Orders, Ordered_products
                            WHERE Orders.OrderId = Ordered_products.OrderId and Orders.DeliveryDate < CURRENT_DATE() and Orders.CustomerId = $userId)) as canUserLeaveReview")->getResult();
    }
}