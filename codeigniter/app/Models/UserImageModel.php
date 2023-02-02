<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserImageModel extends Model{
    protected $table = 'User_media';

    protected $allowedFields = [
        'UserId',
        'Media_name',
    ];

    public function getAmountOfMedia($userId){
        $db = \Config\Database::connect();
        return $db->query("SELECT COUNT(UserId) as amount
                            FROM User_media
                            WHERE UserId = $userId")->getResult()[0]->amount;
    }
} 