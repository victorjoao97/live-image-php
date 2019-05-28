<?php
require '../config/config.php';

if(isset($_SESSION["auth"])){
  if($_SESSION["auth"] === true){
    header("Location: " . url('admin/home'));
  }
}

$title = "Logon";

if (isset($_POST['submit']))
{
  $user = $_POST['user'];
  $pass = md5($_POST['pass']);

  if ($user || $pass)
  {
    if ($users = DBRead('users',"where user = '{$user}' and pass = '{$pass}' limit 1")[0]) {
      $_SESSION['auth'] = true;
      $_SESSION['user'] = $users['id'];
      $_SESSION['pass'] = $users['pass'];
      $_SESSION['su'] = $users['su'];
      header("Location: " . url('admin/home'));
    }else{
      echo "<h3><span class=\"label label-danger\">Usuário ou Senha inválidos!</span></h3>";
      $_SESSION['auth'] = false;
    }
  }else{
    echo "<h3><span class=\"label label-danger\">Preencha todos os campos!</span></h3>";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= url('assets/images/logo','favicon.ico') ?>">
    <title><?= (isset($title)) ? $title . ' - ' : null ?><?= name ?></title>
    <link rel="stylesheet" href="<?= url('admin/assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= url('admin/assets/css/signin.css') ?>">
    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="post">
        <a href="<?= url() ?>"><img src="<?= url("assets/images/logo/logo2.png") ?>" width="300"></a>
        <h2 class="form-signin-heading">Entre com seu nome de usuário e senha</h2>
        <div class="form-group">
          <label for="inputEmail" class="sr-only">Nome de usuário</label>
          <input name="user" type="text" id="inputEmail" class="form-control input-lg" placeholder="Nome de usuário" required autofocus="autofocus" value="<?= (isset($_POST['user'])) ? $_POST['user'] : null ?>">
        </div>
        <div class="form-group">
          <label for="inputPassword" class="sr-only">Senha</label>
          <input name="pass" type="password" id="inputPassword" class="form-control input-lg" placeholder="Senha" required>
        </div>
        <div class="form-group">
          <input class="btn btn-lg btn-primary col-md-6" name="submit" type="submit" value="Entrar" />
          <a class="btn btn-lg btn-danger col-md-6" href="<?= url() ?>">Voltar</a>
        </div>
        <h5 class="form-signin-heading">Serão fornecidos pelo administrador, e terão uma validade de acordo com a aquisição da ferramenta</h5>
      </form>
    </div>
  </body>
</html>