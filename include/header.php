<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= url('assets/images/logo/favicon.ico') ?>">

    <title><?= (isset($title)) ? $title . ' - ' : null ?><?= name ?></title>

    <link rel="stylesheet" href="<?= url('assets/css/bootstrap.min.css') ?>">

    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>

    <script src="<?= url('assets/js/bootstrap.min.js') ?>"></script>

    <link href="<?= url('assets/css/cover.css') ?>" rel="stylesheet">

    <link href="<?= url('assets/css/custom.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= url("assets/images/icons/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= url("assets/images/icons/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= url("assets/images/icons/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= url("assets/images/icons/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= url("assets/images/icons/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= url("assets/images/icons/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= url("assets/images/icons/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= url("assets/images/icons/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= url("assets/images/icons/apple-icon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= url("assets/images/icons/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= url("assets/images/icons/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= url("assets/images/icons/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= url("assets/images/icons/favicon-16x16.png") ?>">
    <link rel="manifest" href="<?= url("assets/images/icons/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= url("assets/images/icons/ms-icon-144x144.png") ?>">
    <meta name="theme-color" content="#ffffff">
  </head>

  <body id="body">

    <div class="site-wrapper text-shadow">

      <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                  <h3 class="masthead-brand"><a href="<?= url() ?>">LiveImage</a></h3>
                  <nav>
                    <ul class="nav masthead-nav">
                        <?= item_menu("Veja alguns","events") ?>
                        <?= item_menu("Administre seu evento","admin") ?>
                    </ul>
                  </nav>
                </div>
            </div>