<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta itemprop="image" content="/statics/common/images/ico.png" />
<link href="/statics/images/common/ico.png" rel="Shortcut Icon" type="image/x-icon">
<link href="/statics/images/common/ico.png" rel="icon" type="image/x-icon">
<title>登录</title>
<link rel="stylesheet" type="text/css" href="/static/css/site.css">
<link rel="stylesheet" type="text/css" href="/static/css/login.css">

</head>

<body>
	<style type="text/css">
		@media screen and (max-width: 640px) {
		    .scanCode{
		    	display: none;
		    }
		    .account{
		    	display: block !important;
		    }
		    .bg_img{
		    	display: none;
		    }
		}
		.bg_img{
			width: 60px;
			height: 60px;
			background-image: url('/static/img/qrCode.png');
			background-size: 120px 120px;
			background-repeat: no-repeat;
			background-position: 0 0;
			position: absolute;
			top: 5px;
			right: 5px;
		}
		.bg_img:hover{
			background-position: -60px 0;
			cursor: pointer;
			/*transition: all 500ms;*/
		}
		.bg_img.pc{
			background-position: 0 -60px;
		}
		.bg_img.pc:hover{
			background-position: -60px -60px;
		}
		.qrCode{
			text-align: center;
			padding-top: 20px;
		}
		.scanCode .titles{
			font-size: 23px;
			margin-top: 25px;
			color: #444;
			text-align: center;
		}
		.list_scan{
			width: 150px;
			margin: 0 auto; 
			margin-top: 15px;
		}
		.list_scan>img{
			width: 40px;
			height: 40px;
			float: left;
			margin-right: 15px;
		}
		.list_scan span{
			display: inline-block;
			font-size: 13px;
			margin-bottom: 5px;
		}
		.list_scan a:hover .weChatSamll{
			display: block;
		}
		.list_scan .weChatSamll{
			display: none;
			width: 150px;
			height: 150px;
			position: absolute;
			border: 1px solid #ececec;
			border-radius: 5px;
			bottom: 105px;
			right: 80px;
			padding: 20px;
			background-color: #fff;
		}
		.list_scan .weChatSamll img{
			width: 100%;
		}
		.list_scan .weChatSamll em{
			position: absolute;
			border: 7px solid #ececec;
			border-color: #ececec transparent transparent transparent;
			width: 0;
			height: 0;
			right: 87px;
			bottom: -14px;
			margin-left: -6px;
		}
		.tips{
			width: 115px;
			position: absolute;
			top: 10px;
			right: 65px;
			color: rgb(32, 165, 58);
			background: #dff0d8;
			padding: 5px 10px;
			text-align: center;
			border-radius: 4px;
		}
		.tips em{
			position: absolute;
			border: 6px solid #dff0d8;
			border-color:transparent  transparent transparent #dff0d8; 
			width: 0;
			height: 0;
			right: -11px;
			top: 8px;
			margin-left: -6px;
		}
		.tips img{
			height: 16px;
			width: 16px;
			vertical-align: middle;
			margin-top: -1px;
			margin-right: 4px;
		}
		.main .login .rlogo{
			margin-top: 15px;
			margin-bottom: 25px;
		}
	</style>
<div class="main">
	<div class="login">
		<div class="account">
			<form class="loginform" method="post" action="" onsubmit="return false;">
			<div class="rlogo">登录</div>
			<div class="line"><input class="inputtxt" value="" id="loginName" name="loginName" datatype="*" nullmsg="请填写账号" errormsg="格式不对" placeholder="账号" type="text"><div class="Validform_checktip"></div></div>
			<div class="line"><input class="inputtxt "id="password" name="password" value="" datatype="*" nullmsg="请填写密码" errormsg="请填写密码" placeholder="密码" type="password"><div class="Validform_checktip"></div></div>
			<div style="color: red;position: relative;top: -14px;" id="errorStr"></div>
            <input class="inputtxt" id="loginModel" name="loginModel" value="0" type="hidden">
			<div class="login_btn"><input id="login-button" value="登录" type="submit"></div>
			<p class="pwinfo" style="display:none">3次以上登录错误将会出现验证码</p>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/Validform_v5.3.2_min.js"></script>
<script>
	layui.use('layer');
</script>
	<script type="text/javascript">
	$(function(){
		$(".loginform").Validform({
			tiptype:function(msg,o,cssctl){
				if(!o.obj.is("form")){
					var objtip=o.obj.siblings(".Validform_checktip");
					cssctl(objtip,o.type);
					objtip.text(msg);
				}
			}
		});
	});
	
	$('#login-button').click(function(){
		var loginName = encodeURIComponent($("input[name='loginName']").val());
		var password = encodeURIComponent($("input[name='password']").val());
		var loginModel = $("input[name='loginModel']").val();
		if(loginName == '' || password == ''){
			layer.msg("账号密码不能为空",{icon:2});
			return;
		}
				
		var data = 'loginName='+loginName+'&password='+password+'&loginModel='+loginModel;
		var loadT = layer.msg("正在登录...",{icon:16,time:0,shade: [0.3, '#000']});
		$.ajax({
				type : "POST",
				url :"/user/index",
				data : {
					'loginName':loginName,
					'password': password,
					'loginModel' : loginModel
				},
				dataType: 'json',
				crossDomain: true,
				success : function(result){
				layer.close(loadT);
					if(result.code == 200){
						//alert(result.code);
						window.location.href = '/admin/home';
					}else{
						var tips = '';
						if(result.code == 1001){
							tips = '没有权限';
						}
						if(result.code == 2102){
							tips = '登录名无效';
						}
						if(result.code == 2003){
							tips = '用户已关闭';
						}
						if(result.code == 2004){
							tips = '密码错误';
						}
						if(result.code == 2007){
							tips = '用户未加入组织';
						}
					$("#errorStr").html(tips);
					$("input[name='password']").val('');
					layer.msg(tips,{icon:2,time:5000});
					return;
					}
				}

			});

	});

</script>
</body>
</html>