<?php

namespace App\Models;

use CodeIgniter\Model;

class MessagesModel extends Model{
    protected $table = 'Messages';
    protected $allowedFields = [
        'SendByUserId',
        'ConversationId',
        'Message'
    ];

    public function getMessages($conversationId){
        $db = \Config\Database::connect();
        $messages = $db->query("SELECT Message, SendTime, SendByUserId 
                                FROM Messages 
                                WHERE ConversationId = $conversationId 
                                ORDER BY SendTime DESC")->getResult();
        return $messages;
        
    }
}

