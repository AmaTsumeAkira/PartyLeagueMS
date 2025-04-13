<?php
// logout.php

// 启动会话
session_start();

// 清除所有会话变量
$_SESSION = array();

// 如果要清除会话 cookie，请将会话 cookie 的过期时间设置为过去的时间
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// 最后销毁会话
session_destroy();

// 重定向用户到登录页面或其他适当的页面
header("Location: login.php");
exit();
?>
