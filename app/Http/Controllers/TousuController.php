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
}
