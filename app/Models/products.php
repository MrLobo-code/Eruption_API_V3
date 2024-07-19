<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = "Products";
    protected $filltable = [
        'ProductName',
        'productDescription',
        'CategoryID',
        'Price',
        'Stock',
        'SKU',
        'Brand',
        'Product',
        'Dimensions',
        'Color',
        'Size',
        'ThumbnailURL',
        'CreatedDate',
        'ModifiedDate',
        'IsActive'
    ];
    public $timestamps = false;
}
