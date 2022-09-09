<?PHP

// 和风天气
function amap() {
    global $normal;
    // 获取用户IP地址
    $person_ip = $_SERVER['REMOTE_ADDR'];
    if (!$person_ip == ('127.0.0.1' or 'localhost')) {
        // 整理数据获取API
        $amap_url = 'https://restapi.amap.com/v3/ip?key='.$normal['data']['gddh_key']['text'].'&ip='.$person_ip;    
        $amap_ch = curl_init($amap_url);
        curl_setopt($amap_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
        curl_setopt($amap_ch, CURLOPT_RETURNTRANSFER, true);
        $amap = curl_exec($amap_ch);
        $amap = json_decode($amap,true);
        return $amap['province'].$amap['city'];
    } else {
        return '广东省深圳市';
    }
}

function qweater($type) {
    global $normal;
    if (!$_SERVER['REMOTE_ADDR'] == ('127.0.0.1' or 'localhost')) {
        // 获取城市信息
        $qweater_id_url = 'https://geoapi.qweather.com/v2/city/lookup?key='.$normal['data']['hftq_key']['text'].'&location='.amap();    
        $qweater_id_ch = curl_init($qweater_id_url);
        curl_setopt($qweater_id_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
        curl_setopt($qweater_id_ch, CURLOPT_RETURNTRANSFER, true);
        $qweater_id = curl_exec($qweater_id_ch);
        $qweater_id = json_decode($qweater_id,true);

        // ID获取
        $location_id = $qweater_id['location'][0]['id'];

        // 获取天气概况
        $qweater_url = 'https://devapi.qweather.com/v7/weather/now?key='.$normal['data']['hftq_key']['text'].'&location='.$location_id;    
        $qweater_ch = curl_init($qweater_url);
        curl_setopt($qweater_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
        curl_setopt($qweater_ch, CURLOPT_RETURNTRANSFER, true);
        $qweater = curl_exec($qweater_ch);
        $qweater = json_decode($qweater,true);

        // 内容输出
        return $qweater['now'][$type];
    } else {
        if ($type == 'temp') {
            return '26';
        }
    }
}