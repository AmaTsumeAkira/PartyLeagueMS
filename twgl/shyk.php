<?php
    $pageTitle = "三会一课管理"; // 设置页面标题
    $qxyq = "3"; // 设置权限
    // 1=超级管理员
    // 2=党务、团务、学生会管理员
    // 3=团务、学生会管理员
    // 4=学生会管理员
    // 5=各级团支书
    // 其他页面逻辑和内容
    include '..\sub\qxpd.php'; // 包含页眉文件
    include '..\sub\head.php'; // 包含页眉文件
?>
    <script src="../tabler/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        <?php
    include '..\sub\bodyhead.php'; 
    include './menu.php'; 
    ?>



<?php
    include '..\sub\footer.php'; // 包含页脚文件
    ?>
