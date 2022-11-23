<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_admin($id = '', Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin,username',
            'email' => 'required|string|email|max:255|unique:admin,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ]);
        // $admin = Admin::findOrNew($id);
        // $admin = Admin::findOrNew($id);
        $admin = new Admin();
        $admin->fname       = $request->fname;
        $admin->lname       = $request->lname;
        $admin->username    = $request->username;
        $admin->email       = $request->email;
        $admin->password    = Hash::make($request->password);
        if ($admin->save()) {
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Register SuccessFully, Please Login',
            ];
            \Session()->flash('ragistered', $data);
            return redirect()->route('admin.login');
        }
        return view('auth.register');
    }

    public function admin_login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, ($request->remember))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with(['invalidUser' => 'inValid Password']);
        }
    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
