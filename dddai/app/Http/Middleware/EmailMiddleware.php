<?php

namespace App\Http\Middleware;

use Closure;
// use Nette\Mail\Message;
use Mail;
class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $rs = $next($request);        
       Mail::raw('邮件内容是什么',function($message) use ($request){
            $message->from('1239197795@qq.com','慕课网');
            $message->subject('试试我的中间件');
            $message->to($request->user()->email);
       });



        //1、发送纯文本
        // Mail::raw('邮件内容 是什么',function($message){
        //     $message->from('1239197795@qq.com','慕课网');
        //     $message->subject('邮件主题 怎么样');
        //     $message->to('qwaszx8765@sina.com');

        // });
        //2、引用模板位置
        // Mail::send('student.mail',['name'=>'sean'],function($message){
        //     $message->to('qwaszx8765@sina.com');
        // });
      return $rs;
    }
}
