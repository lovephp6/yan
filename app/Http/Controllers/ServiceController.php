<?php

namespace App\Http\Controllers;

use App\Model\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin/service/index', compact('services'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
			$this->validate($request, [
			    'service_name'    => 'required',
				'service_jianjie' => 'required',
				'service_desc' => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'service_name' => '服务名称',	
					'service_jianjie' => '服务简介',	
					'service_desc' => '服务详情',	
				]);     
            $pics = $request->except('_token');
            if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_one'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file1', $pics)) {
                $file = $pics['file1'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_detail_nav'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file2', $pics)) {
                $file = $pics['file2'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_down_one'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file3', $pics)) {
                $file = $pics['file3'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_down_two'] = 'uploads/'.$filename;
            }
            $dudu['service_name'] = $pics['service_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['service_desc'] = $pics['service_desc'];
            $dudu['service_jianjie'] = $pics['service_jianjie'];
            if (Service::create($dudu)) {
                return redirect('service/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/service/add');
    }

    public function edit(Request $request, $id)
    {
        $service = Service::find($id);
        if ($request->isMethod('post')) {
			$this->validate($request, [
			    'service_name'    => 'required',
				'service_jianjie' => 'required',
				'service_desc' => 'required',
				], [
					'required'   => ':attribute 不能为空',
				], [
					'service_name' => '服务名称',	
					'service_jianjie' => '服务简介',	
					'service_desc' => '服务详情',	
				]);     
            $pics = $request->except('_token');
           if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_one'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file1', $pics)) {
                $file = $pics['file1'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_detail_nav'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file2', $pics)) {
                $file = $pics['file2'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_down_one'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file3', $pics)) {
                $file = $pics['file3'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['pic_down_two'] = 'uploads/'.$filename;
            }
            $dudu['service_name'] = $pics['service_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['service_desc'] = $pics['service_desc'];
            $dudu['service_jianjie'] = $pics['service_jianjie'];
            $res = Service::where('id', $id)->update($dudu);
            if ($res) {
                return redirect('service/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/service/edit', compact('service'));
    }

    public function delete(Request $request, $id)
    {
        $res = Service::where('id', $id)->delete();
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
