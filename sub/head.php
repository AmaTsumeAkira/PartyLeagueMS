<?php
session_start();
$_SESSION['username'];
?>
<!doctype html>
<html lang="zh_cn">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php echo $pageTitle; ?></title>
    <!-- CSS files -->
    <link href="../tabler/dist/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="../tabler/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="../tabler/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="../tabler/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    <link href="../tabler/dist/css/demo.min.css?1684106062" rel="stylesheet" />
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

<body>
