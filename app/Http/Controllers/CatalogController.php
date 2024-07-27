<?php

namespace App\Http\Controllers;

use App\Models\Item;

class CatalogController extends Controller
{
    /**
     * @OA\Get(
     *      path="products",
     *      operationId="getProducts",
     *      tags={"Projects"},
     *      summary="Get list of products",
     *      description="Returns list of product",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         )
     *       )
     *     )
     */
   public function index() {

       $products = Item::with(['propertyValues'])->paginate(40);
       $response = [
           'products' => $products
       ];
       return response()->json($response);
   }
}
