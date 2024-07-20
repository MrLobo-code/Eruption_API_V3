<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class productCart extends Model
{
    use HasFactory;


    public function storeCartProduct(Request $request)
    {
        $request->input('ProductName');
        $request->input('productDescription');
        $request->input('Price');
        $request->input('imgPath');
    }

    protected $table = "Products";
    protected $filltable = [
        'ProductName',
        'productDescription',
        'Price',
        'imgPath'
    ];
    public $timestamps = false;
}
