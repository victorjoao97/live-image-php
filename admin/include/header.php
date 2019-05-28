<?php
if ($user_ = DBRead('users',"where id = '{$_SESSION['user']}' and pass = '{$_SESSION['pass']}' limit 1")[0])
{
  $_SESSION['user'] = $user_['id'];
  $_SESSION['name'] = $user_['user'];
  $_SESSION['pass'] = $user_['pass'];
  $_SESSION['su'] = $user_['su'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= url('assets/images/logo/favicon.ico') ?>">

    <title><?= (isset($title)) ? $title . ' - ' : null ?><?= 'Painel ' . name ?></title>

    <link rel="stylesheet" href="<?= url('admin/assets/css/bootstrap.css') ?>">

    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>

    <script src="<?= url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= url('assets/js/custom.js') ?>"></script>


    <link href="<?= url('admin/assets/css/custom.css') ?>" rel="stylesheet">
    <!-- FIM DOS ESTILOS -->
    <link href="<?= url('admin/assets/css/dashboard.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= url("assets/images/icons/") ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?= url("assets/images/icons/") ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= url("assets/images/icons/") ?>/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?= url("assets/images/icons/") ?>/manifest.json">
    <link rel="mask-icon" href="<?= url("assets/images/icons/") ?>/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?= url("assets/images/icons/") ?>/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="LiveImage">
    <meta name="application-name" content="LiveImage">
    <meta name="msapplication-config" content="<?= url("assets/images/icons/") ?>/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= url('admin/home') ?>"><img width="22" src="<?= url('assets/images/icons/android-chrome-192x192.png') ?>"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?= item_menu("Home","admin/home") ?>
            <?= item_menu("Incluir evento","admin/event/add") ?>
            <?= item_menu("Seus eventos","admin/event/all") ?>
            <?= item_menu("Incluir usuário","admin/user/add",true) ?>
            <?= item_menu("Usuários","admin/user/all",true) ?>
            <?= item_menu("Sair","admin/logout") ?>
          </ul>
          <p class="navbar-text navbar-right" style="margin-right:0;">Bem vindo <b><?= $_SESSION['name'] ?></b></p>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <?= item_menu("Incluir evento","admin/event/add") ?>
            <?= item_menu("Seus eventos","admin/event/all") ?>
            <?= item_menu("Incluir usuário","admin/user/add",true) ?>
            <?= item_menu("Usuários","admin/user/all",true) ?>
            <?= item_menu("Site") ?>
            <?= item_menu("Sair","admin/logout") ?>
          </ul>
          <div>
            <img class="img-responsive" src="<?= url("assets/images/logo/logo2.png") ?>">
            <p style="font-size:12px"><?= name ?> &copy; <?= date("Y") ?><br>Todos direitos reservados<br><span style="font-size:15px">Desenvolvido por <a href="//facebook.com/joaovictor.nascimento.9250">João</a></span></p>
          </div>
      </div>