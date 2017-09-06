<?php

namespace App\Http\Controllers;

use App\Model\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin/teacher/index', compact('teachers'));
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
                $dudu['picture'] = 'uploads/'.$filename;
            }
            $dudu['name'] = $pics['name'];
            $dudu['title'] = $pics['title'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['desc'] = $pics['desc'];
            if (Teacher::create($dudu)) {
                return redirect('teacher/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/teacher/add');
    }

    public function edit(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if ($request->isMethod('post')) {
            $pics = $request->except('_token');
           if (array_key_exists('file', $pics)) {
                $file = $pics['file'];
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s'). uniqid(). '.' . $ext;
                // $file->move(app_path(). '../../public/uploads', $filename);
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($path));
                $dudu['picture'] = 'uploads/'.$filename;
            }
            $dudu['name'] = $pics['name'];
            $dudu['title'] = $pics['title'];
            $dudu['sort'] = $pics['sort'];
            $dudu['status'] = $pics['status'];
            $dudu['desc'] = $pics['desc'];
            $res = Teacher::where('id', $id)->update($dudu);
            if ($res) {
                return redirect('teacher/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '添加失败');
            }
        }
        return view('admin/teacher/edit', compact('teacher'));
    }

    public function delete(Request $request, $id)
    {
        $res = Teacher::where('id', $id)->delete();
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
