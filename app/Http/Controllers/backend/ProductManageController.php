<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Order;

class ProductManageController extends Controller
{
    function index()
    {
        $data= Order::join('products','orders.product_id','=','products.id')
        ->join('users','orders.user_id','=','users.id')
        ->select(['users.name As uname','products.name As pname','products.price As pprice','products.gallery As pgallery','orders.*'])
        ->get();
        return view('backend/pages/dashboard', compact('data'));
    }
    function productList()
    {
        $data= Product::all();
        return view('backend/pages/product_list', compact('data'));
    }
    function addProduct(Request $req)
    {
        $product = new Product;
        $product->name=$req->name;
        $product->price=$req->price;
        $product->category=$req->category;
        $product->description=$req->description;
        $uploadFile = $req->file('gallery');
        $file_name = $uploadFile->hashName();
        $product->gallery = $file_name;
        
        if ($product->save()) {
            echo $path = $uploadFile->storeAs('public/gallery', $file_name);
            return redirect('/productlist')
            ->with('success','You have successfully upload file.');
        }else {
            return redirect('\productlist');
        }
    }
    function delProduct($id)
    {
        $product=Product::find($id);
        Storage::delete('/public/gallery/'.$product->gallery);
        $product->delete();
        return redirect('/productlist')
            ->with('success','You have successfully deleted.');
    }
}
