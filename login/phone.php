<?php
// 手机号登录
include_once('../core/core.php');
$phone = param('phone', '', true);
$password = param('password', '',true);
$arr = array(
    'phone' => $phone,
    'countrycode' => '86',
    'password' => md5($password),
    'rememberLogin' => 'true',
    'csrf_token'    => '',
);
$response = request('https://music.163.com/weapi/login/cellphone', $arr, true);
//麻了，拿个数组都这么麻烦！
/*弄不好不弄啦，可怜的王子鉴头发都掉光了！！！！！！！！！！！！！！！！！
 *肯定没有妹子会喜欢秃头的！
 *有木有有缘人把她修好
 *ball ball 了
**/
$cookie1 = get_cookies($response['header'][9]);
$cookie2 = get_cookies($response['header'][10]);
$cookie3 = get_cookies($response['header'][11]);
$cookie4 = get_cookies($response['header'][12]);
header('set-cookie: '.$cookie1);
header('set-cookie: '.$cookie2);
header('set-cookie: '.$cookie3);
header('set-cookie: '.$cookie4);
echo json_encode(array(
    'cookie'    => $cookie1.';'.$cookie2.';'.$cookie3.';'.$cookie4,
    'body'      => $response['body']
));

//NMTID=00OK4o2T3irS677z0wtu1X0zjDQf0cAAAF6qS0UZA;__csrf=54735ddb2dd85a553fa474f727b7eb0e;__remember_me=true;MUSIC_U=00ACF414C24D4317B62A44075BE57C525F40E112CC347098E26B6D7356F89A6D04797D0EFC437DD3C817EA5952720627F87BFEB9968EE7AECE771922669F0E68410CFDCF264E547E9CF81F1C15B45EA88559BDDB3E4C7F674E6F32E69C7E003E3F7744303B63045018E3C9C5DC999596C082C14058F2BB9902A2711E533C62BD1846E5B8FBDCD14466190BF3E0A182B99248910AD2FA795E2617E3021F45BBF5725D0BF477E6A8F90C6174C1B208FAC1F0F6387D53C4AE4A92AE33BF4E44DA8FB173A78947CAE673E9A2CAEEFCB9BB65B6647604B7D443E27A5C2CC2EBC0215E20EDFDF293E7FC780094511FE54FF6ECC9D094D4A26D780EAB1F58DEFFE410D2A8D63D879A2622ED4488A0DA9565323CD8