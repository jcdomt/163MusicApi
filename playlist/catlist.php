<?php
include_once('../core/core.php');

echo request('https://music.163.com/weapi/playlist/catalogue',["csrf_token"=>""]);