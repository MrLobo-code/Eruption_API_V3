<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function getProduct()
    {
        try {
            $products = products::all();
            return response()->json(
                $products,
                200
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error, Products table is not available'
            ], 500);
        }
    }
}
