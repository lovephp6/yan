<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use App\Model\Cate;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $pics = Banner::all();
        return view('admin/banner/index', compact('pics'));
    }

    public function add(Request $request)
    {
        $cates = Cate::all();
        if ($request->isMethod('post')){
            $pics = $request->except('_token');
            $file = $pics['file'];
            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
            $path = $file->move(app_path(). '../../public/uploads', $filename);
            $dudu['url'] = 'uploads/'.$filename;
            $dudu['pic_name'] = $pics['pic_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['cate'] = $pics['cate'];
            if (Banner::create($dudu)) {
                return redirect('banner/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }

        }
        return view('admin/banner/add', compact('cates'));
    }

    public function edit(Request $request, $id)
    {
        $cates = Cate::all();
        $cate_one = Banner::find($id);
        if ($request->isMethod('post')) {
            $pics = $request->except('_token');
            $file = $pics['file'];
            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
            $file->move(app_path(). '../../public/uploads', $filename);
            $dudu['url'] = 'uploads/'.$filename;
            $dudu['pic_name'] = $pics['pic_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['cate'] = $pics['cate'];
            $res = Banner::where('id', $id)->update($dudu);
            if ($res) {
                return redirect('banner/index')->with('success', '修改成功');
            } else {
                return redirect()->back()->with('error', '修改失败');
            }
        }
        return view('admin/banner/edit', compact('cates', 'cate_one'));
    }

    public function delete(Request $request, $id)
    {
        $res = Banner::where('id', $id)->delete();
        if ($res) {
            $data['msg'] = "删除成功";
            $data['code'] = 200;
            return $data;
        } else {
            $data['msg'] = "删除失败";
            $data['code'] = 400;
            return $data;
        }
    }
}
