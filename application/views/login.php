<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
    	$this->config->load('api');
	    $version  = $this->config->item('version');
        $langs  = $this->config->item('langs');
        $lang = $this->session->lang;
        $this->lang->load('main', $lang);
?>
<!--user login-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta http-equiv="Cache-Control" content="no-transform">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta name="description" itemprop="description" content="">
	<meta name="keywords" content="" />
	<meta name="generator" content=""/>
	<meta name="author" content="" />
	<meta name="copyright" content="" />
	<link href="/statics/images/common/ico.png?ver=<?php echo $version;?>" rel="Shortcut Icon" type="image/x-icon">
	<link href="/statics/images/common/ico.png?ver=<?php echo $version;?>" rel="icon" type="image/x-icon">
	<link href="/statics/style/common.css?ver=<?php echo $version;?>" rel="stylesheet"/>
	<link href="/statics/style/font-awesome/css/font-awesome.css?ver=<?php echo $version;?>" rel="stylesheet">
	<script src="/static/layui/layui.js?ver=<?php echo $version;?>"/></script>
	<!--[if IE 7]>
	<link rel="stylesheet" href="./statics/style/font-awesome/css/font-awesome-ie7.css">
	<![endif]--> 
	<title>登陆</title>
	<link href="/statics/style/login.css?ver=<?php echo $version;?>" rel="stylesheet">
</head>

<body>
<style type='text/css'>.aero:before,.aero:after,.background{background-color:#bbb;background-image:url('./statics/images/wall_page/1.jpg');}</style>
<div class="background"></div>
<div class="loginbox animated-500 fadeInDown aero" >
		<div class="title">
			<div class="logo"><i class="icon-cloud"></i><?php echo $this->lang->line('MName')?></div>
			<!--<div class='info'>——演示账号: </div>-->
		</div>
		<div class="form">
			<form method="post" action="" onsubmit="return false;">
				<div class="inputs">
					<div>
						<i class="font-icon icon-user"></i>
						<input id="loginName" name='loginName' type="text" placeholder="账号" 
						required autocomplete="on" />
					</div>
					<div>
						<i class="font-icon  icon-key"></i>
						<input id="password" name='password' type="password" placeholder="密码" 
						required  autocomplete="on" />
					</div>
					<!--<div>
						<i class="font-icon  icon-key"></i>
						<input id="verify" type="text" name="verify" datatype="*4-4" placeholder="验证码" required autocomplete="on" />
                        <img class="verifyimg reloadverify" src="/T/captcha" alt="点击刷新" style="cursor:pointer"/>
					</div>-->
	            					</div>

				<div class="actions">
					<!--<label for='rm'>
						<input type="checkbox" class="checkbox" name="rememberPassword" id='rm'/>
						记住密码					</label>
					<a href="javascript:void(0);" class="forget-password">忘记密码</a>
					<br/>-->
					<input class="inputtxt" id="loginModel" name="loginModel" value="0" type="hidden">
					<input class="inputtxt" id="loginP" name="loginP" value="1" type="hidden">
					<input type="submit" id="submit" value="登录" />
				</div>
				
				<div class="msg"></div>

							</form>
		</div>
	</div>

<script type="text/javascript" src="/static/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
<script type="text/javascript" src="/admin/g/commonjs"></script>
<style type="text/css" id="setting-system-global-css"></style>
<script type="text/javascript">
    $(function(){
        $('.reloadverify').click(function(){
            $('.verifyimg').attr('src', "/T/captcha?" + Math.random());
        });
    })
</script>
<script type="text/javascript">
		seajs.config({
		base: "/statics/js/",
		preload: [
			"lib/jquery-1.8.0.min",
		],
		map:[
			[ /^(.*\.(?:css|js))(.*)$/i,'$1$2']
		]
	});
</script>
<script>
layui.use(['layer'], function(){
  var layer = layui.layer;
});
</script>
	<script type="text/javascript">
	
	$('#submit').click(function(){
		var loginName = encodeURIComponent($("input[name='loginName']").val());
		var password = encodeURIComponent($("input[name='password']").val());
		var loginModel = $("input[name='loginModel']").val();
		var loginP = $("input[name='loginP']").val();
		//var verify = encodeURIComponent($("input[name='verify']").val());
		if(loginName == '' || password == ''){
			layer.msg('账号密码不能为空');
			return;
		}
		//if(verify == ''){
		//	layer.msg('请输入验证码');
		//	return;
		//}
		$.ajax({
				type : "POST",
				url :"/user/index",
				data : {
					'loginName':loginName,
					'password': password,
					'loginModel':loginModel,
					'loginP':loginP,
					//'verify':verify
				},
				dataType: 'json',
				crossDomain: true,
				success : function(result){
					if(result.code == 200){
						window.location.href = '/admin/home';
					}else{
						var tips = '';
						if(result.code == 444){
							tips = '验证码错误';
						}
						if(result.code == 1001){
							tips = '没有登陆权限！';
						}
						if(result.code == 2002){
							tips = '登录名无效，请重试！';
						}
						if(result.code == 2003){
							tips = '用户已关闭！';
						}
						if(result.code == 2004){
							tips = '密码错误，请重试！';
						}
						if(result.code == 2007){
							tips = '用户未加入组织！';
						}
					layer.msg(tips);
					$("input[name='password']").val('');
					return;
					}
				}

			});

	});

</script>
</body>
</html>