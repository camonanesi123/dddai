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
            $message->from('xxxxxxxxxx@qq.com','慕课网');
            $message->subject('试试我的中间件');
            $message->to($request->user()->email);
       });      
      return $rs;
    }
}
