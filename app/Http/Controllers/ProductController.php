<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

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
    function search(Request $req)
    {
        $query=$req->input('query');
        $data=Product::where('name', 'like', '%'.$query.'%')->get();
        return view('pages/search', compact('data','query'));
    }
    function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
        }
        else {
            return view('pages/login');
        }
    }
    function cartItem()
    {
        $user_id = Session::get('user')['id'];
        return Cart::where('user_id',$user_id)->count();
    }
}
