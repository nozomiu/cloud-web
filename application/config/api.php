<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*版本*/
$config['version']  = 'v1.1.1';
/*接口ip*/
$config['api_host'] = 'http://47.104.162.227';
/*端口*/
$config['api_port'] = '8001';
$config['doc_port'] = '8001';
/*securityKey*/
$config['securityKey'] = 'jdkfesfe';

$config['paths'] = '/admin/';
$config['verify'] = '1';
/*lang*/
$config['langs'] = array(
		"en"	=>	array("English","英语","English"),
		"zh-CN"	=>	array("简体中文","简体中文","Simplified Chinese"),
		"zh-TW"	=>	array("繁體中文","繁體中文","Traditional Chinese"),
	);
$config['documenType'] = array(
		"0"	=>	'管理手册',
		"1"	=>	'程序文件',
		"2"	=>	'管理标准',
	);
$config['level'] = array(
		"0"	=>	'A',
		"1"	=>	'B',
		"2"	=>	'C',
	);