<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function destroy(Request $request, $id)
{
    $products = json_decode(file_get_contents('C:\Users\Majd Al-Maleh\Desktop\laravel_projects\fifth\products.json'), true);

    foreach ($products as $key => $product) {
       // return  response()->json(['error' => $request->user['email']]);
        if ($product['id'] == $id && $request->user['email'] == $product['owner_email']) {
            unset($products[$key]);
            file_put_contents('C:\Users\Majd Al-Maleh\Desktop\laravel_projects\fifth\products.json', json_encode($products));
            return response()->json(['message' => 'Product deleted'], 200);
        }
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}

}
