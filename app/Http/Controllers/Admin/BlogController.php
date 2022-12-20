<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\Writter;

class BlogController extends Controller
{
	public function index(){
        $data['blogs'] = Blog::paginate(10);
		return view('admin.blog')->with($data);
	}

    public function load_form($slug = ''){
        if($slug != ''){
            $blog = Blog::where('slug',$slug)->get()->toArray()[0];
            $data['id'] = $blog['id'];
            $data['name'] = $blog['name'];
            $data['slug'] = $blog['slug'];
            $data['author'] = $blog['author'];
            $data['thumbnail'] = $blog['thumbnail'];
            $data['content'] = $blog['content'];
            $data['tags']  = implode(',',json_decode($blog['tags'],true));
            $data['status']  = $blog['status'];
            $data['writter']  = $blog['writter'];
        }else{
            $data['id'] = '';
            $data['name'] = '';
            $data['slug'] = '';
            $data['author'] = '';
            $data['thumbnail'] = '';
            $data['content'] = '';
            $data['tags']  = '';
            $data['status']  = '';
            $data['writter']  = '';
        }
        $data['admins'] = Admin::get(['fname','lname','username'])->toArray();
        $data['writers'] = Writter::get(['name','username'])->toArray();
        return view('admin.form.blog')->with($data);
    }
    public function save_form($id= '', Request $request){
        if($id == ''){
            $validated = $request->validate([
                'blog_name' => 'required|',
                'blog_slug' => 'required|unique:blog,slug',
                'blog_author' => 'required',
                'blog_thumbnail' => 'required',
                'blog_tags' => 'required',
                'blog_content' => 'required',
            ]);
            $request->file('blog_thumbnail');

            $extm = $request->file('blog_thumbnail')->getClientOriginalExtension();
            move_uploaded_file($request->file('blog_thumbnail'), public_path('assets\img\blog\thumb\\') . 'blog-thumb-' . $request->blog_slug . '.' . $extm);
            $blog_thumbnail = 'blog-thumb-' . $request->blog_slug . '.' . $extm;
            
            // $blog = new Blog;
            // $blog->name = $request->blog_name;
            // $blog->slug = $request->blog_slug;
            // $blog->author = $request->blog_author;
            // $blog->date = date('Y-m-d');
            // $blog->thumbnail = $blog_thumbnail;
            // $blog->content = $request->blog_content;
            // $blog->tags = $request->blog_tags;
            // if($blog->save()){
            //     $data = [
            //         'show_popup' => 'primary',
            //         'title'      => 'Success',
            //         'message'    => 'Blog Added Successfully',
            //     ];
            //     \Session::flash('blog',$data);
            //     return redirect()->route('admin.blog');
            // }else{
            //     $data = [
            //         'show_popup' => 'error',
            //         'title'      => 'Error',
            //         'message'    => 'Problem While saving Blog',
            //     ];
            //     \Session::flash('blog',$data);
            //     return redirect()->back();
            // }
        }else{
            $validated = $request->validate([
                'blog_name' => 'required|',
                'blog_writer' => 'required|',
                'blog_slug' => 'required|unique:blog,slug,'.$id,
                'blog_author' => 'required',
                'blog_tags' => 'required',
                'blog_content' => 'required',
            ]);
            $request->file('blog_thumbnail');
            if($request->file('blog_thumbnail') != ''){
                $extm = $request->file('blog_thumbnail')->getClientOriginalExtension();
                move_uploaded_file($request->file('blog_thumbnail'), public_path('assets\img\blog\thumb\\') . 'blog-thumb-' . $request->blog_slug . '.' . $extm);
                $blog_thumbnail = 'blog-thumb-' . $request->blog_slug . '.' . $extm;
            }else{
                $blog_thumbnail = $request->thumbnail_p;
            }
            
        }
        $blog = Blog::findOrNew($id);
        $blog->name = $request->blog_name;
        $blog->writter = $request->blog_writer;
        $blog->slug = $request->blog_slug;
        $blog->author = $request->blog_author;
        $blog->thumbnail = $blog_thumbnail;
        $blog->content = $request->blog_content;
        $blog->tags = json_encode(explode(',',$request->blog_tags));
        $blog->status = $request->blog_status;
        if($id == ''){
            $blog->date = date('Y-m-d');
        }
        if($blog->save()){
            $blog_tag = json_decode(Setting::where('name','blog_tags')->pluck('value')->toArray()[0]);
            foreach (json_decode($blog->tags) as  $value) {
                array_push($blog_tag,strtolower($value));
            }
            $blog_tag = array_unique($blog_tag);
            $b_tag = Setting::findOrNew(65);
            $b_tag->value = json_encode($blog_tag);
            $b_tag->save();
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Blog Added Successfully',
            ];
            \Session::flash('blog',$data);
            return redirect()->route('admin.blog');
        }else{
            $data = [
                'show_popup' => 'error',
                'title'      => 'Error',
                'message'    => 'Problem While saving Blog',
            ];
            \Session::flash('blog',$data);
            return redirect()->back();
        }

    }

    public function delete_blog($slug = '')
    {
        if($slug != ''){
            if($data['blog'] = Blog::where('slug',$slug)->delete()){
                $data = [
                    'show_popup' => 'primary',
                    'title'      => 'Success',
                    'message'    => 'Blog Deleted Successfully',
                ];
            }else{
                $data = [
                    'show_popup' => 'danger',
                    'title'      => 'Failed',
                    'message'    => 'Error While Deleteing Blog',
                ];
            }
            \Session::flash('blog',$data);
            return redirect()->route('admin.blog');
        }else{
            return view('admin.form.blog');
        }
    }
}