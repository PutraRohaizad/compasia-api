<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;

/**
 * ResellerCartController for API resource of reseller
 *
 * Available API endpoint action:-
 * * index -- [GET] /products
 * * store -- [POST] /products
 *
 * @author  Putra <putrarohayzad@gmail.com>
 *
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the product resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created product resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['file' => 'required']);
        Excel::import(new ProductImport, $request->file);
        return response()->json([
            "success" => true
        ], 200);
    }

}
