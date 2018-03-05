<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
class IndexController extends Controller
{
    public function index(){
    	$projects=Project::where('status',1)->take(3)->get();
    	return view('index',['projects'=>$projects]);
    }
    //发送短信验证码
    public function sms($mobile,Request $request){

		//载入ucpass类
		require_once(base_path().'/vendor/alidayu/lib/Ucpaas.class.php');

		//初始化必填
		$options['accountsid']='xxxxxxxxxxxxxxxxxxx';
		$options['token']='xxxxxxxxxxxxxxxxxxx';


		//初始化 $options必填
		$ucpass = new \Ucpaas($options);

		//开发者账号信息查询默认为json或xml
		header("Content-Type:text/html;charset=utf-8");

		//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		$rand=mt_rand(1000,9999);
		$request->session()->put('smscode',$rand);
		$appId = "xxxxxxxxxxxxxxxxxxx";
		$to = $mobile;
		$templateId = "248486";
		$param=$rand;		
	    echo $ucpass->templateSMS($appId,$to,$templateId,$param);
    }
    //检测短信验证码
    public function checkSms(Request $request){
    	return $request->session()->get('smscode');
    }
}
