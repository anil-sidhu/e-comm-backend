<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    function addProduct(Request $req)
    {
       

        $product= new Product;
        $product->name=$req->input('name');
        $product->price=$req->input('price');
        $product->description=$req->input('description');
        $product->file_path=$req->file('file')->store('products');
        $product->save();
        return $product;
    }
    function list()
    {
        return Product::all();
    }
    function delete($id)
    {
        $result= Product::where('id',$id)->delete();
        if($result)
        {
            return ["result"=>"product has been delete"];
        }
        else{
            return ["result"=>"Operation failed"];
        }
    }
    function getProduct($id)
    {
        return Product::find($id);
    }

    function updateProduct($id, Request $req)
    {
        $product= Product::find($id);
        $product->name=$req->input('name');
        $product->price=$req->input('price');
        $product->description=$req->input('description');
        if($req->file('file'))
        {
            $product->file_path=$req->file('file')->store('products');

        }
        $product->save();
        return $product;
    }
    function search($key)
    {
        return Product::where('name','Like',"%$key%")->get();
    }
    
} 
 