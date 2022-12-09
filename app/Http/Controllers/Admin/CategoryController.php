<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index(){
        $category = new Category();
        $data['categories'] = $category->paginate(10);
		return view('admin.category')->with($data);
	}

    public function load_form($id = '')
    {   
        $data = [];
        if($id != ''){
            $data['category'] = Category::where('id',$id)->get()->toArray();
        }
        return view('admin.form.category')->with($data);
    }

    public function save_form($id = '', Request $request)
    {
        if($id == ''){
            $validated = $request->validate([
                'category_name' => 'required',
                'category_desc' => 'required',
                'category_status' => 'required',
                'category_slug' => 'required|unique:categories,slug',
                'category_img' => 'required',
            ]);
            $extm = $request->file('category_img')->getClientOriginalExtension();
            move_uploaded_file($request->file('category_img'), public_path('assets\img\category\\') . 'm-img-' . $request->category_slug . '.' . $extm);
            $category_img = 'm-img-' . $request->category_slug . '.' . $extm;
        }else{
            $validated = $request->validate([
                'category_name' => 'required',
                'category_desc' => 'required',
                'category_status' => 'required',
                'category_slug' => 'required|unique:categories,slug,'.$id,
            ]);
            if($request->file('category_img') != ''){
                $extm = $request->file('category_img')->getClientOriginalExtension();
                move_uploaded_file($request->file('category_img'), public_path('assets\img\category\\') . 'm-img-' . $request->category_slug . '.' . $extm);
                $category_img = 'm-img-' . $request->category_slug . '.' . $extm;
            }else{
                $category_img = $request->category_main_img_p;
            }

        }
        $category = Category::findOrNew($id);
        $category->Name         =  $request->category_name;
        $category->Desc         =  $request->category_desc;
        $category->status       =  $request->category_status;
        $category->Slug         =  $request->category_slug;
        $category->Img          =  $category_img;
        if($category->save()){
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Category Added Successfully',
            ];
            \Session::flash('category_added',$data);
            return redirect()->route('admin.category');
        }
    }

    public function delete($id = ''){
        if($id != ''){
            if($data['product'] = Category::where('id',$id)->delete()){
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
}