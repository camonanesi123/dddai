<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

//初始化必填
$options['accountsid']='';
$options['token']='';


//初始化 $options必填
$ucpass = new Ucpaas($options);

//开发者账号信息查询默认为json或xml
header("Content-Type:text/html;charset=utf-8");

//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
$appId = "";
$to = "";
$templateId = "";
$param="";

echo $ucpass->templateSMS($appId,$to,$templateId,$param);