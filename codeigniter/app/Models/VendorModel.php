<?php 

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model{
    protected $table = 'Vendor';

    protected $allowedFields = [
        'Phone_number',
        'Description',
        'VendorId',
        'Company'
    ];

    public function insertData($vendorId, $data){
        $db = \Config\Database::connect();
        $db->query("UPDATE `Vendor` SET `Phone_number`='$data[Phone_number]',`Description`='$data[Description]',`Company`='$data[Company]' WHERE VendorId = $vendorId");
    }
}