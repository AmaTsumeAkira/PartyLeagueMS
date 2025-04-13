<?php
// controller\logincont.php

// 导入配置文件
require_once('.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 处理登录请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取登录表单提交的用户名和密码
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用预处理语句防止 SQL 注入攻击
    $stmt = $conn->prepare("SELECT user_type FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($user_type);

    // 检查用户是否存在并且密码正确
    if ($stmt->fetch()) {
        // 登录成功，设置会话信息或者其他逻辑
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        echo "登陆成功，正在跳转...";
        header("refresh:1;url=../index.php");
    } else {
        // 登录失败
        echo "用户名或密码无效，跳转回登录页面...";
        header("refresh:1;url=../login.php");
    }
    
    // 关闭数据库连接
    $stmt->close();
    $conn->close();
}
?>
