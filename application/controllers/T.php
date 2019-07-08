<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class T extends CI_Controller {

	public function captcha()
    {
        $this->load->library('Captcha');

        $config = [
            'seKey'     =>  'Nozomi',          // 验证码加密密钥
            'codeSet'   =>  '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',             // 验证码字符集合
            'expire'    =>  1800,                   // 验证码过期时间（s）
            'useZh'     =>  FALSE,                   // 使用中文验证码 
            'useImgBg'  =>  FALSE,                  // 使用背景图片 
            'fontSize'  =>  14,                     // 验证码字体大小(px)
            'useCurve'  =>  FALSE,                   // 是否画混淆曲线
            'useNoise'  =>  FALSE,                  // 是否添加杂点  
            'imageW'    =>  100,                      // 验证码图片宽度
            'imageH'    =>  32,                     // 验证码图片高度
            'length'    =>  4,                      // 验证码位数
            'fontttf'   =>  'zhttfs/1.ttf',     // 验证码字体，不设置随机获取
            'bg'        =>  array(255, 255, 255),   // 背景颜色
            'reset'     =>  TRUE,                   // 验证成功后是否重置
        ];
        $captcha = new Captcha($config);
        $captcha->generate();

    }
}
?>