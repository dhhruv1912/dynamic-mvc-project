<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;


use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product;
        $data['product'] = $product->get()->toArray();
        $data['category'] = Category::pluck('name','id')->toArray();
        // $data['product'] = $product->paginate(12);
        return view('shop')->with($data);
    }

    public function filter(Request $request)
    {
        echo '<pre>';print_r($request->all());echo '</pre>';
        die;
    }
}