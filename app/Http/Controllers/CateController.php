<?php

namespace App\Http\Controllers;

use App\Model\Cate;
use Illuminate\Http\Request;

class CateController extends Controller
{
    public function index()
    {
        $cates = Cate::all();
        return view('admin/cate/index', compact('cates'));
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')){
			$this->validate($request, [
			    'cate.cate_name'    => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'cate.cate_name' => '分类名称',	
				]);     
            $cates = $request->input('cate');
            if (Cate::create($cates)) {
                return redirect('cate/index')->with('success', '添加成功');
            } else {
                return redirect('cate/index')->back()->with('error', '添加失败');
            }
        }
        return view('admin/cate/add');
    }

    public function edit(Request $request, $id)
    {
        $cate = Cate::find($id);
        if ($request->isMethod('post')) {
			$this->validate($request, [
			    'cate.cate_name'    => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'cate.cate_name' => '分类名称',	
				]);     
            $new_cate = $request->input('cate');
            $res = Cate::where('id', $id)->update($new_cate);
            if ($res) {
                return redirect('cate/index')->with('success', '修改成功');
            } else {
                return redirect('cate/index')->with('error', '修改失败');
            }
        }
        return view('admin/cate/edit', compact('cate'));
    }

    public function delete(Request $request, $id)
    {
       $res = Cate::where('id', $id)->delete();
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
