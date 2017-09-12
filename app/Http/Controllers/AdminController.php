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
		if($new_password==$renew_password) {
		    $pwd = bcrypt($new_password);
		    $res = User::where('name', $user)->update(['password'=>$pwd]);
		    if ($res) {
			return redirect('admin/index')->with('success', '修改成功');
		    }else{
			return redirect('admin/index')->with('error', '修改失败');
		    }
		}
	    } else {
		return redirect('admin/index')->with('error', '密码错误');
	    }
	}
	return view('admin/admin/index');
    }
}
