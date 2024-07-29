<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Responses\ProductResponse;
use App\Models\PropertyValue;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @OA\Get(
     *      path="/products",
     *      operationId="getProducts",
     *      tags={"Products"},
     *     @OA\Parameter(
     *         name="properties[color][]",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="string", example="зеленый"),
     *          )
     *
     *     ),
     *     @OA\Parameter(
     *         name="properties[size][]",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="string", example="200"),
     *          )
     *     ),
     *     @OA\Parameter(
     *         name="properties[brand][]",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="string", example="Philips"),
     *          )
     *     ),
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


       $products = Item::with(['propertyValues', 'propertyValues.property']);
       if ($properties = $request->input('properties'))
       {
            $products->filterByProperties($properties);
       }

       return new ProductResponse($products->paginate());
   }
}
