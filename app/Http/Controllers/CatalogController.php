<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Responses\ProductResponse;
use Illuminate\Http\Request;

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
   public function index(Request $request) {


       $products = Item::with(['propertyValues']);

       if ($request->input('properties'))
       {
           
       }

           $products->paginate(40);

       return new ProductResponse($products);
   }
}
