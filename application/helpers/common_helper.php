<?php

/**
 * 函数索引
 */

/**
 * 
 * 按格式打印出指定数组
 * p($arr);
 *
 * 
 * 取多维数组中的一列作为键，另外一列作为值（如省略，则将整行作为值），转换为键值数组
 * array_point($result,$kk='id',$vk=NULL);
 *
 * 
 * 取出多维数组中的某一列的所有值，并返回数组
 * array_column($result,$key);
 *
 * 
 * 封装的CURL功能函数
 * curl($config=NULL,&$status=FALSE);
 *
 * 
 * base64加密
 * encode($string,$type=true);
 *
 * 
 * 用base64编码名称，连续编码指定次数
 * name_encode($string,$count=3);
 *
 * 
 * 用base64解码名称，连续解码指定次数
 * name_decode($string,$count=3);
 *
 * 
 * 判断是否是座机号码
 * is_mobilephone($phone);
 *
 * 提取2维数组的某一列数据
 * array_strips($array,$key=0);
 *
 * 查询条件由数组构造sql语句
 * get_condition($array);
 *
 * 手机号码归属地
 * phoneArea($phone,$return_type='string');
 *
 * 转成UTF-8编码
 * gb2utf($str);
 *
 * 记住上次查询条件的url生成
 * url_merge($param1,$param2,$param3)
 *
 * php获取中文字符拼音首字母 
 * getFirstCharter($str)
 * 
 * 
 */
// 对象转换数组
 function object2array($object) {
          if (is_object($object)) {
            foreach ($object as $key => $value) {
              $array[$key] = $value;
            }
          }
          else {
            $array = $object;
          }
          return $array;
    }


/**
 * 按格式打印出指定数组
 * @param  mixed $arr 数组
 * @return void
 */
function p($arr){
	echo "<pre>".print_r($arr,true)."</pre>";
}


if (!function_exists('array_point')) {
    /**
     * 取多维数组中的一列作为键，另外一列作为值（如省略，则将整行作为值），转换为键值数组
     * @param  array    $result 多维数组
     * @param  string   $kk     要作为键名的列名
     * @param  string   $vk     要作为键值的列名
     * @return array            键值数组
     */
    function array_point($result,$kk='id',$vk=NULL){
        $array = array();
        foreach ($result as $row){
            if ($vk) {
                $array[$row[$kk]]=$row[$vk];
            }else{
                $array[$row[$kk]]=$row;
            }
        }
        return $array;
    }
}

/*
 * 重写array_combine
 * 合并两个数组，键相同的放入一个数组
 * */
function array_combine_($keys, $values)
{
    $result = array();
    foreach($keys as $k=>$v){
        $v = (string)$v;
        if(array_key_exists($v,$result)){
            array_push($result[$v],$values[$k]);
        }else{
            $result[$v] = array($values[$k]);
        }
    }
    return $result;
}

/**
 * 二维数组去重
 */
//二维数组去掉重复值

function array_unique_fb($array2D){
    foreach ($array2D as $v){
        $v=join(',',$v);//降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        $temp[]=$v;
    }
    $temp=array_unique($temp);//去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v){
        $temp[$k]=explode(',',$v);//再将拆开的数组重新组装
    }
    return $temp;
}

if(!function_exists('array_column')){
    /**
     * 取出多维数组中的某一列的所有值，并返回数组
     * @param  array  $result 多维数组
     * @param  string $key    要取出的键名
     * @return array          返回的数组
     */
    function array_column($result,$key){
        $array = array();
        foreach ($result as $row){
            $array[]=$row[$key];
        }
        return array_unique($array);
    }
}


if (!function_exists('curl')){
    /**
     * 封装的curl
     * @param  array|string  $config  配置数组或URL
     * @param  boolean &$status 返回的状态码
     * @return string           返回的内容
     */
    function curl($config=NULL,&$status=FALSE){
        $setopt = array(
            'url'       =>  CURLOPT_URL,                //访问网址
            'referer'   =>  CURLOPT_REFERER,            //来源网址
            'return'    =>  CURLOPT_RETURNTRANSFER,     //是否将结果返回，反之将直接输出
            'header'    =>  CURLOPT_HEADER,             //
            'post'      =>  CURLOPT_POST,               //是否POST方式提交
            'fields'    =>  CURLOPT_POSTFIELDS,         //POST提交数据
            'follow'    =>  CURLOPT_FOLLOWLOCATION,     //是否根据状态跟踪页面
            'agent'     =>  CURLOPT_USERAGENT,          //访问者
            'timeout'	=>	CURLOPT_TIMEOUT,			//超时
            'cookie'	=>  array(CURLOPT_COOKIEFILE,CURLOPT_COOKIEJAR),
        );
        if(!is_array($config))$config = array('url'=>$config);
        //设置默认参数
        if(!isset($config['return']))$config['return']=1;
        if(!isset($config['fields_format']))$config['fields_format']=1;
        if(is_array($config['fields']) && $config['fields_format'])$config['fields']=http_build_query($config['fields']);
        if(!isset($config['follow']))$config['follow']=1;
        if(!isset($config['agent']))$config['agent']='Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0';
        if(isset($config['cookie'])){
            if($config['cookie']===1 || $config['cookie']===true){
                $url_data = parse_url($config['url']);
                $host = $url_data['host'];
                if(!$host)$host='unknow_host';
                $config['cookie'] = $host;
            }
            $config['cookie'] = ROOT_DIR.'/data/cookie/'.$config['cookie'].'.txt';
            $cookie_dir = dirname($config['cookie']);
            $cookie_path = $config['cookie'];
            if(!file_exists($cookie_dir))mkdir($cookie_dir,0777,true);
            if(!file_exists($cookie_path))fclose(fopen($cookie_path,'w'));
            if(!strlen(@file_get_contents($cookie_path)))array_shift($setopt['cookie']);
        }
        $curl = curl_init();
        foreach($config as $key=>$value){
            $option_array=$setopt[$key];
            if(!$option_array)continue;
            if(!is_array($setopt[$key]))$option_array=array($setopt[$key]);
            foreach($option_array as $option){
                curl_setopt($curl,$option,$value);
            }
        }
        $content = curl_exec($curl);
        if($status!==FALSE){
            if(!isset($config['info']))$config['info']=CURLINFO_HTTP_CODE;
            if($config['info']){
                $status = curl_getinfo($curl,$config['info']);
            }else{
                $status = curl_getinfo($curl);
            }
        }
        curl_close($curl);
        return $config['return']?$content:FALSE;
    }
}

/*
 * 敏感词汇检测
 * */
function badword_check($content){
    $token = '3117c8051088fa6d227a6c40ac200d30';
    $url = 'http://www.hoapi.com/index.php/Home/Api/check';

    $config = array(
        'url'=>$url,
        'fields'=>array(
            'str'=>$content,
            'token'=>$token
        ),
        'fields_format'=>1
    );

    $return_data = curl($config);
    return $return_data;
}

//base64编码
if(!function_exists('encode')){
    function encode($string,$type=true){
         if($type){
              return base64_encode($string);
         }else{
            return base64_decode(str_replace(" ","+",$string));
        }
    }
}

//产品名字编码
if(!function_exists('name_encode')){
    function name_encode($string,$count=3){
        for($i=0;$i<$count;$i++){
             $string = encode($string);
             $string = strrev($string);
         }
         return $string;
     }
}

//产品名字解码
if(!function_exists('name_decode')){
    function name_decode($string,$count=3){
        for($i=0;$i<$count;$i++){
            $string = strrev($string);
            $string = encode($string,false);
        }
        return $string;
    }
}

/**
 * 获取下属角色组列表
 * @param  int     $is_self 是否显示出本身所属的角色组
 * @return array            角色组列表
 */
function get_child_roles($is_self=0){
    global $roles_array,$db;
    $roles_array = array();
    $ci = &get_instance();
    $db = $ci->db;
    //如果是超级管理员
    if ($ci->auth->is_superman()) {
        //把所有顶级的角色组全部取出
        $roles = $db->select('id,name,company_id')->order_by('company_id')->get_where('role','enable=1 and parent=0')->result_array();
    }else{
        //把拥有的角色组取出
        $role_ids = $db->select('role_id')->get_where('manager_role','manager_id='.MANAGER_ID)->result_array();
        $role_ids = array_column($role_ids,'role_id');
        $roles = $db->select('id,name,company_id')->order_by('company_id')->get_where('role','id in('.implode(',',$role_ids).')')->result_array();
    }
    
    //递归循环查找角色组树
    foreach ($roles as $role) {
        $depth = -1;
        //显示所属的角色组
        if ($is_self) {
            $depth++;
             $roles_array[] = array(
                'id'        =>  $role['id'],
                'name'      =>  $role['name'],
                'company_id'=>  $role['company_id'],
                'depth'     =>  $depth,
            );
        }
        __get_child_roles($role['id'],$depth);
    }

    return $roles_array;
}

function __get_child_roles($role_id,$depth){
    global $roles_array,$db;
    $depth++;
    $child_roles = $db->select('id,name,company_id')->get_where('role','enable=1 and parent='.$role_id)->result_array();
    foreach($child_roles as $role){
        $role['depth'] = $depth;
        $roles_array[] = $role;
        __get_child_roles($role['id'],$depth);
    }
}


if(!function_exists('is_telephone')){
    /**
     * 判断是否是座机号码
     * @param  varchar  $phone 电话号码
     * @return boolean         是否是手机号
     */
    function is_telephone($phone){
        $telephone_region_code = array(
            //直辖市
            '010'   =>  '北京市',
            '021'   =>  '上海市',
            '022'   =>  '天津市',
            '023'   =>  '重庆市',
            '852'   =>  '香港',
            '853'   =>  '澳门',
            //河北省
            '0310'  =>  '邯郸市',
            '0311'  =>  '石家庄',
            '0312'  =>  '保定市',
            '0313'  =>  '张家口',
            '0314'  =>  '承德市',
            '0315'  =>  '唐山市',
            '0316'  =>  '廊坊市',
            '0317'  =>  '沧州市',
            '0318'  =>  '衡水市',
            '0319'  =>  '邢台市',
            '0335'  =>  '秦皇岛',
            //浙江省
            '0570'  =>  '衢州市',
            '0571'  =>  '杭州市',
            '0572'  =>  '湖州市',
            '0573'  =>  '嘉兴市',
            '0574'  =>  '宁波市',
            '0575'  =>  '绍兴市',
            '0576'  =>  '台州市',
            '0577'  =>  '温州市',
            '0578'  =>  '丽水市',
            '0579'  =>  '金华市',
            '0580'  =>  '舟山市',
            //辽宁省
            '024'   =>  '沈阳市',
            '0410'  =>  '铁岭市',
            '0411'  =>  '大连市',
            '0412'  =>  '鞍山市',
            '0413'  =>  '抚顺市',
            '0414'  =>  '本溪市',
            '0415'  =>  '丹东市',
            '0416'  =>  '锦州市',
            '0417'  =>  '营口市',
            '0418'  =>  '阜新市',
            '0419'  =>  '辽阳市',
            '0421'  =>  '朝阳市',
            '0427'  =>  '盘锦市',
            '0429'  =>  '葫芦岛',
            //湖北省
            '027'   =>  '武汉市',
            '0710'  =>  '襄城市',
            '0711'  =>  '鄂州市',
            '0712'  =>  '孝感市',
            '0713'  =>  '黄州市',
            '0714'  =>  '黄石市',
            '0715'  =>  '咸宁市',
            '0716'  =>  '荆沙市',
            '0717'  =>  '宜昌市',
            '0718'  =>  '恩施市',
            '0719'  =>  '十堰市',
            '0722'  =>  '随枣市',
            '0724'  =>  '荆门市',
            '0728'  =>  '江汉市',
            //江苏省
            '025'   =>  '南京市',
            '0510'  =>  '无锡市',
            '0511'  =>  '镇江市',
            '0512'  =>  '苏州市',
            '0513'  =>  '南通市',
            '0514'  =>  '扬州市',
            '0515'  =>  '盐城市',
            '0516'  =>  '徐州市',
            '0517'  =>  '淮阴市',
            '0517'  =>  '淮安市',
            '0518'  =>  '连云港',
            '0519'  =>  '常州市',
            '0523'  =>  '泰州市',
            //内蒙古
            '0470'  =>  '海拉尔',
            '0471'  =>  '呼和浩特',
            '0472'  =>  '包头市',
            '0473'  =>  '乌海市',
            '0474'  =>  '集宁市',
            '0475'  =>  '通辽市',
            '0476'  =>  '赤峰市',
            '0477'  =>  '东胜市',
            '0478'  =>  '临河市',
            '0479'  =>  '锡林浩特',
            '0482'  =>  '乌兰浩特',
            '0483'  =>  '阿拉善左旗',
            //江西省
            '0790'  =>  '新余市',
            '0791'  =>  '南昌市',
            '0792'  =>  '九江市',
            '0793'  =>  '上饶市',
            '0794'  =>  '临川市',
            '0795'  =>  '宜春市',
            '0796'  =>  '吉安市',
            '0797'  =>  '赣州市',
            '0798'  =>  '景德镇',
            '0799'  =>  '萍乡市',
            '0701'  =>  '鹰潭市',
            //山西省
            '0350'  =>  '忻州市',
            '0351'  =>  '太原市',
            '0352'  =>  '大同市',
            '0353'  =>  '阳泉市',
            '0354'  =>  '榆次市',
            '0355'  =>  '长治市',
            '0356'  =>  '晋城市',
            '0357'  =>  '临汾市',
            '0358'  =>  '离石市',
            '0359'  =>  '运城市',
            //甘肃省
            '0930'  =>  '临夏市',
            '0931'  =>  '兰州市',
            '0932'  =>  '定西市',
            '0933'  =>  '平凉市',
            '0934'  =>  '西峰市',
            '0935'  =>  '武威市',
            '0936'  =>  '张掖市',
            '0937'  =>  '酒泉市',
            '0938'  =>  '天水市',
            '0941'  =>  '甘南州',
            '0943'  =>  '白银市',
            //山东省
            '0530'  =>  '菏泽市',
            '0531'  =>  '济南市',
            '0532'  =>  '青岛市',
            '0533'  =>  '淄博市',
            '0534'  =>  '德州市',
            '0535'  =>  '烟台市',
            '0536'  =>  '淮坊市',
            '0537'  =>  '济宁市',
            '0538'  =>  '泰安市',
            '0539'  =>  '临沂市',
            //黑龙江
            '0450'  =>  '阿城市',
            '0451'  =>  '哈尔滨',
            '0452'  =>  '齐齐哈尔',
            '0453'  =>  '牡丹江',
            '0454'  =>  '佳木斯',
            '0455'  =>  '绥化市',
            '0456'  =>  '黑河市',
            '0457'  =>  '加格达奇',
            '0458'  =>  '伊春市',
            '0459'  =>  '大庆市',
            //福建省
            '0591'  =>  '福州市',
            '0592'  =>  '厦门市',
            '0593'  =>  '宁德市',
            '0594'  =>  '莆田市',
            '0595'  =>  '泉州市',
            '0595'  =>  '晋江市',
            '0596'  =>  '漳州市',
            '0597'  =>  '龙岩市',
            '0598'  =>  '三明市',
            '0599'  =>  '南平市',
            //广东省
            '020'   =>  '广州市',
            '0751'  =>  '韶关市',
            '0752'  =>  '惠州市',
            '0753'  =>  '梅州市',
            '0754'  =>  '汕头市',
            '0755'  =>  '深圳市',
            '0756'  =>  '珠海市',
            '0757'  =>  '佛山市',
            '0758'  =>  '肇庆市',
            '0759'  =>  '湛江市',
            '0760'  =>  '中山市',
            '0762'  =>  '河源市',
            '0763'  =>  '清远市',
            '0765'  =>  '顺德市',
            '0766'  =>  '云浮市',
            '0768'  =>  '潮州市',
            '0769'  =>  '东莞市',
            '0660'  =>  '汕尾市',
            '0661'  =>  '潮阳市',
            '0662'  =>  '阳江市',
            '0663'  =>  '揭西市',
            //四川省
            '028'   =>  '成都市',
            '0810'  =>  '涪陵市',
            '0811'  =>  '重庆市',
            '0812'  =>  '攀枝花',
            '0813'  =>  '自贡市',
            '0814'  =>  '永川市',
            '0816'  =>  '绵阳市',
            '0817'  =>  '南充市',
            '0818'  =>  '达县市',
            '0819'  =>  '万县市',
            '0825'  =>  '遂宁市',
            '0826'  =>  '广安市',
            '0827'  =>  '巴中市',
            '0830'  =>  '泸州市',
            '0831'  =>  '宜宾市',
            '0832'  =>  '内江市',
            '0833'  =>  '乐山市',
            '0834'  =>  '西昌市',
            '0835'  =>  '雅安市',
            '0836'  =>  '康定市',
            '0837'  =>  '马尔康',
            '0838'  =>  '德阳市',
            '0839'  =>  '广元市',
            '0840'  =>  '泸州市',
            //湖南省
            '0730'  =>  '岳阳市',
            '0731'  =>  '长沙市',
            '0731'  =>  '湘潭市',
            '0731'  =>  '株州市',
            '0734'  =>  '衡阳市',
            '0735'  =>  '郴州市',
            '0736'  =>  '常德市',
            '0737'  =>  '益阳市',
            '0738'  =>  '娄底市',
            '0739'  =>  '邵阳市',
            '0743'  =>  '吉首市',
            '0744'  =>  '张家界',
            '0745'  =>  '怀化市',
            '0746'  =>  '永州冷',
            //河南省
            '0370'  =>  '商丘市',
            '0371'  =>  '郑州市',
            '0372'  =>  '安阳市',
            '0373'  =>  '新乡市',
            '0374'  =>  '许昌市',
            '0375'  =>  '平顶山',
            '0376'  =>  '信阳市',
            '0377'  =>  '南阳市',
            '0378'  =>  '开封市',
            '0379'  =>  '洛阳市',
            '0391'  =>  '焦作市',
            '0392'  =>  '鹤壁市',
            '0393'  =>  '濮阳市',
            '0394'  =>  '周口市',
            '0395'  =>  '漯河市',
            '0396'  =>  '驻马店',
            '0398'  =>  '三门峡',
            //云南省
            '0870'  =>  '昭通市',
            '0871'  =>  '昆明市',
            '0872'  =>  '大理市',
            '0873'  =>  '个旧市',
            '0874'  =>  '曲靖市',
            '0875'  =>  '保山市',
            '0876'  =>  '文山市',
            '0877'  =>  '玉溪市',
            '0878'  =>  '楚雄市',
            '0879'  =>  '思茅市',
            '0691'  =>  '景洪市',
            '0692'  =>  '潞西市',
            '0881'  =>  '东川市',
            '0883'  =>  '临沧市',
            '0886'  =>  '六库市',
            '0887'  =>  '中甸市',
            '0888'  =>  '丽江市',
            //安徽省
            '0550'  =>  '滁州市',
            '0551'  =>  '合肥市',
            '0552'  =>  '蚌埠市',
            '0553'  =>  '芜湖市',
            '0554'  =>  '淮南市',
            '0555'  =>  '马鞍山',
            '0556'  =>  '安庆市',
            '0557'  =>  '宿州市',
            '0558'  =>  '阜阳市',
            '0559'  =>  '黄山市',
            '0561'  =>  '淮北市',
            '0562'  =>  '铜陵市',
            '0563'  =>  '宣城市',
            '0564'  =>  '六安市',
            '0565'  =>  '巢湖市',
            '0566'  =>  '贵池市',
            //吉林省
            '0431'  =>  '长春市',
            '0432'  =>  '吉林市',
            '0433'  =>  '延吉市',
            '0434'  =>  '四平市',
            '0435'  =>  '通化市',
            '0436'  =>  '白城市',
            '0437'  =>  '辽源市',
            '0438'  =>  '松原市',
            '0439'  =>  '浑江市',
            '0440'  =>  '珲春市',
            //广西省
            '0770'  =>  '防城港',
            '0771'  =>  '南宁市',
            '0772'  =>  '柳州市',
            '0773'  =>  '桂林市',
            '0774'  =>  '梧州市',
            '0775'  =>  '玉林市',
            '0776'  =>  '百色市',
            '0777'  =>  '钦州市',
            '0778'  =>  '河池市',
            '0779'  =>  '北海市',
            //贵州
            '0851'  =>  '贵阳市',
            '0852'  =>  '遵义市',
            '0853'  =>  '安顺市',
            '0854'  =>  '都均市',
            '0855'  =>  '凯里市',
            '0856'  =>  '铜仁市',
            '0857'  =>  '毕节市',
            '0858'  =>  '六盘水',
            '0859'  =>  '兴义市',
            //陕西省
            '029'   =>  '西安市',
            '0910'  =>  '咸阳市',
            '0911'  =>  '延安市',
            '0912'  =>  '榆林市',
            '0913'  =>  '渭南市',
            '0914'  =>  '商洛市',
            '0915'  =>  '安康市',
            '0916'  =>  '汉中市',
            '0917'  =>  '宝鸡市',
            '0919'  =>  '铜川市',
            //青海省
            '0971'  =>  '西宁市',
            '0972'  =>  '海东市',
            '0973'  =>  '同仁市',
            '0974'  =>  '共和市',
            '0975'  =>  '玛沁市',
            '0976'  =>  '玉树市',
            '0977'  =>  '德令哈',
            //宁夏
            '0951'  =>  '银川市',
            '0952'  =>  '石嘴山',
            '0953'  =>  '吴忠市',
            '0954'  =>  '固原市',
            //海南省
            '0898'  =>  '儋州市',
            '0898'  =>  '海口市',
            '0898'  =>  '三亚市',
            //西藏
            '0891'  =>  '拉萨市',
            '0892'  =>  '日喀则',
            '0893'  =>  '山南市',
        );
        if(array_key_exists(substr($phone,0,4),$telephone_region_code) || array_key_exists(substr($phone,0,3),$telephone_region_code))return TRUE;
        return FALSE;
    }

}

//提取2维数组的某一列
if(!function_exists('array_strips')){
    function array_strips($array,$key=0){
        foreach($array as &$item){
              $item = $item[$key];
        }
        return $array;
    }
}

/**
 * 获取当前登录IP
 * @return string            当前登录IP
 */
function getIP()
{
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

//验证防火墙规则
function check_firewall(){
    global $db,$auth;
    $ci=&get_instance();
    $db=$ci->db;
   
    //获取当前ip
    $ip = $_SERVER['REMOTE_ADDR'];

    if($ip=='::1' || $ip=='127.0.0.1')return true;

    $sql="select rule,method from firewall where enable=1";
    $firewall=$db->query($sql)->result_array();

    //开始判断
    //一开始都是拒绝的
    $is_allow=0;

    $allow=array();//允许
    $deny=array();//拒绝

    foreach($firewall as $row){
        $rules=explode(';',$row['rule']);
        foreach($rules as $rule){
            $rule=preg_replace('/\.?\*/','',trim($rule,'.'));
            if($row['method']){
                $deny[]=$rule;
            }else{
                $allow[]=$rule;
            }

        }
    }
    foreach($allow as $allow_row){
        if(!$allow_row){
            $is_allow=1;
        }

        if(preg_match('/^'.$allow_row.'.*/',$ip)){
            $is_allow=1;
        }

    } 

    foreach($deny as $deny_row){
        if(!$deny_row){
            $is_allow=0;
        }

        if(preg_match('/^'.$deny_row.'.*/',$ip)){
            $is_allow=0;
        }

    } 

    return  $is_allow;

}

//记住上次查询条件的url生成
if(!function_exists('url_merge')){
    function url_merge($url,$query_str,$current_query){
        //将记住之前条件的string转换成数组
        parse_str($query_str,$query_arr);
        parse_str($current_query,$current_arr);
        foreach ($query_arr as $key => $value) {
            # code...
            //没有值则删除该键
            if($value == null){
                unset($query_arr[$key]);
            }
            //如果键跟当前查询字符串键一致，则删除该键
            foreach ($current_arr as $k => $v) {
                # code...
                if($k == $key){
                    unset($query_arr[$key]);
                }
            }
        }
        if(empty($query_arr)){
            $query_str = '?';
        }else{
            $query_str = '?'.http_build_query($query_arr).'&';
        }
        return base_url($url).$query_str.$current_query;

    }
}



//获取地址栏参数,支持过滤和替换
function get_query_param($filter=NULL,$is_related=TRUE){
    $get = (array)$_GET;
    if(is_string($filter)){
        $filter = explode(',',$filter);
        $filter = array_combine($filter,array_fill(0,count($filter),NULL));
    }elseif(!is_array($filter)){
        $filter = array();
    }
    foreach($filter as $key => $value){
        if(is_null($value)){
            unset($get[$key]);
        }else{
            $get[$key] = $value;
        }
    }
    if($is_related){
        return http_build_query($get);
    }else{
        return $get;
    }
}

//php获取中文字符拼音首字母 
function getFirstCharter($str){
     if(empty($str)){return '';}
     $fchar=ord($str{0});
    if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
     $s1=iconv('UTF-8','gb2312',$str);
    $s2=iconv('gb2312','UTF-8',$s1);
     $s=$s2==$str?$s1:$str;
     $asc=ord($s{0})*256+ord($s{1})-65536; 
     if($asc>=-20319&&$asc<=-20284) return 'A'; 
     if($asc>=-20283&&$asc<=-19776) return 'B'; 
     if($asc>=-19775&&$asc<=-19219) return 'C'; 
     if($asc>=-19218&&$asc<=-18711) return 'D'; 
     if($asc>=-18710&&$asc<=-18527) return 'E'; 
     if($asc>=-18526&&$asc<=-18240) return 'F'; 
     if($asc>=-18239&&$asc<=-17923) return 'G'; 
     if($asc>=-17922&&$asc<=-17418) return 'H'; 
     if($asc>=-17417&&$asc<=-16475) return 'J'; 
     if($asc>=-16474&&$asc<=-16213) return 'K'; 
     if($asc>=-16212&&$asc<=-15641) return 'L'; 
     if($asc>=-15640&&$asc<=-15166) return 'M'; 
     if($asc>=-15165&&$asc<=-14923) return 'N'; 
     if($asc>=-14922&&$asc<=-14915) return 'O'; 
     if($asc>=-14914&&$asc<=-14631) return 'P'; 
     if($asc>=-14630&&$asc<=-14150) return 'Q'; 
     if($asc>=-14149&&$asc<=-14091) return 'R'; 
     if($asc>=-14090&&$asc<=-13319) return 'S'; 
     if($asc>=-13318&&$asc<=-12839) return 'T'; 
     if($asc>=-12838&&$asc<=-12557) return 'W'; 
     if($asc>=-12556&&$asc<=-11848) return 'X'; 
     if($asc>=-11847&&$asc<=-11056) return 'Y'; 
     if($asc>=-11055&&$asc<=-10247) return 'Z'; 
     return null; 
}

//获取字符串的第一个元素,字母或数字,中文的第一个字拼音首字母
function get_first_element($str){
    //获取第一个元素
    if(preg_match("/^[\x{4e00}-\x{9fa5}]/u",$str)){
        //如果是中文
        $first_element = getFirstCharter(mb_substr($str,0,1));
    }else{
        $first_element = strtoupper(substr($str,0,1));
    }
    return $first_element;
}





//生成CSV文件
function build_csv_file($data_array,$file_name=NULL,$dir='data/csv_tmp'){
    $dir = trim($dir,'/');
    if(!empty($file_name)){
        $file_name = rtrim($file_name,'.csv');
    }else{
        $dir .= '/'.date('Y-m-d');
        $time_array = explode(' ',microtime());
        $file_name = $time_array[1].floor(($time_array[0]*1000));
    }
    $file_name.= '.csv';
    $csv_line_array = array();
    foreach($data_array as $row){
        $csv_line_array[] = iconv('utf-8','gbk',implode(',',$row));
    }
    @mkdir(ROOT_DIR.'/'.$dir,0777,TRUE);
    @file_put_contents(ROOT_DIR.'/'.$dir.'/'.$file_name,implode("\r\n",$csv_line_array));
    return array(
        'dir_path'              =>  $dir,
        'file_name'             =>  $file_name,
        'file_path'             =>  $dir.'/'.$file_name,
        'absolute_dir_path'     =>  ROOT_DIR.'/'.$dir,
        'absolute_file_path'    =>  ROOT_DIR.'/'.$dir.'/'.$file_name,
    );
}

//下载CSV文件
function download_csv_file($data_array,$file_name=NULL){
    if(!empty($file_name)){
        $file_name = rtrim($file_name,'.csv');
    }else{
        $time_array = explode(' ',microtime());
        $file_name = $time_array[1].floor(($time_array[0]*1000));
    }
    $file_name .= '.csv';
    $csv_line_array = array();
    foreach($data_array as $row){
        $csv_line_array[] = iconv('utf-8','gbk',implode(',',$row));
    }
    $content = implode("\r\n",$csv_line_array);
    header('Content-type:text/csv');
    header('Content-Type: application/force-download');
    header('Content-Disposition:attachment;filename='.$file_name);
    header('Expires:0');
    header('Pragma:public');
    echo $content;
}

//解析CSV文件返回数组
function parse_csv($file_path,$limit=NULL,$pos=0,$strip=FALSE){
    $data = array();
    if(file_exists($file_path) && !is_dir($file_path)){
        $file = fopen($file_path,'r');
        for($i=0;(FALSE!==$row=fgetcsv($file))&&(!is_numeric($limit)||$i<$limit+$pos);$i++){
            foreach($row as &$item){
                $item = iconv('gbk','utf-8',$item);
            }
            if($i>=$pos)$data[] = $row;
        }
        if($limit==1 && $strip)$data=current($data);
    }
    return $data;
}

//获取CSV文件数据的列
function get_csv_cols($file_path){
    $data = parse_csv($file_path,1);
    if(count($data)){
        $row = array_shift($data);
        $cols = count($row);
    }else{
        $cols = 0;
    }
    return $cols;
}

//返回随机字符串
function get_rand_str($length=10){
    $str_arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
    shuffle($str_arr);
    $str = implode('',array_slice($str_arr,0,$length));
    return $str;
}

//根据ip获取地区
function getCity($ip){
    $ci = &get_instance();
    $db = $ci->db;
    $is_exists_cache = FALSE;
    $cache_ip_result = $db->select('region')->get_where('ip_region','ip=\''.$ip.'\'')->row_array();
    if($cache_ip_result){
        $region = $cache_ip_result['region'];
        $is_exists_cache = true;
    }
    if(!$is_exists_cache) {
        if($ip == '::1' | $ip == '127.0.0.1' ){
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
            $ip1=json_decode(file_get_contents($url),true);
            $region1 = $ip1;
        }else{  
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
            $ip1=json_decode(file_get_contents($url));
            if((string)$ip->code=='1'){
            $region = '查询接口错误';
            return;
            }
            $region1 = (array)$ip1->data;
        }
        $region1['province'] = isset($region1['province'])?$region1['province']:$region1['region'];
        $region = $region1['province'].'-'.$region1['city'];
        $teamdata = array(
            'ip'        =>  $ip,
            'region'    =>  $region,
        );
        $db->insert('ip_region',$teamdata);  
    }    
    return $region;
}

//连接电商系统的api方法
function ds_api($command,$data=NULL){
    define('DS_SYSTEM_API','http://www.baiduor.com/api.php');

    $token = 'KLiew_4GFGUY_glffuy';
    $fields = array(
        'token'	=>	$token,
    );
    if(!$data){
        $data=array();
    }elseif(!is_array($data)){
        parse_str((string)$data,$data);
    }
    $fields = array_merge($fields,$data);
    $content = curl(array(
        'url'	=>	DS_SYSTEM_API.'?a='.$command,
        'post'	=>	1,
        'fields'=>	$fields,
    ));
    //echo $content;
    $result = json_decode($content,true);
    if(is_array($result))return $result;
    return FALSE;
}

//将推荐度转为css格式并输出
function start_css($start){
    $start_arr = explode('.',$start);

    //此处兼容评分的小数点后两位
    if(strlen($start_arr[1]) == 2){
        $start_arr[1] = substr($start_arr[1],1,1);
    }

    //四舍五入小数
    if($start_arr[1] == 0){
        echo $start_arr[0];
    }else if($start_arr[1] <= 5){
        $start_arr[1] = 5;
        echo implode('-',$start_arr);
    }else if($start_arr[1] <= 9){
        $start_arr[0] += 1;
        echo $start_arr[0];
    }
}

//将推荐度转为css格式并返回
function start_css_return($start){
    $start_arr = explode('.',$start);

    //此处兼容评分的小数点后两位
    if(strlen($start_arr[1]) == 2){
        $start_arr[1] = substr($start_arr[1],1,1);
    }

    //四舍五入小数
    if($start_arr[1] == 0){
        return $start_arr[0];
    }else if($start_arr[1] <= 5){
        $start_arr[1] = 5;
        return implode('-',$start_arr);
    }else if($start_arr[1] <= 9){
        $start_arr[0] += 1;
        return $start_arr[0];
    }
}

/*
 * 在文字中获取相关的标签
 * @params $text 查找的范围文字
 * @params $tags 在查找的范围标签
 */
function get_tags_in_text($text,$tags){
    $matchs = array();
    foreach($tags as $v){
        if(strpos($text,$v['name'])!==FALSE){
            $matchs[] = $v['id'];
        }
    }
    return $matchs;
}

/*
 * 在标签中匹配关键字
 * @params $text 关键字
 * @params $tags 在查找的范围标签
 */
function get_tags_in_word($word,$tags){
    $matchs = array();
    foreach($tags as $v){
        if(strpos($v['name'],$word)!==FALSE){
            $matchs[] = $v['id'];
        }
    }
    return $matchs;
}

/*
 * 横向轮播动态计算添加空白数量
 * @param $num 当前有几个数量
 * @params $cound 一次轮播的数量
 * */
function add_empty_ele($num,$count=5){
    if($num == 0){
        $add = $count;
    }else{
        $surplus = $num%$count;
        if(!$surplus){
            $add = 0;
        }else{
            $add = $count - $surplus;
        }
    }

    if($add){
        for($i=0;$i<$add;$i++){
            echo '<div class="swiper-slide "></div>';
        }
    }
}

/*
 * 查找二位数组中是否存在某个值，如果存在则返回该数组的键
 * 如果key不为空，则指定键查找
 * */
function in_deep_array($deep_array,$value,$key=0){
    foreach($deep_array as $k=>$v){
        if($key){
            if($value == $v[$key]){
                return $k;
            }
        }else{
            if(in_array($value,$v)){
                return $k;
            }
        }
    }
    return false;
}






/*
 *
 * 判断数组是否为空*/
function check_empty($list){
    return empty($list)?array(0):$list;
}





/**
 * 如果添加的图片描述是空的话，取名字第二个，前的内容，作为默认描述
 * @param $name
 * @return string
 */
function add_img_default_alt($name){
    $arr = explode(',',$name);
    $count = count($arr);
    $default_name = $arr[0];
    if($count >= 2){
        $default_name .= ','.$arr[1];
    }
    return $default_name;
}


/**
 * @param $
 * @return string
 */
 function curl_request($url,$post='',$data=''){
         
         $result = '';
         header('Content-Type:application/json; charset=utf-8');
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC); 
         curl_setopt($curl,CURLOPT_HEADER,0);
         curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
         if($post) {
             curl_setopt($curl, CURLOPT_POST, 1);
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         }
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

         $result = curl_exec($curl);
            if($result === false){
                echo curl_errno($curl);
                exit();
            }
        echo $result;
        //var_dump($result);
        curl_close($curl);
     }

