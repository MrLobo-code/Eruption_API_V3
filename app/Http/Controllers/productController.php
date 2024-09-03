<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public function createNewProduct(Request $request)
    {
        try {
            $campos = $request;

            $new_product = new products;
            $new_product->ProductName = $campos->ProductName;
            $new_product->productDescription = $campos->productDescription;
            $new_product->CategoryID = $campos->CategoryID;
            $new_product->Price = $campos->Price;
            $new_product->Stock = $campos->Stock;
            $new_product->SKU = $campos->SKU;
            $new_product->Brand = $campos->Brand;
            $new_product->Product = $campos->Product;
            $new_product->Dimensions = $campos->Dimensions;
            $new_product->Color = $campos->Color;
            $new_product->Size = $campos->Size;
            $new_product->ThumbnailURL = $campos->ThumbnailURL;
            $new_product->CreatedDate = $campos->CreatedDate;
            $new_product->ModifiedDate = $campos->ModifiedDate;
            $new_product->IsActive = $campos->IsActive;

            $new_product->save();

            return response()->json(
                [
                    'message' => 'Producto guardado con éxito!',
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
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

    public function uploadImages(Request $request)
    {
        try {
            if ($request->hasFile('FileName')) {
                $file = $request->file('FileName');
                $productName = $request->ProductName;
                $path = public_path('products/' . $productName);

                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }

                // Obtener el nombre original del archivo
                $fileName = $file->getClientOriginalName();

                // Mover el archivo a la carpeta correspondiente
                $file->move($path, $fileName);

                return response()->json([
                    "message" => "Archivo guardado",
                ]);
            } else {
                return response()->json([
                    "message" => "Error al guardar!!!"
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    public function uploadToBucketS3(Request $request)
    {
        try {
            $files = $request->file('sampleImages'); // Assuming the files are sent as an array named 'files'

            if (is_null($files)) {
                return response()->json(['message' => 'No files found'], 400);
            }

            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                Storage::putFileAs(path: $request->path, file: $file, name: $fileName);
            }

            return response()->json([
                'message' => 'Images successfully stored!!!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'No files were uploaded: ' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    // public function productExist(Request $request)
    // {
    //     try {
    //         if (DB::table('Products')->where('ProductName', $request->ProductName)->exists()) {
    //             return response(true); // If true, product exist
    //         } else {
    //             return response(false); // If false, product exist
    //         }
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'Message' => 'Error: ' . $e->getMessage()
    //         ], 404);
    //     }
    // }
    public function productExist(Request $request)
    {
        try {
            $exists = DB::table('Products')->where('ProductName', $request->ProductName)->exists();

            return response()->json([
                'exists' => $exists // true or false
                // 'exists' => $request // true or false
            ]);
        } catch (Exception $e) {
            return response()->json([
                'Message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }
}
