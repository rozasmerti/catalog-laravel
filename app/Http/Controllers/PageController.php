<?php

namespace App\Http\Controllers;

use App\Models\Item;

class PageController extends Controller
{
    /**
     * @OA\Get(
     *      path="/catalog",
     *      operationId="getCatalog",
     *      tags={"Projects"},
     *      summary="Get page catalog",
     *      description="Returns list of catalog",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function catalog() {
        return view('catalog', ['products' => Item::with(['propertyValues', 'propertyValues.property'])->paginate()]);
    }
}
