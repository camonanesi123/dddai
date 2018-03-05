<div class="niwdoawi_top mw_1180">
    <div class="header w1190 clearfix">
        <div class="fl tel">
            <em class="fs_14 mr_5 tel_ico">客服热线</em><i class="aril">010-57155250</i>
                    
            <span class="iphone"><i></i>
            <a target="_blank" href="#">手机客户端</a>
            <div class="webdown"></div>
            </span>
            <span class="hover_sina">
                <a target="_blank" href="#"></a>
            </span>
            <span class="fs_12 ml_10">市场有风险，投资需谨慎</span>
        </div>
        <div class="fr login clearfix">
            <div class="login_bt">
               @if(!\Auth::user())
                <a class="fff" title="登录" rel="nofollow" href="/auth/login">登录</a>
                <a class="fff" title="注册" rel="nofollow" href="/auth/register">注册</a>
               @else
                
                <em class="fff fs_12">您好，</em><a href="#" rel="nofollow" class="hello">{{\Auth::user()->name}}</a>
                <a href="/auth/logout" id="loginOut" class="hello">退出</a>
                <dl>
	                <dt><a class="txnone" rel="nofollow" title="账户中心" href="/home">账户中心</a></dt>
	                <dd><a title="充值" rel="nofollow" href="#">充值</a></dd>
	                <dd><a title="提现" rel="nofollow" href="#">提现</a></dd>
	                <dd><a title="我的投资" rel="nofollow" href="#">我的投资</a></dd>
	                <dd><a title="我的借款" rel="nofollow" target="_blank" href="#">我的借款</a></dd>
	            </dl>
	            @endif
            </div>


            
           
            <div class="community"><a class="fc_white" rel="nofollow" target="_blank" href="#">关于我们</a></div>
        </div>
    </div>
</div><!--登录-->
<div class="niwdoawi_center mw_1180">
    <div class="w1190 logo clearfix">
    <a class="fl pl_20 logo_a holiday_logo" title="给梦想可能" href="#"><img height="52" alt="点点贷" src="/image/logo_all.png"></a>
        <div class="fl logo_aft">
            <div id="headLogo" class="pos_aft">
                        <a href="#" class="defaultlogo"><img src="/image/logo1200.png"></a>
            </div>
        </div>
        <div class="fr righ"> 
            <ul class="nav clearfix">
                <li>
                    <a class="one" title="首页" href="/" rel="nofollow">首页</a>
                </li>
                <li class="one">
                    <a class="one" title="我要投资" href="/">我要投资</a>
                </li>
                <li class="rela">
                    <a class="one" title="我要借款" href="/jie">我要借款</a>
                </li>
                <li class="rela">
                    <a class="one" title="新手导航" target="_blank" href="http://www.zixue.it">新手导航 </a>
                </li>
                <li style="margin-right:0;">
                    <a class="one" title="社区" target="_blank" href="http://www.zixue.it">社区 </a>
                </li>
            </ul>
        </div>
    </div>
</div><!--nav-->
<!-- 头部结束 -->