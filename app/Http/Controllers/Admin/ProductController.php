<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Rules\Discount;
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = [''];
        $products = new Product;
        if(isset($request->name)){
            $data['name'] = $request->name;
            $products = $products->Where('name', 'like', '%' . $request->name . '%');
        }
        if(isset($request->sku)){
            $data['sku'] = $request->sku;
            $products = $products->Where('sku', 'like', '%' . $request->sku . '%');
        }
        if(isset($request->model)){
            $data['model'] = $request->model;
            $products = $products->Where('model', 'like', '%' . $request->model . '%');
        }
        if(isset($request->stock)){
            $data['stock'] = $request->stock;
            $data['stock_val'] = $request->stock_val;
            $products = $products->Where('qty', $request->stock_val, (int)$request->stock );
        }
        if(isset($request->status)){
            $data['status'] = $request->status;
            $products = $products->Where('status', (int)$request->status );
        }
        $data['products'] = $products->paginate(10);
        return view('admin.product')->with($data);
    }

    public function load_form($id = '')
    {
        $data['category'] = Category::where('status','1')->get(['id','Name'])->toArray();
        if($id != ''){
            $data['product'] = Product::where('id',$id)->get()->toArray();
        }
        return view('admin.form.product')->with($data);
    }

    public function delete_product($id = '')
    {
        if($id != ''){
            if($data['product'] = Product::where('id',$id)->delete()){
                $data = [
                    'show_popup' => 'primary',
                    'title'      => 'Success',
                    'message'    => 'Product Deleted Successfully',
                ];
            }else{
                $data = [
                    'show_popup' => 'danger',
                    'title'      => 'Failed',
                    'message'    => 'Error While Deleteing Product',
                ];
            }
            \Session::flash('product_added',$data);
            return redirect()->route('admin.product');
        }else{
            return view('admin.form.product');
        }
    }

    public function save_form($id = '', Request $request)
    {
        if($id == ''){
            $validated = $request->validate([
                'product_name' => 'required',
                'product_desc' => 'required',
                'product_tag' => 'required',
                'product_model' => 'required|unique:product,model',
                'product_sku' => 'required|unique:product,sku',
                'product_price' => 'required|integer|gte:10',
                'product_tax_category' => 'required',
                'product_quantity' => 'required|integer|gte:50|max:500',
                'product_min_qty' => 'required|integer|gte:10',
                'product_out_of_stock_status' => 'required',
                'product_shipping_req' => 'required',
                'product_date' => 'required',
                'product_menuf' => 'required',
                'product_cat' => 'required',
                'product_discount' => 'lt:' . $request->product_price,
                'product_special' => 'lt:' . $request->product_price,
                'product_main_img' => 'required',
                'about' => 'required',
            ]);
            $extm = $request->file('product_main_img')->getClientOriginalExtension();
            move_uploaded_file($request->file('product_main_img'), public_path('assets\img\product\\') . 'm-img-' . $request->product_sku . '.' . $extm);
            $product_img = 'm-img-' . $request->product_sku . '.' . $extm;
            $img_c = 0;
            $sub_img = [];
            foreach ($request->file() as $key => $value) {
                if($key != 'product_main_img'){
                    $img_c++;
                    $ext = $request->file($key)->getClientOriginalExtension();
                    $this_id = str_replace('product_main_img','',$key);
                    $sort_order = 'product_img_sort' .$this_id;
                    move_uploaded_file($request->file($key), public_path('assets\img\product\\') . 's-img-' . $request->product_sku . '-' . $img_c .'.' . $ext);
                    $sub_img[$img_c] = [];
                    $sub_img[$img_c]['link'] = 's-img-' . $request->product_sku . '-' . $img_c .'.' . $ext;
                    $sub_img[$img_c]['sort_order'] = $request->$sort_order;
                }
            }
        }else{
            $validated = $request->validate([
                'product_name' => 'required',
                'product_desc' => 'required',
                'product_tag' => 'required',
                'product_model' => 'required|unique:product,model,'.$id,
                'product_sku' => 'required|unique:product,sku,'.$id,
                'product_price' => 'required|integer|gte:10',
                'product_tax_category' => 'required',
                'product_quantity' => 'required|integer|gte:50|max:500',
                'product_min_qty' => 'required|integer|gte:10',
                'product_out_of_stock_status' => 'required',
                'product_shipping_req' => 'required',
                'product_date' => 'required',
                'product_menuf' => 'required',
                'product_cat' => 'required',
                'product_discount' => 'integer|lt:' . (int)$request->product_price,
                'product_special' => 'integer|lt:' . (int)$request->product_price,
                'about' => 'required',
            ]);
            if($request->file('product_main_img') != ''){
                $extm = $request->file('product_main_img')->getClientOriginalExtension();
                move_uploaded_file($request->file('product_main_img'), public_path('assets\img\product\\') . 'm-img-' . $request->product_sku . '.' . $extm);
                $product_img = 'm-img-' . $request->product_sku . '.' . $extm;
            }else{
                $product_img = $request->product_main_img_p;
            }
            $img_c = 0;
            $sub_img = [];

            foreach ($request->all() as $key => $value) {
                if($key != 'product_name' && $key != 'product_desc' && $key != 'product_tag' && $key != 'product_model' && $key != 'product_sku' && $key != 'product_price' && $key != 'product_tax_category' && $key != 'product_quantity' && $key != 'product_min_qty' && $key != 'product_out_of_stock_status' && $key != 'product_shipping_req' && $key != 'product_date' && $key != 'product_menuf' && $key != 'product_cat' && $key != 'product_discount' && $key != 'product_special' && $key != '_token' && $key != 'product_main_img_p' && $key != 'product_main_img'){
                    $this_id = str_replace('product_main_img','',$key);
                    $sort_order = 'product_img_sort' .$this_id;
                    if($request->file($key)){
                        $img_c++;
                        $ext = $request->file($key)->getClientOriginalExtension();
                        move_uploaded_file($request->file($key), public_path('assets\img\product\\') . 's-img-' . $request->product_sku . '-' . $img_c .'.' . $ext);
                        $sub_img[$img_c] = [];
                        $sub_img[$img_c]['link'] = 's-img-' . $request->product_sku . '-' . $img_c .'.' . $ext;
                        $sub_img[$img_c]['sort_order'] = $request->$sort_order;
                    }else {
                        $pattern = "/product_main_img/";
                        if(preg_match($pattern, $key)){
                            $img_c++;
                            $sub_img[$img_c] = [];
                            $sub_img[$img_c]['link'] = $value;
                            $sub_img[$img_c]['sort_order'] = $request->$sort_order;
                        }
                    }
                }
            }

        }
        $product = Product::findOrNew($id);
        $product->name          =  $request->product_name;
        $product->desc          =  $request->product_desc;
        $product->tag           =  json_encode(explode(',',$request->product_tag));
        $product->model         =  $request->product_model;
        $product->sku           =  $request->product_sku;
        $product->info          =  $request->info;
        $product->about         =  $request->about;
        $product->price         =  $request->product_price;
        $product->tax           =  $request->product_tax_category;
        $product->qty           =  $request->product_quantity;
        $product->mqty          =  $request->product_min_qty;
        $product->out_of_stock  =  $request->product_out_of_stock_status;
        $product->shipping      =  $request->product_shipping_req;
        $product->avl_date      =  $request->product_date;
        $product->mfc           =  $request->product_menuf;
        $product->cat           =  $request->product_cat;
        $product->disc          =  $request->product_discount;
        $product->spc           =  $request->product_special;
        $product->mimg          =  $product_img;
        $product->simg          =  json_encode($sub_img);
        if($product->save()){
            $tags = json_decode(Setting::where('name','product_tags')->pluck('value')->toArray()[0]);
            foreach (json_decode($product->tag) as  $value) {
                array_push($tags,strtolower($value));
            }
            $tags = array_unique($tags);
            $p_tag = Setting::findOrNew(36);
            $p_tag->value = json_encode($tags);
            $p_tag->save();
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Product Added Successfully',
            ];
            \Session::flash('product_added',$data);
            return redirect()->route('admin.product');
        }
    }
}
