<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LogController extends Controller
{
    public function login_form()
    {
        return view('login');
    }

    public function reg_form()
    {
        return view('reg');
    }
    
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credentials, ($request->remember))) {
            return redirect($request->back_route);
        } else {
            return redirect()->back()->with(['invalidUser' => 'inValid Password']);
        }
    }
    public function reg(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ]);
        $user = new User();
        $user->fname       = $request->fname;
        $user->lname       = $request->lname;
        $user->email       = $request->email;
        $user->password    = Hash::make($request->password);
        if ($user->save()) {
            $user_id = User::where('email',$user->email)->get('id')->toArray()[0]['id'];
            $user_data = new UserData();
            $user_data->user_id = $user_id;
            $user_data->save();
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Register SuccessFully, Please Login',
            ];
            \Session()->flash('ragistered', $data);
            return redirect()->route('login_form');
        }
        return view('reg');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
