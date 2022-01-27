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
            return redirect('/');
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
    function cartList()
    {
        $user_id=Session::get('user')['id'];
        $data=Cart::join('products','cart.Product_id','=','products.id')
                    ->select('products.*','cart.id As cart_id')
                    ->where('cart.user_id',$user_id)
                    ->get();
        return view('pages/cartlist',compact('data'));
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('/cartlist');
    }
}
