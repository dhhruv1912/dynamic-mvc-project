<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\UserData;
use App\Models\Writter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                    $data['product'][$key] = Product::where('id',$key)->get(['name','price','spc','mimg'])->toArray()[0];
                }
                return view('cart')->with($data);
            }
        }
    }

    public function wishlist_page(){
        if(Auth::check()){
            $data['wishlist'] = UserData::where('user_id', Auth::user()->id)->pluck('save_data')->toArray();
            if(count(json_decode($data['wishlist'][0],true)) > 0){
                foreach (json_decode($data['wishlist'][0]) as $key => $product) {
                    $data['product'][$key] = Product::where('id',$product)->get(['name','price','spc','mimg','sku'])->toArray()[0];
                }
                return view('wishlist')->with($data);
            }else{
                return redirect()->back();
            }
        }
    }

    public function contect_page()
    {
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        return view('contect')->with($data);
    }

    public function blog_list()
    {
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        $data['blogs'] = Blog::where('status','1')->get(['name','slug','author','date','thumbnail']);
        return view('blog')->with($data);
    }

    public function blog_tag($tag)
    {
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        $data['tag'] = $tag;
        $data['blogs'] = Blog::where('tags','LIKE','%'. $tag .'%')->get(['name','slug','author','date','thumbnail']);
        return view('blog_tag')->with($data);
    }

    public function blog_details($slug){
        $data['blog'] = DB::table('blog')
        ->join('writer', 'blog.writter', '=', 'writer.username')
        ->join('admin', 'blog.author', '=', 'admin.username')
        ->select('blog.*','writer.name as w_name', 'writer.username as w_user', 'writer.profile as w_profile', 'admin.fname as a_fname', 'admin.lname as a_lname')
        ->where('slug',$slug)->get()[0];
        
        $data['previous'] = Blog::select('blog.id','blog.name','blog.slug')->where('id', '<', $data['blog']->id)->orderBy('id','desc')->first();
        if($data['previous'] == ''){
            $data['previous'] = Blog::select('blog.id','blog.name','blog.slug')->orderBy('id','desc')->first();
        }
        $data['next'] = Blog::select('blog.id','blog.name','blog.slug')->where('id', '>', $data['blog']->id)->orderBy('id','asc')->first();
        if($data['next'] == ''){
            $data['next'] = Blog::select('blog.id','blog.name','blog.slug')->orderBy('id','asc')->first();
        }
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        $data['user_liked_blog'] = UserData::where('user_id',auth()->user()->id)->get('blog_like')->toArray();
        $data['comment'] = Comment::where('blog_id',$data['blog']->id)->orderBy('id','desc')->limit(5)->get(['user_name','comment']);
        $data['comments'] = Comment::where('blog_id',$data['blog']->id)->get('id');
        // echo '<pre>';print_r($data);echo '</pre>';
        return view('blog_details')->with($data);
    }
    
    public function writer($username){
        $data['writer'] = Writter::where('username',$username)->get()[0];
        $data['blogs'] = Blog::where('writter',$username)->paginate(8);
        $data['settings'] = Setting::pluck('value','name',)->toArray();
        return view('writer')->with($data);
    }
}
