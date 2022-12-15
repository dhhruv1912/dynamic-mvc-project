<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add_to_cart(Request $request)
    {
        if (Auth::check()) {
            if ($request->qty > 0) {
                $user_data = UserData::where('user_id', Auth::user()->id)->get(['cart_data', 'id'])->toArray();
                $products = [];
                $user_cart_data = $user_data[0]['cart_data'];
                $user_cart_id = $user_data[0]['id'];
                if ($user_cart_data != null) {
                    $products = json_decode($user_cart_data, true);
                }
                // array_push($products, [
                //     'id' => $request->product_id,
                //     'qty' => $request->qty,
                // ]);
                $products[$request->product_id] = $request->qty;
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

    public function update_cart(Request $request)
    {
        echo '<pre>';
        
        echo '</pre>';
        if (Auth::check()) {
            $user_data = UserData::where('user_id', Auth::user()->id)->get(['cart_data', 'id'])->toArray();
            $products = [];
            $user_cart_data = $user_data[0]['cart_data'];
            $user_cart_id = $user_data[0]['id'];
            $products = json_decode($user_cart_data, true);
            foreach ($request->all() as $key => $value) {
                if($key != '_token'){
                    echo $key;
                    echo '==>';
                    echo $value;
                    echo '<br>';
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
        die;
    }
}
