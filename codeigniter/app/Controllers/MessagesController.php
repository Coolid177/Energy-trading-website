<?php

/**
 * @author Rune Rombouts 2158153
 */

namespace App\Controllers;

class MessagesController extends BaseController
{
    /**
     * Displays the default messages page with no open chats
     * @return the messages view with existing conversations
     */
    public function viewMessages(){
        $conversationsModel = model(ConversationsModel::class);
        $data['conversationIds'] = $conversationsModel->getIds(session('UserId'));
        return view('profile/messages', $data);
    }

    /**
     * opens a conversation between the logged in user and the target vendor
     * @pre $vendorId is the id of a vendor
     * @return the messages between the users
     */
    public function openConversation($vendorId)
    {
        $conversationsModel = model(ConversationsModel::class);
        $conversationId = $conversationsModel->findChat(session('UserId'), $vendorId);

        if (empty($conversationId)){ //there is no conversation between them
            $usersModel = model(UsersModel::class);
            $data['name'] = $usersModel->getUserName($vendorId);
        } else { //fetch messages of open chat
            $conversationId = $conversationId[0]->ConversationId;
            $messagesModel = model(MessagesModel::class);
            $data['messages'] = $messagesModel->getMessages($conversationId);
        }
        $data['vendorId'] = $vendorId;
        //fetch all existing conversations of logged in user
        $data['conversationIds'] = $conversationsModel->getIds(session('UserId'));
        return view('profile/messages', $data);
    }

    /**
     * Sends a message to the $vendorId, if they don't have a conversation create one and then send the message
     * @pre $vendorId is a vendor and will receive the message
     * @post the message is send
     * @param $vendorId the user that will receive the message
     */
    public function sendMessage($vendorId)
    {
        $conversationsModel = model(ConversationsModel::class);
        $conversationId = $conversationsModel->findChat(session('UserId'), $vendorId);
        $messagesModel = model(MessagesModel::class);
        if(strlen(trim($this->request->getPost('message'))) == 0){
            return redirect()->to("messages/$vendorId");
        }
        if (empty($conversationId)){ 
            //create conversation between vendor and user
            $data = [
                'SendingUserId' => session('UserId'),
                'ReceivingUserId' => $vendorId
            ];
            $conversationId = $conversationsModel->insert($data);
        } else {
            $conversationId = $conversationId[0]->ConversationId;
        } 
        //insert message into database
        $data = [
            'SendByUserId' => session('UserId'),
            'ConversationId' => $conversationId,
            'Message' => $this->request->getPost('message')
        ];
        $messagesModel->insert($data);
        return redirect()->to("/messages/$vendorId");
    }
}