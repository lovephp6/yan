<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use app\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
	$user = \Auth::user()->name;
	if ($request->isMethod('post')) {
	    $password = $request->input('password');
	    $new_password = $request->input('new_password');
	    $renew_password = $request->input('renew_password');
	    $password2 = User::where('name', $user)->first()->password;
	    if (\Hash::check($password, $password2)) {
		if ($new_password == $renew_password) {
		   $update_msg = User::where('name', $user)->update(['password', crypt($new_password)]); 
		   if ($update_msg) {
			return redirect()->back()->with('success', '修改成功');
		    } else {
			return redirect()->back()->with('error', '修改失败');
		    }
		} else{
		    return redirect()->back()->with('error', '两次密码不一致');
		}
	    }
	}
	return view('admin/admin/index');
    }
}
