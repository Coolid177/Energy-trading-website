<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table = 'Users';
    protected $primaryKey = 'UserId';

    protected $allowedFields = [
        'Fname', 
        'Lname', 
        'Email', 
        'Password', 
        'isVendor'
    ];
    
    /**
     * Checks if there is a email, password combination
     * Sets the data if there is
     * @param $email the email the user provided
     * @param $password the password the user provided
     * @return true on success, false on fail
     */
    public function isValidUser($email, $password){
        $db = \Config\Database::connect();
        $queryResults = $db->table('Users')->select('UserId, Fname, isVendor, Password')->where('Email', $email)->get()->getResult(); 
        if(!empty($queryResults) && password_verify($password, $queryResults[0]->Password)){
            $session = \Config\Services::session();
            $session->set('isVendor', $queryResults[0]->isVendor);
            $session->set('Email', $queryResults[0]->Fname);
            $session->set('UserId', $queryResults[0]->UserId);
            $session->set('LoggedIn', true);
            $session->set('ShoppingCart', array());
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets the first and last name of a user from the database
     */
    public function getUserName($userId){
        $db = \Config\Database::connect();
        return $db->query("SELECT Fname, Lname FROM Users WHERE UserId = $userId")->getResult();
    }
}

