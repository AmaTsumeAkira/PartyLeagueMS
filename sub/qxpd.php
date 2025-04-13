<?php
// test.php

// 启动会话
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['username']) || !isset($_SESSION['user_type'])) {
    // 如果用户未登录，将其重定向到登录页面
    header("Location: ../login.php");
    exit();
}

// 检查用户类型
$user_type = $_SESSION['user_type'];

// 如果用户类型不是所需的类型，可以采取相应的操作，比如提示权限不足，或者重定向到其他页面
if ($user_type > $qxyq) {
    header("Location: ../500.php");
    exit();
}
?>