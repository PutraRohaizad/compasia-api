<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\ProductResource;
use ErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * ProductController for API resource of product
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
        try{
            Excel::import(new ProductImport, $request->file);
        }catch(Exception $e){
            throw new ErrorException('File is incorrect format');
        }
        
        return response()->json([
            "success" => true
        ], 200);
    }

}
