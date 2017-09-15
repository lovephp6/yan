<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Yuyue;
use App\Model\Xiangmu;

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
	    $yuyue['openid'] = $request->input('openid');
	    $time = Xiangmu::where('fuwu', $yuyue['sid'])->first()->fuwu_time;
	    $yuyue_time = strtotime($yuyue['date']. ' '. $yuyue['time'].':00');
	    $total_time = ($yuyue_time) + $time*60;  //总共时间
	    $yumsg = Yuyue::where('tid', $yuyue['tid'])->orderBy('created_at', 'desc')->first();
	    if(!$yumsg){
			$res = Yuyue::create($yuyue);
			if($res) {
		    	$data['id'] = $res->id;
		    	$data['message'] = "预约成功";
		    	$data['code'] = 200;
		   		return $data;
			}else{
		    	$data['message'] = "服务器繁忙,稍后重试";
		    	$data['code'] = 400;
		    	return $data;
			}
	    } else {
	    	$ready_time = strtotime($yumsg->date. ' '.$yumsg->time);
        	$over_time = $ready_time + $time*60;
	    	$qian_time = $ready_time - $time*60;
	   		if ($yuyue_time >= $qian_time && $yuyue_time <= $over_time) {
				$data['message'] = '以被预约,请换人或时间'; 
				$data['code'] = 400;
				return json_encode($data);
	    	} else{ 
				$res = Yuyue::create($yuyue);
				if($res) {
		    		$data['id'] = $res->id;
		    		$data['message'] = "预约成功";
		    		$data['code'] = 200;
		    		return $data;
				}else{
		    		$data['message'] = "服务器繁忙,稍后重试";
		    		$data['code'] = 400;;
		    		return $data;
				}	
	    	}
		}
	}
	
    } 

    public function index()
    {
		$yuyues = Yuyue::all();
		return view('admin/yuyue/index',compact('yuyues'));
    }

    public function delete(Request $request, $id)
    {
        $res = Yuyue::where('id', $id)->delete();
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
