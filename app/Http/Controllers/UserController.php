<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function add_to_cart(Request $request)
    {
        echo '<pre>';print_r($request->all());echo '</pre>';
        if (Auth::check()) {
            if ($request->qty > 0) {
                $user_data = UserData::where('user_id', Auth::user()->id)->get(['cart_data', 'id'])->toArray();
                $products = [];
                $user_cart_data = $user_data[0]['cart_data'];
                $user_cart_id = $user_data[0]['id'];
                if ($user_cart_data != null) {
                    $products = json_decode($user_cart_data, true);
                }
                if(array_key_exists($request->product_id, $products)){
                    $products[$request->product_id] = $request->qty + $products[$request->product_id];
                }else{
                    $products[$request->product_id] = $request->qty;
                }
                $user_data = UserData::findOrNew($user_cart_id);
                $user_data->cart_data = json_encode($products);
                if ($user_data->save()) {
                    $data = [
                        'title' => 'Added To Cart',
                        'message' => "Product Added to Cart\n Check Your Cart",
                    ];
                } else {
                    $data = [
                        'title' => 'Added To Cart',
                        'message' => "Product Added to Cart\n Check Your Cart",
                    ];
                }
            } else {
                $data = [
                    'title' => 'Select Quentity',
                    'message' => "Please Select Quentity More Than 0",
                ];
            }
            \Session()->flash('add_to_cart', $data);
            return redirect()->back();
        } else {
            redirect()->route('login_form');
        }
    }
    public function add_to_wishlist(Request $request)
    {
        if (Auth::check()) {
                $user_data = UserData::where('user_id', Auth::user()->id)->get(['save_data', 'id'])->toArray();
                $products = [];
                $user_save_data = $user_data[0]['save_data'];
                $user_cart_id = $user_data[0]['id'];
                if ($user_save_data != null) {
                    $products = json_decode($user_save_data, true);
                }
                array_push($products, $request->product_id);
                $user_data = UserData::findOrNew($user_cart_id);
                $user_data->save_data = json_encode($products);
                if ($user_data->save()) {
                    $data = [
                        'title' => 'Added To Cart',
                        'message' => "Product Added to Cart\n Check Your Cart",
                    ];
                } else {
                    $data = [
                        'title' => 'Added To Cart',
                        'message' => "Product Added to Cart\n Check Your Cart",
                    ];
                }
            \Session()->flash('add_to_cart', $data);
            return redirect()->back();
        } else {
            redirect()->route('login_form');
        }
    }

    public function remove_from_cart($product_id)
    {
        if (Auth::check()) {
            $user_data = UserData::where('user_id', Auth::user()->id)->get(['cart_data', 'id'])->toArray();
            $products = [];
            $user_cart_data = $user_data[0]['cart_data'];
            $user_cart_id = $user_data[0]['id'];
            if ($user_cart_data != null) {
                $products = json_decode($user_cart_data, true);
            }
            unset($products[$product_id]);
            $user_data = UserData::findOrNew($user_cart_id);
            $user_data->cart_data = json_encode($products);
            if ($user_data->save()) {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            } else {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            }
            \Session()->flash('add_to_cart', $data);
            return redirect()->back();
        } else {
            redirect()->route('login_form');
        }
    }
    public function remove_from_wishlist($product_id)
    {
        if (Auth::check()) {
            $user_data = UserData::where('user_id', Auth::user()->id)->get(['save_data', 'id'])->toArray();
            $products = [];
            $user_save_data = $user_data[0]['save_data'];
            $user_cart_id = $user_data[0]['id'];
            if ($user_save_data != null) {
                $products = json_decode($user_save_data, true);
            }
            unset($products[array_search($product_id,$products)]);
            // unset($products[$product_id]);
            $user_data = UserData::findOrNew($user_cart_id);
            $user_data->save_data = json_encode($products);
            if ($user_data->save()) {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            } else {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            }
            \Session()->flash('add_to_cart', $data);
            return redirect()->back();
        } else {
            redirect()->route('login_form');
        }
    }

    public function update_cart(Request $request)
    {
        if (Auth::check()) {
            $user_data = UserData::where('user_id', Auth::user()->id)->get(['cart_data', 'id'])->toArray();
            $products = [];
            $user_cart_data = $user_data[0]['cart_data'];
            $user_cart_id = $user_data[0]['id'];
            $products = json_decode($user_cart_data, true);
            foreach ($request->all() as $key => $value) {
                if($key != '_token'){
                    $products[$key] = $value;
                }
            }
            $user_data = UserData::findOrNew($user_cart_id);
            $user_data->cart_data = json_encode($products);
            if ($user_data->save()) {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            } else {
                $data = [
                    'title' => 'Added To Cart',
                    'message' => "Product Added to Cart\n Check Your Cart",
                ];
            }
            \Session()->flash('add_to_cart', $data);
            return redirect()->back();
        }
    }

    public function contect_form(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Email' => 'required|email',
            'Message' => 'required',
        ]);

        $info = array(
            'name' => $request->Name,
        );
        Mail::send(['text' => 'mail'], $info, function ($message)
        {
            $message->to('dhruv.hitinfotech@gmail.com', 'Admin')->subject('Contect From Male Fashion.');
            $message->from('dhruvvadadoriya1566@gmail.com', 'User');
        });
        echo "Successfully sent the email";
        die;
    }

    public function add_comment(Request $request)
    {
        $validate = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = $request->user_id;
        $comment->user_name = $request->fname . ' ' . $request->lname;
        $comment->comment = $request->comment;
        if($comment->save()){
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Commented Successfully',
            ];
        }else{
            $data = [
                'show_popup' => 'danger',
                'title'      => 'Failed',
                'message'    => 'Error While Adding Comment',
            ];
        }
        
        \Session()->flash('add_res',$data);
        return redirect()->back();
    }

    public function blog_like($blog_id){
        $user_d = UserData::where('user_id',auth()->user()->id)->get(['id','blog_like'])->toArray()[0];
        $user_blog_like = json_decode($user_d['blog_like'],true);
        if(in_array($blog_id,$user_blog_like)){
            unset($user_blog_like[array_search($blog_id,$user_blog_like)]);
        }else{
            array_push($user_blog_like,$blog_id);
        }
        $user_blog_like_new = UserData::findOrNew($user_d['id']);
        $user_blog_like_new->blog_like = json_encode($user_blog_like);
        $user_blog_like_new->save();
        return redirect()->back();
    }
}
