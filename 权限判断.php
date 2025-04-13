<?php
// test.php

// 启动会话
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['username']) || !isset($_SESSION['user_type'])) {
    // 如果用户未登录，将其重定向到登录页面
    header("Location: login.php");
    exit();
}

// 检查用户类型
$user_type = $_SESSION['user_type'];

// 如果用户类型不是所需的类型，可以采取相应的操作，比如提示权限不足，或者重定向到其他页面
if ($user_type != '1') {
    echo "权限不足！禁止访问该页面！";
    exit();
}

// 用户已登录且拥有所需的用户类型，可以继续访问该页面的内容

// 输出欢迎信息
echo "Welcome, " . $_SESSION['username'] . "! You have permission to access this page.";

// 可以在这里添加其他页面内容
?>
