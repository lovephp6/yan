<?php

namespace App\Http\Controllers;

use App\Model\Dian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DianController extends Controller
{
    public function index()
    {
        $dians = Dian::all();
        return view('admin/dian/index', compact('dians'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $pics = $request->except('_token');
            if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['dian_pic'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file2', $pics)) {
                $file2 = $pics['file2'];
                $ext = $file2->getClientOriginalExtension();
                $path = $file2->getRealPath();
                $filename2 = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file2->move(app_path(). '../../public/uploads', $filename2);
                $bool = Storage::disk('uploads')->put($filename2, file_get_contents($path));
                $dudu['dian_code'] = 'uploads/'.$filename2;
            }
            $dudu['dian_title'] = $pics['dian_title'];
            $dudu['dian_address'] = $pics['dian_address'];
            $dudu['dian_tel'] = $pics['dian_tel'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            if (Dian::create($dudu)) {
                return redirect('dian/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/dian/add');
    }

    public function edit(Request $request, $id)
    {
        $dian = Dian::find($id);
        if ($request->isMethod('post')) {
            $pics = $request->except('_token');
            if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['dian_pic'] = 'uploads/'.$filename;
            }
            if (array_key_exists('file2', $pics)) {
                $file2 = $pics['file2'];
                $ext = $file2->getClientOriginalExtension();
                $path = $file2->getRealPath();
                $filename2 = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file2->move(app_path(). '../../public/uploads', $filename2);
                $bool = Storage::disk('uploads')->put($filename2, file_get_contents($path));
                $dudu['dian_code'] = 'uploads/'.$filename2;
            }
            $dudu['dian_title'] = $pics['dian_title'];
            $dudu['dian_address'] = $pics['dian_address'];
            $dudu['dian_tel'] = $pics['dian_tel'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $res = Dian::where('id', $id)->update($dudu);
            if ($res) {
                return redirect('dian/index')->with('success', '修改成功');
            } else {
                return redirect()->back()->with('error', '修改失败');
            }
        }
        return view('admin/dian/edit', compact('dian'));
    }

    public function delete(Request $request, $id)
    {
        $res = Dian::where('id', $id)->delete();
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
