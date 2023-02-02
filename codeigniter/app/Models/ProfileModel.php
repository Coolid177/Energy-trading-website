<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model{
    protected $returnType = 'array';
    
    public function findUserData($user_id, $isVendor){
        $db = \Config\Database::connect();
        //select user data
        if ($isVendor){
            $userData = $db->query("SELECT Fname, Lname, Email, Phone_number, Description, Company from Users, Vendor where Users.UserId = Vendor.VendorId and Users.UserId = $user_id");
            $data['userData'] = $userData->getResult();
            //select user images
            $userImages = $db->query("SELECT Media_name from User_media where UserId = $user_id");
            $data['images'] = $userImages->getResult();
            return $data; 
        } else {
            $userData = $db->query("Select Fname, Lname, Email from Users where Users.UserId = $user_id");
            $data['userData'] = $userData->getResult();
            return $data;
        }
    }

}