<?php
include_once('../core/core.php');
$cookie = cookie();
$arr = array();
echo request('https://music.163.com/api/nuser/account/get',$arr,false,$cookie);