<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Att;
class CheckController extends Controller
{
    public function prolist(){
        //取出所有项目 供管理员审核
       $projects= Project::orderBy('pid','desc')->get();
       return view('prolist',['projects'=>$projects]);
    }
    //审核项目 主要是修改projects表
    public function check($pid){
        $project=Project::find($pid);//find只能查主键
        $att=Att::where('pid',$pid)->first();
        if(empty($project)){
            return redirect('/prolist');
        }
        return view('shenhe',['project'=>$project,'att'=>$att]);
    }
    //审核数据update到数据库
    public function checkPost($pid,Request $request){
        $project=Project::find($pid);//find只能查主键
        $att=Att::where('pid',$pid)->first();
        if(empty($project)){
            return redirect('/prolist');
        }
        $project->title=$request->title;        
        $project->hrange=$request->hrange;
        $project->rate=$request->rate;//百分比
        $project->status=$request->status;
  
        $att->udesc=$request->udesc;       
        $att->realname=$request->realname;
        $att->gender=$request->gender;
        if($project->save() && $att->save()){
             return redirect('/prolist');
         }else{
            return 'error';
         }
    }
}
