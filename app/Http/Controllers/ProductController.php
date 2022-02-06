<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    function index()
    {
        $data= Product::paginate(12);
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
        if (Session::has('user')) {
            $user_id=Session::get('user')['id'];
            $data=Cart::join('products','cart.Product_id','=','products.id')
                        ->select('products.*','cart.id As cart_id')
                        ->where('cart.user_id',$user_id)
                        ->get();
            return view('pages/cartlist',compact('data'));
        }
        else 
        {
            return view('pages/login');
        }
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('/cartlist');
    }
    function checkOut()
    {
        $user_id=Session::get('user')['id'];
        $total=Cart::join('products','cart.Product_id','=','products.id')
                    ->select('products.*','cart.id As cart_id')
                    ->sum('products.price');
        return view('pages/checkout',compact('total'));
    }
    function orderPlace(Request $req)
    {
        $user_id=Session::get('user')['id'];
        $all_cart=Cart::where('user_id',$user_id)->get();
        foreach ($all_cart as $cart) {
            $order=new Order;
            $order->product_id=$cart->product_id;
            $order->user_id=$cart->user_id;
            $order->address=$req->address;
            $order->status="pending";
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            $saved=$order->save();
        }
        if ($saved) {
            Cart::where('user_id',$user_id)->delete();
            $req->session()->flash('message', 'Your order place, Successfully!');
            return redirect('/');
        }else {
            $req->session()->flash('message', 'Something wrong, please try again!');
            return redirect('/checkout');
        }
    }
}
