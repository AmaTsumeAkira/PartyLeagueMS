
<?php
    $pageTitle = "信息科技学院推优管理系统"; // 设置页面标题
    // 其他页面逻辑和内容
    include '.\sub\head.php'; // 包含页眉文件
?>
  <script src="./tabler/dist/js/demo-theme.min.js?1684106062"></script>
  <div class="page">
    <!-- Navbar -->
    <?php
    include '.\sub\bodyhead.php'; 
    ?>
    <div class="page-wrapper">
      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                <?php
                session_start();
                if (empty($_SESSION['username'])) {
                  echo "欢迎您访问信息科技学院推优管理系统，请登录！";
                } else {
                  echo $_SESSION['username'] . "同志，欢迎您访问信息科技学院推优管理系统";
                }
                ?>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
            <div class="col-3">
              <div class="card placeholder-glow">
                <div class="ratio ratio-21x9 card-img-top"><img src="..\photo\dwgl.png"></div>
                <div class="card-body">
                  <div class="col-9 mb-2">
                    <h3>党务管理</h3>
                  </div>
                  <div class="divide-y-2 mt-4">
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              数据概览
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              推优管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              入党积极分子管理与推优
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              党员（预备党员）管理与转接
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                              无剩余开发计划
                            </div>
                          </div>
                  <div class="mt-3">
                    <a href="dwgl/tuiyou.php" tabindex="-1" class="btn btn-red col-4" aria-hidden="true">点击进入</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card placeholder-glow">
              <div class="ratio ratio-21x9 card-img-top"><img src="..\photo\twgl.png"></div>
                <div class="card-body">
                  <div class="col-9 mb-2">
                    <h3>团务管理</h3>
                  </div>
                  <div class="divide-y-2 mt-4">
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              团支书管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              团员管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              推优管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              智育综测管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                              三会一课管理与核查
                            </div>
                          </div>
                  <div class="mt-3">
                    <a href="twgl" tabindex="-1" class="btn btn-yellow col-4" aria-hidden="true">点击进入</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card placeholder-glow">
              <div class="ratio ratio-21x9 card-img-top"><img src="..\photo\zbgl.png"></div>
                <div class="card-body">
                  <div class="col-9 mb-2">
                    <h3>团支部管理</h3>
                  </div>
                  <div class="divide-y-2 mt-4">
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              团员管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              团支部管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              智育综测管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                              三会一课管理
                            </div>
                            <div>
                              &nbsp;
                            </div>
                          </div>
                  <div class="mt-3">
                    <a href="tzs" tabindex="-1" class="btn btn-twitter col-4" aria-hidden="true">点击进入</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card placeholder-glow">
              <div class="ratio ratio-21x9 card-img-top"><img src="..\photo\xtgl.png"></div>
                <div class="card-body">
                  <div class="col-9 mb-2">
                    <h3>管理员登录</h3>
                  </div>
                  <div class="divide-y-2 mt-4">
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              用户管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                              班级（团支部）管理
                            </div>
                            <div>
                              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                              字段管理
                            </div>
                            <div>
                              &nbsp;
                            </div>
                            <div>
                              &nbsp;
                            </div>
                          </div>
                  <div class="mt-3">
                    <a href="admin" tabindex="-1" class="btn btn-facebook col-4" aria-hidden="true">点击进入</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <!-- <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span
                        class="bg-red text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="24"
                          height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path
                            d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        学生党员(预备党员)
                      </div>
                      <div class="text-muted">
                        35名
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span
                        class="bg-yellow text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star-filled"
                          width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path
                            d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                            stroke-width="0" fill="currentColor" />
                        </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        共青团员
                      </div>
                      <div class="text-muted">
                        32名
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span
                        class="bg-twitter text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24"
                          height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                          <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                        </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        学生会成员
                      </div>
                      <div class="text-muted">
                        16名
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span
                        class="bg-facebook text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cube-unfolded"
                          width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M2 15h10v5h5v-5h5v-5h-10v-5h-5v5h-5z" />
                          <path d="M7 15v-5h5v5h5v-5" />
                        </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        团支部
                      </div>
                      <div class="text-muted">
                        21个
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>

      </div>


    </div>



    <?php
    include '.\sub\footer.php'; // 包含页脚文件
    ?>