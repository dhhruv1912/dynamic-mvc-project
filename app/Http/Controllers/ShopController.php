<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;
use DB;


use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $data['product'] = DB::table('product')
            ->join('categories', 'product.cat', '=', 'categories.id')
            ->select('product.*', 'categories.Name as c_name', 'categories.Slug as c_slug')
            ->paginate(12);
        $data['category'] = Category::pluck('name', 'id')->toArray();
        $data['tags'] = Setting::where('name', 'product_tags')->get()->toArray();
        return view('shop')->with($data);
    }

    public function filter(Request $request)
    {
        $product = new Product;
        if (isset($request->cat) && $request->cat != '') {
            $product = $product->where('cat', $request->cat);
        }
        if (isset($request->price) && $request->price != '') {
            $p = explode('-', $request->price);
            if ($p[1] == '') {
                $product = $product->where('price', '>', $p[0]);
            } else {
                $product = $product->whereBetween('price', [$p[0], $p[1]]);
            }
        }
        if (isset($request->tag) && $request->tag != '') {
            $product = $product->where('tag', 'like', '%'. $request->tag . '%');
        }
        $data['filter'] = $request->all();
        $data['product'] = $product->paginate(12);
        $data['category'] = Category::pluck('name', 'id')->toArray();
        $data['tags'] = Setting::where('name', 'product_tags')->get()->toArray();
        return view('shop')->with($data);
    }

    public function product( $product)
    {
        $data['product'] = DB::table('product')
        ->join('categories', 'product.cat', '=', 'categories.id')
        ->select('product.*','categories.Name as c_name', 'categories.Slug as c_slug')
        ->where('sku',$product)->get();
        return view('product')->with($data);
    }

    public function category( $slug)
    {
        $cat_id = Category::where('slug',$slug)->pluck('id');
        $data['product'] = Product::where('cat',$cat_id[0])->paginate(12);
        $data['cat_name'] = Category::where('slug',$slug)->pluck('name')[0];
        return view('category')->with($data);
    }

    public function tag( $tag)
    {
        $data['product'] = Product::Where('tag', 'like', '%' . $tag . '%')->paginate(12);
        $data['tag_name'] = $tag;
        return view('tag')->with($data);
    }

    public function category_listing()
    {
        $data['category'] = Category::get()->toArray();
        return view('category_listing')->with($data);
    }
}
