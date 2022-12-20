<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Writter;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Contracts\Writer;

class WriterController extends Controller
{
    public function index()
    {
        $data['writer'] = Writter::all();
        return view('admin.writer')->with($data);
    }

    public function load_form($username = '')
    {
        if($username != ''){
            $writer = Writter::where('username',$username)->get()[0];
            $data['id'] = $writer->id;
            $data['name'] = $writer->name;
            $data['username'] = $writer->username;
            $data['status'] = $writer->status;
            $data['profile'] = $writer->profile;
            $data['thumbnail'] = $writer->thumbnail;
        }else{
            $data['id'] = '';
            $data['name'] = '';
            $data['username'] = '';
            $data['status'] = '';
            $data['profile'] = '';
            $data['thumbnail'] = '';
        }
        return view('admin.form.writer')->with($data);
    }

    public function save_form(Request $request, $id = '')
    {
        if ($id != '') {
            $validater = $request->validate([
                'name' => 'required',
                'username' => 'required|unique:writer,username,'. $id,
                'status' => 'required',
            ]);
            if($request->file('profile') != ''){
                $extm = $request->file('profile')->getClientOriginalExtension();
                move_uploaded_file($request->file('profile'), public_path('assets\img\writer\profile\\') . $request->username . '-profile.' . $extm);
                $profile = $request->username . '-profile.' . $extm;
            }else{
                $profile = $request->profile_p;
            }
            if($request->file('thumbnail') != ''){
                $extm = $request->file('thumbnail')->getClientOriginalExtension();
                move_uploaded_file($request->file('thumbnail'), public_path('assets\img\writer\thumbnail\\') . $request->username . '-thumbnail.' . $extm);
                $thumbnail = $request->username . '-thumbnail.' . $extm;
            }else{
                $thumbnail = $request->thumbnail_p;
            }
        } else {
            $validater = $request->validate([
                'name' => 'required',
                'username' => 'required|unique:writer,username',
                'profile' => 'required',
                'thumbnail' => 'required',
                'status' => 'required',
            ]);
            $extm = $request->file('profile')->getClientOriginalExtension();
            move_uploaded_file($request->file('profile'), public_path('assets\img\writer\profile\\') .  $request->username . '-profile.' . $extm);
            $profile = $request->username . '-profile.' . $extm;
            $extm = $request->file('thumbnail')->getClientOriginalExtension();
            move_uploaded_file($request->file('thumbnail'), public_path('assets\img\writer\thumbnail\\') . $request->username . '-thumbnail.' . $extm);
            $thumbnail = $request->username . '-thumbnail.' . $extm;
        }
        $writer = Writter::findOrNew($id);
        $writer->name = $request->name;
        $writer->username = $request->username;
        $writer->profile = $profile;
        $writer->thumbnail = $thumbnail;
        $writer->status = $request->status;
        if($writer->save()){
            $data= [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Writter Saved Successfully',
            ];
        }else{
            $data= [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Error While Saving Writter Successfully',
            ];
        }
        \Session::flash('writer',$data);
        return redirect()->route('admin.writer');
    }

    public function delete($username)
    {
        Writter::where('username',$username)->delete();
        return redirect()->back();
    }
}
