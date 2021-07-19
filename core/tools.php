<?php
/**
 * 系统所需要的各种奇怪小工具
 */

/**
 * 从一个header中分离出cookie
 * @param $s_data header string
 */
function get_cookies($s_data) {
	$preg_cookie = '/Set-Cookie: (.*?);/m';
	preg_match_all($preg_cookie,$s_data,$cookie);
	$cookie = implode(';', $cookie[1]);
	return $cookie;
}
// 生成随机字符串
function randomstr($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ";
    $output = "";
    for($i=0;$i<$length;$i++)
    {
        $output .= $pattern[mt_rand(0,35)]; //生成php随机数
    }
    return $output;
}

// 下面的代码全部来自于meting
function bchexdec($hex)
{
    $dec = 0;
    $len = strlen($hex);
    for ($i = 1; $i <= $len; $i++) {
        $dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
    }

    return $dec;
}
function str2hex($string)
{
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }

    return $hex;
}
function bcdechex($dec)
{
    $hex = '';
    do {
        $last = bcmod($dec, 16);
        $hex = dechex($last).$hex;
        $dec = bcdiv(bcsub($dec, $last), 16);
    } while ($dec > 0);

    return $hex;
}