<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\products;
use Illuminate\Http\Request;
use Exception;
use Aws\S3\S3Client;

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



    //RECTIFICAR siguiente CÓDIGO
    public function uploadToBucketS3(Request $request)
    {
        $sharedConfig = [
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ]
        ];

        $s3 = new S3Client($sharedConfig);

        // ... (código para generar la URL prefirmada)

        $cmd = $s3->putObjectCommand([
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => 'your-key-name.jpg', // Puedes personalizar la clave
            'Body'   => 'Your file body', // Reemplaza con el contenido del archivo
            'ContentType' => 'image/jpeg', // Ajusta el tipo de contenido según sea necesario
            'ACL'    => 'public-read' // Para hacer el archivo público
        ]);

        $request = $s3->createPresignedRequest($cmd, '+1 hour');
        $signedRequest = (string) $request->getUri();

        return response()->json(['url' => $signedRequest]);
    }
}
