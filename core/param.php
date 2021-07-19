<?php
function param($n,$default='',$must = false) {
    $p='';
    if($_GET[$n]!='') {
        $p = urldecode($_GET[$n]);
    } else {
        $p = $_POST[$n];
    }
    if($p=='' && $must) {
        echo '缺少必要参数：'.$n.'<br>';
        exit();
    }
    if($p=='' && !$must) {
        return $default;
    }
    return $p;
}

// 懒虫专用
function cookie() {
    return param('cookie',DEFAULT_COOKIE,true);
}
function uid() {
    return param('uid',0,true);
}
function id() {
    return param('id',0,true);
}