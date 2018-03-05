<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Att;
use App\Bid;
use Validator;
use DB;
class ProController extends Controller
{
    protected $middleware=['App\Http\Middleware\Authenticate'=>[]];
    public function jie(){
        return view('woyaojiekuan');
    }
    public function jiePost(Request $request){
        // $this->validate($request,[
        //   'age'=>'required|in:15,40,80',
        //   'money'=>'required|digits_between:2,7',
        //   'mobile'=>'required|regex:/^1[3578]\d{9}$/'
        // ],[
        // 'required'=>':attribute 必须填写',
        // 'in'=>':attribute 必须是 :values 之一',
        // 'regex'=>':attribute 不合要求',
        // 'money.digits_between'=>'填的啥玩意'
        //  ]);
       $validate=Validator::make($request->all(),[
          'age'=>'required|in:15,40,80',
          'money'=>'required|digits_between:2,7',
          'mobile'=>'required|regex:/^1[3578]\d{9}$/'
          ],[
              'required'=>':attribute 必须填写',
              'in'=>':attribute 必须是 :values 之一',
              'regex'=>':attribute 不合要求',
              'money.digits_between'=>'填的啥玩意'
          ]);
       if($validate->fails()){
          return back()->withErrors($validate)->withInput();
       }
        $project=new Project();
        $att=new Att();
        //把收到的借款金额转为分
        $user=$request->user();
        
        $project->uid=$user->uid;
        $project->money=intval($request->money)*100;
        $project->mobile=$request->mobile;
        $project->name=$user->name;
        $project->pubtime=time();
        $project->save();

        $att->uid=$user->uid;
        $att->pid=$project->pid;
        $att->age=$request->age;
        $att->save();
        echo 'ok';
    }
    public function project($pid){
        $project=Project::find($pid);
        return view('project',['project'=>$project]);
    }
    public function touzi(Request $request,$pid){
        //dd($_POST);
        //判断平台回来的post是否合法
        $md5=$request->v_oid.$request->v_status.$request->v_amount.$request->v_moneytype.'%()#QOKFDLS:1*&U';
        $md5=strtoupper(md5($md5));
        if($md5!==$request->v_md5str){
          return '签名错误';
        }
        $bid = new Bid();
        $project=Project::find($pid);
        $user=$request->user();
        $bid->uid=$user->uid;
        $bid->pid=$pid;
        $bid->title=$project->title;
        $bid->money=$request->v_amount*100;
        $bid->pubtime=time();
        $bid->save();
        
        $project->receive=$project->receive+$bid->money;
        $project->save();

        if($project->receive==$project->money){
            $this->touziDone($pid);
        }
        return '投标成功';
    }
    protected function touziDone($pid){
        //1、修改项目为2，还款收益中
        $project=Project::find($pid);
        $project->status=2;
        $project->save();
        //为借款者生成还款记录
        //按月循环 生成还款记录
      $amount=( $project->money*$project->rate/100)/12+$project->money/$project->hrange;//每月利息
      $today=date('Y-m-d');
      $row=[
            'uid'=>$project->uid,
            'pid'=>$project->pid,
            'title'=>$project->title,
            'amount'=>$amount,
            'status'=>0,
      ];
      for($i=1;$i<=$project->hrange;$i++){
        $paydate=date('Y-m-d',strtotime("+$i months"));//当前时间加一个月
        $row['paydate']=$paydate;
        DB::table('hks')->insert($row);
      }        
      //2、为投资者生成收益打款任务
      $bids=Bid::where('pid',$pid)->get();
      $row=[];
      $row['pid']=$pid;
      $row['title']=$project->title;
      $row['enddate']=date('Y-m-d',strtotime("+ {$project->hrange} months"));//算出结束日期
      foreach ($bids as $bid) {
         $row['uid']=$bid->uid;
         $row['amount']=$bid->money*$project->rate/100/365;
         DB::table('tasks')->insert($row);
      }
    }
    //生成借款者的账单
    public function myzd(){
      $uid = \Auth::user()->uid;
      $hks=DB::table('hks')->where('uid',$uid)->paginate(2);
      return view('myzd',['hks'=>$hks]);
    }
    //生成供投资者查看的投资列表
    public function mytz(){
        $user=\Auth::user();
        $bids=Bid::where('bids.uid',$user->uid)->join('projects','bids.pid','=','projects.pid')->whereIn('status',[1,2,3])->get(['bids.*','projects.status']);//里面没有status
        return view('mytz',['bids'=>$bids]);
    }
    public function mysy(){
         $user=\Auth::user();
         $grows=DB::table('grows')->where('uid',$user->uid)->orderBy('gid','desc')->get();
         return view('mysy',['grows'=>$grows]);
    }
    public function pay(Request $request){
        $row=[];
        $row['v_amount']=sprintf('%.2f',$request->money);
        $row['v_moneytype']='CNY';
        $row['v_oid']=date('YmdHis').mt_rand(1000,9999);//拼接一个三位随机数
        $row['v_mid']='20272562';
        $row['v_url']='http://ddd.com/touzi/'.$request->pid;
        $row['key']='%()#QOKFDLS:1*&U';
        $row['v_md5info']=strtoupper(md5(implode('',$row)));//字符串拼接
        return view('pay',$row);
    }
}
