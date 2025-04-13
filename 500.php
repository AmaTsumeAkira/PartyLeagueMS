
<?php
    $pageTitle = "权限不足"; // 设置页面标题
    include '.\sub\head.php'; // 包含页眉文件
?>
    <script src="./tabler/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        <?php
    include '.\sub\bodyhead.php'; 
    ?>
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-header">权限不足</div>
          <p class="empty-title">您没有此模块的访问权限</p>
          <p class="empty-subtitle text-muted">
            请联系管理员开通权限。
          </p>
          <div class="empty-action">
            <a href="./index.php" class="btn btn-primary">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
              返回主页
            </a>
          </div>
        </div>
      </div>


<?php
    include '.\sub\footer.php'; // 包含页脚文件
    ?>