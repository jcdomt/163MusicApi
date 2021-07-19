<?php
include_once('../core/core.php');
$cookie = cookie();
$arr = array();
echo request('https://music.163.com/weapi/subcount',$arr,false,$cookie);