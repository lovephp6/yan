<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Yuyue;

class YuyueController extends Controller
{
    public function add(Request $request)
    {
	if($request->isMethod('post')){
	    $yuyue['tid'] = $request->input('tid');	
	    $yuyue['sid'] = $request->input('sid');	
	    $yuyue['city'] = $request->input('city');	
	    $yuyue['date'] = $request->input('date');	
	    $yuyue['time'] = $request->input('time');	
	    $yuyue['name'] = $request->input('name');	
	    $yuyue['address'] = $request->input('address')+1;  // 预约人数	
	    $yuyue['other'] = $request->input('other');	
	    $yuyue['tel'] = $request->input('tel');	
	    $yuyue['status'] = $request->input('status');	
	    $yuyue['money'] = $request->input('money');	
	    Yuyue::create($yuyue);
	}
	
    } 
}
