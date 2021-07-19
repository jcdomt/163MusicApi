<?php
include_once('../core/core.php');
$id = id();
$cookie = param('cookie',DEFAULT_COOKIE,false);
$arr = array(
    'id'    => $id,
    'n'     => 100000,
    's'     => 8
);
echo request('https://music.163.com/weapi/v6/playlist/detail',$arr,false,$cookie);