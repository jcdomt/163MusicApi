<?php
include_once('../core/core.php');
$cookie = cookie();
$keyword = param('keyword','',true);
$limit = param('limit',30);
$type = param('type',1) ;
$offset = param('offset',0);
$arr = array(
    's' => $keyword,
    'type'  => $type,
    'limit' => $limit,
    'offset'  => $offset,
);
echo request('https://music.163.com/weapi/search/get',$arr,false,$cookie);