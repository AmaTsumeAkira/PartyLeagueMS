<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="zh_cn">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>登录</title>
    <!-- CSS files -->
    <link href="./tabler/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./tabler/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./tabler/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./tabler/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./tabler/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./tabler/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">信息科技学院推优管理系统</h2>
            <form action="controller/logincont.php" method="post" >
              <div class="mb-3">
                <label class="form-label">账号</label>
                <input type="username" class="form-control" placeholder="请输入你的账号" autocomplete="off" id="username" name="username">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  密码
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control"  placeholder="请输入你的密码"  autocomplete="off" id="password" name="password">
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">登录</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./tabler/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./tabler/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>