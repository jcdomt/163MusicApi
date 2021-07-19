<?php
/**
 * @name 向服务器发出请求
 * @author wzj
 */

/**
 * params加密方法
 */
function NetEaseMusicAES($text,$key)
{
    $iv = '0102030405060708';
    return openssl_encrypt($text, 'AES-128-CBC', $key, false, $iv);
}

/**
 * 请求头设置
 */
function set_header($cookie) {
    return array(
        'Host: music.163.com',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
        'Origin: https://music.163.com',
        'Referer: https://music.163.com',
        'Content-Type: application/x-www-form-urlencoded',
        'cookie: '.$cookie,
    );
}

/**
 * 发出HTTP请求
 * @param $url          目标URL
 * @param $post_data    post数据
 * @return bool|string  返回的数据
 */
function http_post($url, $post_data,$get_header=false,$cookie) {
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method'        => 'POST',
            'header'        => set_header($cookie),
            'content'       => $postdata,
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    //var_dump($http_response_header);
    if($get_header) {
        // 需要返回header
        return array(
            'header'    => $http_response_header,
            'body'      => $result,
        );
    } else {
        return $result;
    }
}

function request($url,$d,$get_header=false,$cookie=DEFAULT_COOKIE) {
    $text = (json_encode($d));
    //echo $text;exit();
    if($text != '') {
        $modulus = '157794750267131502212476817800345498121872783333389747424011531025366277535262539913701806290766479189477533597854989606803194253978660329941980786072432806427833685472618792592200595694346872951301770580765135349259590167490536138082469680638514416594216629258349130257685001248172188325316586707301643237607';
        $pubkey = '65537';
        // 开始生成encSecKey
        $key2 = randomstr(16);
        $skey = strrev(utf8_encode($key2));
        $skey = bchexdec(str2hex($skey));
        $skey = bcpowmod($skey, $pubkey, $modulus);
        $skey = bcdechex($skey);
        $skey = str_pad($skey, 256, '0', STR_PAD_LEFT);
        $key = '0CoJUm6Qyw8W8jud';
        $enStr = NetEaseMusicAES($text,$key);
        $params = NetEaseMusicAES($enStr,$key2);
    }
    //$params='uh1c5CSFa+2t8TKFqSmJkFaryJQywaGz9NMjZWcgSjecW2EnWql4rQhuipCYD0h3/P+fUIubr7dRs2p4r3jje+Qxga6emuYuSm0DCswSBuF/AuRKCG/YE4PDV3hUHeYQ65HSbPx7kQrsQJgzlBOhmcPMqR9fNUjR3JvwfpLeJTKkEvCVJP/3thVMdMKoCRuKfxk8bZUa/KbiqopkXfn2YE6b56PuHoWGuRGANtbK3d0=';
    //$skey='ab080ef8b783abc123019cd885f748e535ec49d611e9974a088e0b25b2a110edcdc4eae5130e27a7cbaa73823238457829596de994e793033f302ebf98acff17c296674826259a1fcb764646b55f213f45dc1bf40a84a675e3ff0973333cac2b774885c714fd0de4860c64426b42cc21bfcc244c863154e5ecc3726ac0257875';
    //echo "$params\n$skey";exit();
    $data['params'] = $params;
    $data['encSecKey'] = $skey;
    return http_post($url,$data,$get_header,$cookie);
}

