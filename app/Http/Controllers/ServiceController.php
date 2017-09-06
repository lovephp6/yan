<?php

namespace App\Http\Controllers;

use App\Model\Service;
use Illuminate\Http\Request;

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
            $pics = $request->except('_token');
            $file = $pics['file'];
            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
            $file->move(app_path(). '../../public/uploads', $filename);
            $dudu['pic_one'] = 'uploads/'.$filename;
            $dudu['service_name'] = $pics['service_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['service_desc'] = $pics['service_desc'];
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
            $pics = $request->except('_token');
            $file = $pics['file'];
            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
            $file->move(app_path(). '../../public/uploads', $filename);
            $dudu['pic_one'] = 'uploads/'.$filename;
            $dudu['service_name'] = $pics['service_name'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['service_desc'] = $pics['service_desc'];
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
