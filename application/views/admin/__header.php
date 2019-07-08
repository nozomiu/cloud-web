<?php
    if(!isset($this->session->id)){
        header('Location: /');
        exit();
    }
?>
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
	<meta name="generator" content="yun v1.00"/>
	<meta name="author" content="yun" />
	<meta name="copyright" content="yun.com" />
	<meta itemprop="image" content="/static/images/ico.png?ver=v1.00" />
	<link href="/static/images/ico.png?ver=v1.00" rel="Shortcut Icon" type="image/x-icon">
	<link href="/static/images/ico.png?ver=v1.00" rel="icon" type="image/x-icon">
	<link href="/static/css/common.css?ver=v1.00" rel="stylesheet"/>
	<link href="/static/css/font-awesome.css?ver=v1.00" rel="stylesheet">
	<script src="/static/js/jquery-1.10.2.min.js"></script>
	<script src="/static/js/dms/action.js"></script>
    <script src="/static/js/dms/toastr.js"></script>
    <script src="/static/js/dms/myDocumentTree.js"></script>
    <script src="/static/js/dms/orgDocumentTree.js"></script>
    <script src="/static/js/dms/orgSpace.js"></script>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/static/css/font-awesome-ie7.css">
	<![endif]--> 
		<title>文件管理 </title>

	<link rel="stylesheet" href="/static/css/app_explorer.css?ver=v1.00"/>
	<link rel="stylesheet" href="/static/css/win10.css?ver=v1.00" id='link-theme-style'/>
	
</head>

<body style="overflow:hidden;" oncontextmenu="return core.contextmenu();" id="page-explorer">