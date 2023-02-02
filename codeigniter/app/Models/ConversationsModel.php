<?php

namespace App\Models;

use CodeIgniter\Model;

class ConversationsModel extends Model{
    protected $table = 'Conversations';
    protected $primaryKey = 'ConversationId';
    protected $allowedFields = [ 
        'SendingUserId',
        'ReceivingUserId',
    ];

    public function findChat($userId, $vendorId){
        $db = \Config\Database::connect();
        $conversationId = $db->query("SELECT ConversationId FROM Conversations WHERE SendingUserId = $userId and ReceivingUserId = $vendorId or SendingUserId = $vendorId and ReceivingUserId = $userId")->getResult();
        return $conversationId;
    }

    public function getIds($userId){
        $db = \Config\Database::connect();
        $res = $db->query("SELECT Fname, Lname, UserId FROM Users, (SELECT ReceivingUserId FROM Conversations WHERE SendingUserId = $userId UNION SELECT SendingUserId FROM Conversations WHERE ReceivingUserId = $userId) as B WHERE UserId = B.ReceivingUserId")->getResult(); 
        return $res;
    }
}

