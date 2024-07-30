<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Responses\ProductResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProductsRequest;

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
   public function index(ProductsRequest $request): ProductResponse {

       $validatedData = $request->validated();
       $products = Item::with(['propertyValues', 'propertyValues.property']);
       $properties = $validatedData['properties'] ?? false;
       if ($properties)
       {
            $products->filterByProperties($properties);
       }


       return new ProductResponse($products->paginate());
   }
}
