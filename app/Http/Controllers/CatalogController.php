<?php

namespace App\Http\Controllers;

class CatalogController extends Controller
{
    /**
     * @OA\Get(
     *      path="/catalog",
     *      operationId="getCatalog",
     *      tags={"Projects"},
     *      summary="Get list of catalog",
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
   public function index() {
       return view('catalog');
   }
}
