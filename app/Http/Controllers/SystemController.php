<?php

namespace App\Http\Controllers;

use App\Model\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        $sysMsg = System::first();
        if ($request->isMethod('post')) {
            $pics = $request->except('_token');
            if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                $file->move(app_path(). '../../public/uploads', $filename);
                $dudu['code'] = 'uploads/'.$filename;
            }
            $dudu['name'] = $pics['name'];
            $dudu['address'] = $pics['address'];
            $dudu['tel'] = $pics['tel'];
            $dudu['desc'] = $pics['desc'];
            $dudu['email'] = $pics['email'];
            if (!empty($sysMsg->id)) {
                $res = System::where('id', $sysMsg->id)->update($dudu);
            } else {
                $res = System::create($dudu);
            }
            if ($res) {
                return redirect('system/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/system/index', compact('sysMsg'));
    }
}
