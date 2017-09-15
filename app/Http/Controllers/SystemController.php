<?php

namespace App\Http\Controllers;

use App\Model\System;
use App\Model\Xiangmu;
use Illuminate\Http\Request;
use App\Model\Teacher;
use Illuminate\Support\Facades\Storage;

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
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
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

    public function xiangmu()
    {
        $xm = Xiangmu::all();
	    return view('admin/system/xiangmu', compact('xm'));
    }

    public function addmu(Request $request)
    {
		$teachers = Teacher::all();
        if($request->isMethod('post')){
			$this->validate($request, [
			    'xm.fuwu'    => 'required',
				'xm.fuwu_time' => 'required',
				'xm.money' => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'xm.fuwu' => '服务名称',	
					'xm.fuwu_time' => '服务时长',	
					'xm.money' => '金额',	
				]);     
            $xm = $request->input('xm');
			$teacher = $request->input('teacher');
			if ($teacher) {
				$xm['teacher'] = implode(',', $teacher);
			}
            if (Xiangmu::create($xm)) {
                return redirect('system/xiangmu')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/system/addmu', compact('teachers'));
    }

    public function editmu(Request $request, $id)
    {
		$teachers = Teacher::all();
        $cate = Xiangmu::find($id);
        if ($request->isMethod('post')) {
			$this->validate($request, [
			    'xm.fuwu'    => 'required',
				'xm.fuwu_time' => 'required',
				'xm.money' => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'xm.fuwu' => '服务名称',	
					'xm.fuwu_time' => '服务时长',	
					'xm.money' => '金额',	
				]);     
            $new_cate = $request->input('xm');
			$teacher = $request->input('teacher');
			if ($teacher) {
				$new_cate['teacher'] = implode(',', $teacher);
			}
            $res = Xiangmu::where('id', $id)->update($new_cate);
            if ($res) {
                return redirect('system/xiangmu')->with('success', '修改成功');
            } else {
                return redirect()->back()->with('error', '修改失败');
            }
        }
        return view('admin/system/editmu', compact('cate','teachers'));
    }

    public function deletemu($id)
    {
        $res = Xiangmu::where('id', $id)->delete();
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
