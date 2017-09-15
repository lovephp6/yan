<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;
use App\Model\Teacher;
use App\Model\System;
use App\Model\Dian;
use App\Model\Service;
use App\Model\Tousu;
use App\Model\Xiangmu;
use App\Model\Yuyue;

class JuyanController extends Controller
{
    public function index()
    {
	$banners = Banner::where('cate', 1)->orderBy('sort', 'desc')->limit(3)->get();
	$jishis = Teacher::where('status', 1)->orderBy('sort', 'desc')->get();
	$index['banner'] = $banners;
	$index['jishis'] = $jishis;
	return json_encode($index);
    }

    public function intro()
    {
	$banner = Banner::where('cate', 2)->orderBy('updated_at', 'desc')->limit(1)->first();
	$down_pics = Banner::where('cate', 3)->orderBy('sort', 'desc')->limit(4)->get();
	$companyMsgs = System::first();
	$companys['banner'] = $banner;
	$companys['companyMsgs'] = $companyMsgs;
	$companys['down_pics'] = $down_pics;
	return json_encode($companys);
    }

    public function dian()
    {
	$dianBanner = Banner::where('cate', 4)->first();
	$dianMsgs = Dian::orderBy('sort', 'desc')->limit(10)->get();
	$dian['dianBanner'] = $dianBanner;
	$dian['dianMsgs'] = $dianMsgs;
	return json_encode($dian);
    }

    public function service()
    {
	$services = Service::orderBy('sort', 'desc')->limit(10)->get();
	$fuwus['services'] = $services;
	return json_encode($fuwus);
    }

    public function tousu()
    {
	$jishis = \DB::table('teachers')->pluck('name');
	$dianpus = \DB::table('dians')->pluck('dian_title');
	$teacher['jishis'] = $jishis;
	$teacher['dianpus'] = $dianpus;
	return $teacher;
    }
    
    public function tousuMsg()
    {
	$tousuMsg = Tousu::orderBy('created_at', 'desc')->first();
	$tousu['tousuMsg'] = $tousuMsg;
	return json_encode($tousu);
    }

    public function detail($id)
    {
	$fuwu_detail = Service::find($id);
	$fuwu_details['fuwu_detail'] = $fuwu_detail;
	return json_encode($fuwu_details);
    }

    public function teacher($id)
    {
	$teach = Teacher::find($id);
	$fu = \DB::table('xiangmus')->orderBy('created_at', 'desc')->pluck('fuwu');
	$jishis = \DB::table('teachers')->pluck('name');
	$dianpus = \DB::table('dians')->pluck('dian_title');
	$fu_money = \DB::table('xiangmus')->orderBy('created_at', 'desc')->first()->money;
	$teacher['jishis'] = $jishis;
	$teacher['dianpus'] = $dianpus;
	$teacher['teacher'] = $teach;
	$teacher['fuwu'] = $fu;
	$teacher['money'] = $fu_money;
	return json_encode($teacher);
    }
	
    public function getMoney(Request $request)
    {
	if ($request->isMethod('post')){
	    $fuwu = $request->input('fuwu');
		$city = $request->input('city');
	    $mon = Xiangmu::where('fuwu', $fuwu)->first()->money;
		$teachers = Xiangmu::where('fuwu', $fuwu)->first()->teacher;
		$teacher1 = \DB::table('teachers')->where('city', $city)->pluck('name');
		$teach = explode(',', $teachers);
		$aa = $teacher1->toArray();
		$res = array_intersect($teach, $aa);
		if (empty($res)){
			$res = ['暂无技师'];
		}
	    $money['money'] = $mon;
		$money['teachers'] = $res;
	    return json_encode($money);
	}
    }

    // 获取时间
    public function getTime(Request $request)
    {
	if ($request->isMethod('post')){
	   $time = $request->input('sid');
	   return $time; 
	}
    }

    public function yuyue($id)
    {
	$yuyue = Yuyue::find($id);
	$yuyues['name'] = $yuyue->name;
	$yuyues['sid'] = $yuyue->sid;
	$yuyues['date'] = $yuyue->date;
	$yuyues['time'] = $yuyue->time;
	$yuyues['city'] = $yuyue->city;
	$yuyues['tel'] = $yuyue->tel;
	$yuyues['tid'] = $yuyue->tid;
	return json_encode($yuyues);
    }
	
    public function getOpenid(Request $request)
    {	
	$appid = 'wx738e2a1369b847c9';
	$secret = '55e57fa80cb02545f1b8beea38f627a6';
	$code = $request->input('code');
	    $curl = curl_init();
	    $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HEADER,0);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($curl);
	    curl_close($curl);
	return json_decode($data, true);
    }


    public function getpayid(Request $request)
    {
	$total_fee = $request->input('total_fee'); //钱数
	$openid = $request->input('openid');
	$appid= 'wx738e2a1369b847c9';
	$mch_id = '1488891462';  //商户号
	$key = 'qwertyuiopasdfghjklzxcvbnm123456';
	$out_trade_no = $mch_id.time();   //单号
	if (empty($total_fee)) {
	    $body = "预约成功";
	   // $total_fee = floatval(1*100);
	} else {
	    $body = "预约成功";
	   // $total_fee = floatval($total_fee*100);
	}
	
	$weixinpay = new \WeixinPay($appid, $openid, $mch_id, $key, $out_trade_no, $body, $total_fee);
	$return = $weixinpay->pay();
	return json_encode($return);
    }

    public function getMsg()
    {
	$return['return_code'] = 'SUCCESS';
	$return['return_msg'] = 'OK';
	$xml_post = '<xml>
		<return_code>'.$return['return_code'].'</return_code>
		<return_msg>'.$return['return_msg'].'</return_code>
	</xml>';
	echo $xml_post;exit;
    }
    
    public function order(Request $request)
    {
	$openid = $request->input('openid');
	$order = \DB::table('yuyues')->where('openid', $openid)->get();
	$ordermsg['msg'] = $order;
	return json_encode($ordermsg);
    }
    
    public function yanzheng(Request $request)
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
			if (is_null($yumsg))
			{
				$data['message'] = "可以预约";
               	$data['code'] = 200;
               	return $data;
			}
		  	$ready_time = strtotime($yumsg->date. ' '.$yumsg->time);
           	$over_time = $ready_time + $time*60;
           	$qian_time = $ready_time - $time*60;
//			dd(date('Y-m-d H:i:s', $ready_time));
	   		if($yumsg && ($yuyue_time>=$qian_time && $yuyue_time<=$over_time)){
				$data['message'] = '以被预约,请换人或时间';
               	$data['code'] = 400;
               	return json_encode($data);
	   	 	} else{
				$data['message'] = "可以预约";
               	$data['code'] = 200;
               	return $data;
           	}
			
		}
    }

	public function getTeachers(Request $request)
	{
		$jishi = $request->input('name');
		$jsMsg = Teacher::where('name', $jishi)->first();
		return json_encode($jsMsg);
	}

	public function getfuwu(Request $request)
	{
		$city = $request->input('city');
		$fuwu = Dian::where('dian_title', $city)->first()->sid;
		$fuwus = json_encode(explode(',', $fuwu));
		return $fuwus;
	}

	public function message()
	{
		$fu = \DB::table('xiangmus')->orderBy('created_at', 'desc')->pluck('fuwu');
		$jishis = \DB::table('teachers')->pluck('name');
		$dianpus = \DB::table('dians')->pluck('dian_title');
		$fu_money = \DB::table('xiangmus')->orderBy('created_at', 'desc')->first()->money;
		$teacher['jishis'] = $jishis;
		$teacher['dianpus'] = $dianpus;
		$teacher['fuwu'] = $fu;
		$teacher['money'] = $fu_money;
		return json_encode($teacher);
	}

	public function tmsg(Request $request){
		$city = $request->input('city');
		$teacher = \DB::table('teachers')->where('city', $city)->pluck('name');
		$teachers = $teacher->toArray();
		if(empty($teachers)) {
			$teachers = ['此店铺暂无技师'];
		}
		return json_encode($teachers);
	}
}
