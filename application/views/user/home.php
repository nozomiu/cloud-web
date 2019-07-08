<?php
    if(!isset($this->session->id)){
        header('location:/login');
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
	<meta name="generator" content="KodExplorer v1.00"/>
	<meta name="author" content="KodExplorer" />
	<meta name="copyright" content="kodcloud.com" />
	<meta itemprop="image" content="./static/images/common/ico.png?ver=v1.00" />
	<link href="./static/images/common/ico.png?ver=v1.00" rel="Shortcut Icon" type="image/x-icon">
	<link href="./static/images/common/ico.png?ver=v1.00" rel="icon" type="image/x-icon">
	<link href="./static/css/common.css?ver=v1.00" rel="stylesheet"/>
	<link href="./static/css/font-awesome.css?ver=v1.00" rel="stylesheet">
	<!--[if IE 7]>
	<link rel="stylesheet" href="./static/css/font-awesome-ie7.css">
	<![endif]--> 
		<title>文件管理 </title>

	<link rel="stylesheet" href="./static/css/app_explorer.css?ver=v1.00"/>
	<link rel="stylesheet" href="./static/css/mac.css?ver=v1.00" id='link-theme-style'/>
	
</head>

<style>
</style>


<body style="overflow:hidden;" oncontextmenu="return core.contextmenu();" id="page-explorer">
	<div class="full-background"></div>
<div class="init-loading">
	<div><img src="./static/images/common/loading_simple.gif?v=v1.00"/></div>
</div>
<div class="topbar aero">
	<div class="content">
		<button class="btn btn-wap-menu hidden"
			data-toggle="collapse" data-target="#top-menu-left" 
		><i class="font-icon icon-reorder"></i></button>

		<div class="top-left collapse" id="top-menu-left">
			<a href="./" class="topbar-menu title"><i class="icon-cloud"></i>KodExplorer</a><a class='topbar-menu ' href='index.php?desktop' target='_self'><i class='font-icon menu-desktop'></i><span>桌面</span></a><a class='topbar-menu this' href='index.php?explorer' target='_self'><i class='font-icon menu-explorer'></i><span>文件管理</span></a><a class='topbar-menu ' href='index.php?editor' target='_self'><i class='font-icon menu-editor'></i><span>编辑器</span></a><a class='topbar-menu ' href='http://kodcloud.com/' target='_blank'><i class='icon-home'></i> 官网</a>
					</div>
		<div class="top-right">
						<div class="menu-group">
				<a id='topbar-language' data-toggle="dropdown" href="#" class="topbar-menu">
				<i class='font-icon icon-flag'></i>&nbsp;<b class="caret"></b>
				</a>
				<ul class="dropdown-menu topbar-language pull-right animated menuShow" role="menu" aria-labelledby="topbar-language">
				  	<li><a href='javascript:core.language("en");' title="en/英语/English" class=''><i class='lang-flag flag-en'></i>English</a></li><li><a href='javascript:core.language("zh-CN");' title="zh-CN/简体中文/Simplified Chinese" class='this'><i class='lang-flag flag-zh-CN'></i>简体中文</a></li><li><a href='javascript:core.language("zh-TW");' title="zh-TW/繁體中文/Traditional Chinese" class=''><i class='lang-flag flag-zh-TW'></i>繁體中文</a></li><li><a href='javascript:core.language("ar");' title="ar/'阿拉伯语/Arabic" class=''><i class='lang-flag flag-ar'></i>العربية</a></li><li><a href='javascript:core.language("bg");' title="bg/保加利亚语/Bulgarian" class=''><i class='lang-flag flag-bg'></i>Български</a></li><li><a href='javascript:core.language("bn");' title="bn/孟加拉语/Bengali" class=''><i class='lang-flag flag-bn'></i>বাংলা</a></li><li><a href='javascript:core.language("ca");' title="ca/加泰罗尼亚语/Catalan" class=''><i class='lang-flag flag-ca'></i>Català</a></li><li><a href='javascript:core.language("cs");' title="cs/捷克语/Czech" class=''><i class='lang-flag flag-cs'></i>Čeština</a></li><li><a href='javascript:core.language("da");' title="da/丹麦语/Danish" class=''><i class='lang-flag flag-da'></i>Dansk</a></li><li><a href='javascript:core.language("de");' title="de/德语/German" class=''><i class='lang-flag flag-de'></i>Deutsch</a></li><li><a href='javascript:core.language("el");' title="el/希腊语/Greek" class=''><i class='lang-flag flag-el'></i>Ελληνικά</a></li><li><a href='javascript:core.language("es");' title="es/西班牙语/Spanish" class=''><i class='lang-flag flag-es'></i>Español</a></li><li><a href='javascript:core.language("et");' title="et/爱沙尼亚语/Estonian" class=''><i class='lang-flag flag-et'></i>Eesti</a></li><li><a href='javascript:core.language("fa");' title="fa/波斯语/Persian" class=''><i class='lang-flag flag-fa'></i>فارسی</a></li><li><a href='javascript:core.language("fi");' title="fi/芬兰语/Finnish" class=''><i class='lang-flag flag-fi'></i>suomen</a></li><li><a href='javascript:core.language("fr");' title="fr/法语/French" class=''><i class='lang-flag flag-fr'></i>Français</a></li><li><a href='javascript:core.language("gl");' title="gl/加利西亚语/Galician" class=''><i class='lang-flag flag-gl'></i>Galego</a></li><li><a href='javascript:core.language("hi");' title="hi/印地语/Hindi" class=''><i class='lang-flag flag-hi'></i>हिन्दी</a></li><li><a href='javascript:core.language("hr");' title="hr/克罗地亚语/Croatian" class=''><i class='lang-flag flag-hr'></i>Hrvatski</a></li><li><a href='javascript:core.language("hu");' title="hu/匈牙利语/Hungarian" class=''><i class='lang-flag flag-hu'></i>Magyar</a></li><li><a href='javascript:core.language("id");' title="id/印尼语/Indonesian" class=''><i class='lang-flag flag-id'></i>Bahasa Indonesia</a></li><li><a href='javascript:core.language("it");' title="it/意大利语/Italian" class=''><i class='lang-flag flag-it'></i>Italiano</a></li><li><a href='javascript:core.language("ja");' title="ja/日语/Japanese" class=''><i class='lang-flag flag-ja'></i>日本語</a></li><li><a href='javascript:core.language("ko");' title="ko/韩语/Korean" class=''><i class='lang-flag flag-ko'></i>한국어</a></li><li><a href='javascript:core.language("lt");' title="lt/立陶宛语/Lithuanian" class=''><i class='lang-flag flag-lt'></i>Lietuvių</a></li><li><a href='javascript:core.language("nl");' title="nl/荷兰语/Dutch" class=''><i class='lang-flag flag-nl'></i>Nederlands</a></li><li><a href='javascript:core.language("no");' title="no/挪威语/Norwegian" class=''><i class='lang-flag flag-no'></i>Norsk</a></li><li><a href='javascript:core.language("pl");' title="pl/波兰语/Polish" class=''><i class='lang-flag flag-pl'></i>Polski</a></li><li><a href='javascript:core.language("pt");' title="pt/葡萄牙语/Portuguese" class=''><i class='lang-flag flag-pt'></i>Português</a></li><li><a href='javascript:core.language("ro");' title="ro/罗马尼亚语/Romanian" class=''><i class='lang-flag flag-ro'></i>Limba Română</a></li><li><a href='javascript:core.language("ru");' title="ru/俄语/Russian" class=''><i class='lang-flag flag-ru'></i>Русский язык</a></li><li><a href='javascript:core.language("si");' title="si/僧伽罗语/Sinhala" class=''><i class='lang-flag flag-si'></i>සිංහල</a></li><li><a href='javascript:core.language("sk");' title="sk/捷克斯洛伐克语/Czechoslovakia" class=''><i class='lang-flag flag-sk'></i>Slovenčina</a></li><li><a href='javascript:core.language("sl");' title="sl/斯洛文尼亚语'/Slovenian" class=''><i class='lang-flag flag-sl'></i>Slovenski</a></li><li><a href='javascript:core.language("sr");' title="sr/塞尔维亚语/Serbian" class=''><i class='lang-flag flag-sr'></i>Српски</a></li><li><a href='javascript:core.language("sv");' title="sv/瑞典语/Swedish" class=''><i class='lang-flag flag-sv'></i>Svenska</a></li><li><a href='javascript:core.language("ta");' title="ta/泰米尔语/Tamil" class=''><i class='lang-flag flag-ta'></i>த‌மிழ்</a></li><li><a href='javascript:core.language("th");' title="th/泰语/Thai" class=''><i class='lang-flag flag-th'></i>ภาษาไทย</a></li><li><a href='javascript:core.language("tr");' title="tr/土耳其语/Turkish" class=''><i class='lang-flag flag-tr'></i>Türkçe</a></li><li><a href='javascript:core.language("uk");' title="uk/乌克兰语/Ukrainian" class=''><i class='lang-flag flag-uk'></i>Українська</a></li><li><a href='javascript:core.language("uz");' title="uz/乌兹别克语/Uzbek-cyrillic" class=''><i class='lang-flag flag-uz'></i>O'zbekiston</a></li><li><a href='javascript:core.language("vi");' title="vi/越南语/Vietnamese" class=''><i class='lang-flag flag-vi'></i>Tiếng Việt</a></li>				</ul>
			</div>
						<!-- 全局设置语言则不再显示 -->
			
			<div class="menu-group">
				<a href="#" id='topbar-user' data-toggle="dropdown" class="topbar-menu">
					<i class="font-icon icon-user"></i>
					demo&nbsp;
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu menu-topbar-user pull-right animated menuShow" role="menu" aria-labelledby="topbar-user">
					
											

					<li class="menu-system-user"><a href="#" onclick="core.setting('user');"><i class="font-icon icon-user"></i>个人中心</a></li>
					<li class="menu-system-theme"><a href="#" onclick="core.setting('theme');"><i class="font-icon icon-dashboard"></i>主题设置</a></li>
					<li class="menu-system-full"><a href="#" onclick="core.fullScreen();"><i class="font-icon icon-fullscreen"></i>全屏</a></li>
					<li class="menu-system-help"><a href="#" onclick="core.setting('help');"><i class="font-icon icon-question"></i>使用帮助</a></li>
					<li class="menu-system-about"><a href="#" onclick="core.setting('about');"><i class="font-icon icon-info-sign"></i>关于作品</a></li>
					<li role="presentation" class="divider"></li>
					<li class="menu-system-logout"><a href="./index.php?user/logout"><i class="font-icon icon-signout"></i>退出</a></li>
				</ul>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
</div>
	<div class="frame-main">
	<div class='frame-left'>
		<ul id="folder-list-tree" class="ztree"></ul>
		<div class="bottom-box">
			<div class="user-space-info"></div>
			<div class="box-content">
				<div class="cell menu-recycle-button"><i class="font-icon icon-trash"></i><span>回收站</span></div>
				<div class="cell menuShareButton"><i class="font-icon icon-share-sign"></i><span>我的分享</span></div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div><!-- / frame-left end-->
	
	<div class='frame-resize'></div>
	<div class='frame-right'>
		<div class="frame-header">
			<div class="header-content">
				<div class="header-left">
					<div class="btn-group btn-group-sm">
						<button class="btn btn-default" id='btn-history-back' title='后退' type="button">
							<i class="font-icon icon-angle-left"></i>
						</button>
						<button class="btn btn-default" id='btn-history-next' title='前进' type="button">
							<i class="font-icon icon-angle-right"></i>
						</button>
					</div>
				</div><!-- /header left -->

				<div class='header-middle'>
					<button class="btn btn-default btn-left-radius ml-10" id='home' title='我的文档'>
						<i class="font-icon icon-home"></i>
					</button>
					<div id='yarnball' title="点击进入编辑状态"></div>
					<div id='yarnball-input'><input type="text" name="path" value="" class="path" id="path"/></div>

					<button class="btn btn-default" id='fav' title='添加到收藏夹' type="button">
						<i class="font-icon icon-star"></i>
					</button>
					<!-- <button class="btn btn-default" id='refresh' title='强制刷新' type="button">
						<i class="font-icon icon-refresh"></i>
					</button> -->
					<button class="btn btn-default btn-right-radius" id='goto-father' title='上层' type="button">
						<i class="font-icon icon-circle-arrow-up"></i>
					</button>
					<div class="path-tips" title="该目录没有写权限<br/>可以在服务器设置此目录的权限" title-timeout="0">
						<i class="icon-warning-sign"></i><span></span>
					</div>

					<div class="role-label-box"></div>
				</div><!-- /header-middle end-->		
				<div class='header-right'>
					<input type="text" name="seach" class="btn-left-radius"/>
					<button class="btn btn-default btn-right-radius" id='search' title='搜索' type="button">
						<i class="font-icon icon-search"></i>
					</button>
				</div>
			</div>
		</div><!-- / header end -->
		<div class="frame-right-main">
			<div class="tools">
				<div class="tools-left tools-left-share hidden">
					<!-- 文件功能 -->
					<div class="kod-toolbar kod-toolbar-path btn-group btn-group-sm">
						<button data-action='select-all' class="btn btn-default" type="button">
							<i class="font-icon icon-check"></i>全选						</button>
						<button data-action='upload' class="btn btn-default" type="button">
							<i class="font-icon icon-cloud-upload"></i>上传						</button>
						
						<button data-action='download' class="btn btn-default" type="button">
							<i class="font-icon icon-download"></i>下载						</button>
					</div>
					<span class='msg'>载入中...</span>
					<div class="clear"></div>
				</div>


				<div class="tools-left tools-left-explorer ">
					<!-- 回收站tool -->
					<div class="kod-toolbar kod-toolbar-recycle btn-group btn-group-sm hidden fl-left">
						<button data-action='recycle-clear' class="btn btn-default" type="button">
							<i class="font-icon icon-folder-close-alt"></i>清空回收站						</button>
					</div>

					<!-- 分享 tool -->
					<div class="kod-toolbar kod-toolbar-share hidden fl-left">
						<button data-action='refresh' class="btn btn-sm btn-default fl-left" type="button">
							<i class="font-icon icon-refresh"></i>刷新						</button>
						<div class="select-button-show-share btn-group btn-group-sm fl-left ml-10 mr-10 hidden">
							<button data-action='remove' class="btn btn-default" type="button">
								<i class="font-icon icon-remove"></i>取消分享							</button>
							<button data-action='shareEdit' class="btn btn-default" type="button">
								<i class="font-icon icon-edit"></i>编辑分享							</button>
							<button data-action='shareOpenWindow' class="btn btn-default" type="button">
								<i class="font-icon icon-link"></i>打开共享页面							</button>
						</div>
					</div>

					<!-- 文件功能 -->
					<div class="kod-toolbar kod-toolbar-path fl-left">
						<div class="select-button-default btn-group btn-group-sm fl-left mr-10">
							<button data-action='newfolder' class="btn btn-default" type="button">
								<i class="font-icon icon-folder-close-alt"></i>新建文件夹							</button>
							<button data-action='newfile' class="btn btn-default tool-path-newfile" type="button">
								<i class="font-icon icon-caret-down"></i>
							</button>
						</div>

						<div class="select-button-default btn-group btn-group-sm fl-left mr-10">
							<button data-action='upload' class="btn btn-default" type="button">
								<i class="font-icon icon-cloud-upload"></i>上传							</button>
							<button data-action='upload-more' class="btn btn-default tool-path-upload" type="button">
								<i class="font-icon icon-caret-down"></i>
							</button>
						</div>

						<div class="select-button-show btn-group btn-group-sm fl-left ml-10 mr-10 hidden">
							<button data-action='share' class="btn btn-default" type="button">
								<i class="font-icon icon-share"></i>分享							</button>
							<button data-action='download' class="btn btn-default" type="button">
								<i class="font-icon icon-download"></i>下载							</button>
							<button data-action='remove' class="btn btn-default" type="button">
								<i class="font-icon icon-remove"></i>删除							</button>
							<button data-action='rname' class="btn btn-default" type="button">
								<i class="font-icon icon-rename"></i>重命名							</button>

							<button data-action='copy' class="btn btn-default" type="button">
								<i class="font-icon icon-copy"></i>复制							</button>
							<button data-action='cute' class="btn btn-default" type="button">
								<i class="font-icon icon-cute"></i>剪切							</button>
							<button type="button" class="btn btn-default btn-sm toolbar-path-more fl-left mr-10">
								<i class="font-icon icon-ellipsis-horizontal"></i>
								更多&nbsp;<span class="caret"></span>
							</button>
						</div>

						<div class="group-space-use fl-left hidden"></div>
						<div class="admin-real-path hidden fl-left">
							<button type="button" class="btn btn-default btn-sm dialog-goto-path ml-10"  title="进入所在目录">
								<i class="font-icon icon-folder-open"></i>
							</button>
						</div>
						<span class='msg fl-left'>载入中...</span>
						<div class="clear"></div>
					</div>
				</div>
				<div class="tools-right">
					<div class="btn-group btn-group-sm">
						<button data-action='set-icon' title="图标排列" type="button" class="btn btn-default">
							<i class="font-icon icon-th"></i>
						</button>
						<button data-action='set-list' title="列表排列" type="button" class="btn btn-default">
							<i class="font-icon icon-list"></i>
						</button>
						<button data-action='set-split' title="分栏模式" type="button" class="btn btn-default">
							<i class="font-icon icon-columns"></i>
						</button>

						<div class="btn-group btn-group-sm menu-theme-list">
						<button data-action="set-theme" title="主题设置" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						  <i class="font-icon icon-dashboard"></i>&nbsp;&nbsp;<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right dropdown-menu-theme animated menuShow">
							<li class='list' theme='mac'><a href='javascript:void(0);'>Mac 简约白</a></li>
<li class='list' theme='win10'><a href='javascript:void(0);'>Windows 10</a></li>
<li class='list' theme='win7'><a href='javascript:void(0);'>Windows 7</a></li>
<li class='list' theme='metro'><a href='javascript:void(0);'>Metro 经典蓝</a></li>
<li class='list' theme='metro_green'><a href='javascript:void(0);'>Metro 淡绿</a></li>
<li class='list' theme='metro_purple'><a href='javascript:void(0);'>Metro 高雅紫</a></li>
<li class='list' theme='metro_pink'><a href='javascript:void(0);'>Metro 玫红</a></li>
<li class='list' theme='metro_orange'><a href='javascript:void(0);'>Metro 亮橙</a></li>
<li class='list' theme='alpha_image'><a href='javascript:void(0);'>炫彩——飞扬</a></li>
<li class='list' theme='alpha_image_sun'><a href='javascript:void(0);'>炫彩——夕阳</a></li>
<li class='list' theme='alpha_image_sky'><a href='javascript:void(0);'>炫彩——蓝天</a></li>
<li class='list' theme='diy'><a href='javascript:void(0);'><b>自定义</b></a></li>
						</ul>
					  </div>
					</div>
					<div class="set-icon-size">
						<span class="dropdown-toggle" data-toggle="dropdown">
							<i class="font-icon icon-zoom-in"></i>
						</span>
						<ul class="dropdown-menu set-icon-size-slider animated menuShow">
							<div class="slider-bg"></div>
							<div class="slider-handle"></div>
						</ul>
					</div>
				</div>
				<div style="clear:both"></div>
			</div><!-- end tools -->
			<div id='list-type-header' class="hidden">
				<div id="main-title">
					<div class="filename" field="name">名称<span></span></div><div class="resize filename-resize"></div>
					<div class="filetype" field="ext">类型<span></span></div><div class="resize filetype-resize"></div>
					<div class="filesize" field="size">大小<span></span></div><div class="resize filesize-resize"></div>
					<div class="filetime" field="mtime">修改时间<span></span></div><div class="resize filetime-resize"></div>
					<div style="clear:both"></div>
				</div>
			</div>
			</div><!-- list type 列表排序方式 -->

			<div class='bodymain drag-upload-box menu-body-main'>
				<div class="line-split-box hidden">
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
					<div class="split-line"></div>
				</div>
				<div class="file-continer"></div>
				<div class="file-continer-more"></div>
			</div><!-- html5拖拽上传list -->
			<div class="file-select-info">
				<span class="item-num"></span>
				<span class="item-select"></span>
			</div>
		</div>
	</div><!-- / frame-right end-->
</div><!-- / frame-main end-->

	<div class="common-footer aero">
	<span class="copyright-content">Powered by yun v1.00 | Copyright © <a href="" target="_blank">cloud.com</a>.<a href="javascript:core.copyright();" class="icon-info-sign copyright-bottom pl-5"></a>&nbsp;&nbsp;  </span></div>

<script type="text/javascript" src="./static/js/lib/seajs/sea.js?ver=v1.00"></script>
<script type="text/javascript" src=""></script>
	<style type="text/css" id="setting-system-global-css"></style>
	

<script type="text/javascript">
		seajs.config({
		base: "./static/js/",
		preload: [
			"lib/jquery-1.8.0.min",
		],
		map:[
			[ /^(.*\.(?:css|js))(.*)$/i,'$1$2?ver='+G.version]
		]
	});
</script>
	<script type="text/javascript">
		G.thisPath = "";
		seajs.use("app/src/explorer/main");
	</script>
</body>
</html>



