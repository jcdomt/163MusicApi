<?php
include_once('../core/core.php');
$cookie = cookie();
$uid    = uid();
$limit = param('limit',30);
$offset = param('offset',0);
$arr = array(
    'uid'       => $uid,
    'limit'     => $limit,
    'offset'    => $offset,
    'includeVideo'  => true
);
echo request('https://music.163.com/weapi/user/playlist',$arr,false,$cookie);