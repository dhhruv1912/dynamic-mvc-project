<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        $data['category'] = Category::get()->toArray();
        $data['hero'] = product::where('id',json_decode($data['settings']['hero_product'])[0])->get()->toArray();
        $data['product'] = [];
        $product_inc = [];
        $data['product']['new'] = Product::orderby('avl_date','DESC')->whereNotIn('id', $product_inc)->limit('3')->get()->toArray();
        $data['product']['new_'] = Product::orderby('avl_date','DESC')->limit('3')->pluck('id')->toArray();
        $product_inc = array_unique(array_merge($data['product']['new_'], $product_inc));
        $data['product']['sale'] = Product::where('spc','!=','0')->orderby('spc','DESC')->whereNotIn('id', $product_inc)->limit('3')->get()->toArray();
        $data['product']['sale_'] = Product::where('spc','!=','0')->orderby('spc','DESC')->limit('3')->pluck('id')->toArray();
        $product_inc = array_unique(array_merge($data['product']['sale_'], $product_inc));
        $data['product']['rend'] = Product::whereNotIn('id', $product_inc)->limit('3')->get()->toArray();
        $data['product']['rend_'] = Product::limit('3')->pluck('id')->toArray();
        $product_inc = array_unique(array_merge($data['product']['rend_'], $product_inc));
        return view('home')->with($data);
    }
    
    public function about_page(){
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        return view('about')->with($data);
    }

    public function cart_page(){
        if(Auth::check()){
            $data['cart'] = UserData::where('user_id', Auth::user()->id)->pluck('cart_data')->toArray();
            if(count(json_decode($data['cart'][0],true)) > 0){
                foreach (json_decode($data['cart'][0]) as $key => $product) {
                    // $data['product'][$product['id']] = Product::where('id',$product['id'])->get(['name','price','spc','mimg'])->toArray()[0];
                    $data['product'][$key] = Product::where('id',$key)->get(['name','price','spc','mimg'])->toArray()[0];
                }
                return view('cart')->with($data);
            }
        }
    }
}
