<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;
use App\Model\Teacher;
use App\Model\System;
use App\Model\Dian;
use App\Model\Service;
use App\Model\Tousu;

class JuyanController extends Controller
{
    public function index()
    {
	$banners = Banner::where('cate', 1)->orderBy('sort', 'desc')->limit(3)->get();
	$jishis = Teacher::orderBy('sort', 'desc')->get();
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
	$teacher['teacher'] = $teach;
	return json_encode($teacher);
    }
	
}
