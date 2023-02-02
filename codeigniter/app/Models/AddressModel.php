<?php 

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model{
    protected $table = 'Address';
    protected $primaryKey = 'AddressId';

    protected $allowedFields = [
        'Street',
        'Number',
        'City',
        'Postal_code',
        'Country'
    ];
}