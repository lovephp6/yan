<?php

namespace App\Http\Controllers;

use App\Model\Tousu;
use Illuminate\Http\Request;

class TousuController extends Controller
{
    public function add(Request $request)
    {
	$dudu['name'] = $request->input('name');
	$dudu['desc']= $request->input('desc');
	$dudu['tid'] = $request->input('tid');
	$dudu['sid'] = $request->input('sid');
	$dudu['tel'] = $request->input('tel');
	$dudu['status'] = $request->input('status');
	Tousu::create($dudu);
	
    }

    public function index()
    {
        $tousus = Tousu::orderBy('created_at', 'desc')->get();
        return view('admin/tousu/index', compact('tousus'));
    }

    public function delete(Request $request, $id)
    {
        $res = Tousu::where('id', $id)->delete();
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
