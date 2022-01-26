<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index()
    {
        $data= Product::all();
        // print_r(compact('data'));
        return view('pages/product', compact('data'));
    }
    function detail($id)
    {
         $data= Product::find($id);
        return view('pages/detail', ['product'=>$data]);
    }
}
