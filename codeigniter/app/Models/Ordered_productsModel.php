<?php

namespace App\Models;

use CodeIgniter\Model;

class Ordered_productsModel extends Model{
    protected $table = 'Ordered_products';

    protected $allowedFields = [
        'OrderId',
        'ProductId',
        'Quantity',
        'Price_per_item'
    ];
}

