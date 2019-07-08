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
	<script type="text/javascript" src="/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/dms/action.js"></script>
	<script src="/static/layui/layui.js?ver=<?php echo $version;?>"/></script>
	<!--[if IE 7]>
	<link rel="stylesheet" href="./statics/style/font-awesome/css/font-awesome-ie7.css">
	<![endif]--> 
	<title><?php echo $this->lang->line('title');?></title>
	<link href="/statics/style/login.css?ver=<?php echo $version;?>" rel="stylesheet">
</head>

<body>
<style type='text/css'>.aero:before,.aero:after,.background{background-color:#bbb;background-image:url('/statics/images/wall_page/1.jpg');}</style>
<div class="background"></div>
<div class="loginbox animated-500 fadeInDown aero" >
		<div class="title">
			<div class="logo"><i class="icon-cloud"></i><?php echo $this->lang->line('MName')?></div>
		</div>
		<div class="form">
			<form method="post" action="" onsubmit="return false;">
				<div class="inputs">
					<div>
						<i class="font-icon  icon-key"></i>
						<input id="password" name='password' type="password" placeholder="密码" 
						required  autocomplete="on" />
					</div>
	            	</div>

				<div class="actions">
					<input class="inputtxt" id="loginModel" name="loginModel" value="0" type="hidden">
					<input type="submit" id="submit" value="登录" onclick="pwdLogin()"/>
				</div>
				
				<div class="msg"></div>

							</form>
		</div>
	</div>

<script type="text/javascript" src="/static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
<script type="text/javascript" src="/admin/g/commonjs"></script>
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
<script>
    var cid = '<?php echo $this->input->get('cid');?>';
    function pwdLogin() {
        var params = {};
        params.cid = cid;
        params.password = $("#password").val();
        commobj.doPost(G.paths+'curl/loginpwd', params, false,function(result){
            if(result.code == 200) {
                window.location.href='/c?cid='+cid+'&sessionid='+result.data;
            }else{
            	layer.msg(result.message);
            }
        });
    }

</script>

</body>
</html>