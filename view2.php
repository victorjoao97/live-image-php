<?php
require 'config/config.php';

if (!isset($_GET['hue']))
{
	header('Location: ' . url);
}
elseif (!DBRead('events',"where id = '" . $_GET['hue'] . "' and actived = true"))
{
	header('Location: ' . url);
}
else
{
	$event = DBRead('events',"where id = '" . $_GET['hue'] . "' limit 1")[0];
	$title = $event['name'] . ' ' . date_event($event['date'],"d/m/Y");

	?>
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

    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>

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
    <style>body{
  background: #965994;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.container{
  max-width: 600px;
  margin: 50px auto;
  font-family: 'Open Sans', sans-serif;
}

.phone{
  position: relative;
  background: #1e1e1e;
  height: 500px;
  width: 250px;
  border-radius: 25px;
  margin: 0 auto;
}

.camera{
  position: absolute;
  background: #7A7A7A;
  height: 8px;
  width: 8px;
  border-radius: 15px;
  top: 22px;
  left: 85px;
}

.speaker{
  position: absolute;
  background: #7A7A7A;
  height: 6px;
  width: 50px;
  border-radius: 15px;
  top: 22px;
  left: 105px;
}

.sleep-button{
  position: absolute;
  background: #1e1e1e;
  height: 35px; 
  width: 3px;
  border-top-right-radius: 3px 3px;
  border-bottom-right-radius: 3px 3px;
  top: 105px;
  left: 250px;
}

.silent-switch{
  position: absolute;
  background: #1e1e1e;
  height: 25px;
  width: 3px;
  border-top-left-radius: 3px 3px;
  border-bottom-left-radius: 3px 3px;
  top: 60px;
  left: -3px;
}

.volume{
  position: absolute;
  background: #1e1e1e;
  width: 3px;
  height: 35px;
  border-top-left-radius: 3px 3px;
  border-bottom-left-radius: 3px 3px;
  left: -3px;
}

.up{
  top: 105px;
}

.down{
  top: 145px;
}

.screen{
  position: absolute;
  overflow: hidden;
  background: #fff;
  height: 390px;
  width: 230px;
  top: 50px;
  left: 10px; 
}

.timer {
  position: absolute;
  background: rgba(0, 0, 0, 0.5);
  height: 20px;
  width: 38px;
  border-radius: 3px;
  top: 5px;
  left: 177px;
  padding: 5px;
  text-align: center;
  color: #fff;
  font-size: 14px;
}

.caption-container{
  position: absolute;
  width: 100%;
  background: rgba(0, 0, 0, 0.5);
  top: 250px;
  color: #fff;
  text-align: center;
}

.caption{
  font-size: 16px;
  font-weight: 300;
  margin: 8px;
}

.home-button{
  position: absolute;
  border: 1px solid #7A7A7A;
  height: 35px;
  width: 35px;
  border-radius: 25px;
  bottom: 12px;
  left: 50%;
  margin-left: -18px;
}
</style>
  </head>

  <body>
    <script type="text/javascript">

      var curimg=0;

      function rotateimages(){
        if (galleryarray.length == 0) {
          $(".screen img").attr("style", "background-image:none; webkit-transition: all 3s ease;-moz-transition: all 3s ease;-o-transition: all 3s ease;transition: all 3s ease;");
        }else{
          $(".screen img").attr("style", "webkit-transition: all 3s ease;-moz-transition: all 3s ease;-o-transition: all 3s ease;transition: all 3s ease;");
          $(".screen img").attr("src",galleryarray[curimg]);
        }
      }

      function carregaTodas() {
        if ((typeof para && para != true)) {
          //if ((galleryarray.length - 1) > ) {};
          for (var i = 0; i <= galleryarray.length - 1; i++) {
            $("#carrega").append("<img src='"+galleryarray[i]+"' id='"+ i + "' style='display:none'/>");
            var para = true;
          };
        };
      }
      function apaga(){
        if ((typeof para && para != true)) {
          //if ((galleryarray.length - 1) > ) {};
          for (var i = 0; i <= galleryarray.length; i++) {
            $("#carrega #"+i).remove();
            var para = true;
          };
        };
      }

      window.onload=function(){
        setInterval(function(){
        $.getScript('<?= url('include/return_images.php?q=' . $event['id']) ?>')
          .done(function( script, textStatus ) {
            curimg = Math.floor((Math.random() * galleryarray.length) + 0);
            if (galleryarray.length == 0) {
              $(".count").text("Foto");
              $(".atual").text("Nenhuma ");
            }else{
              $(".timer").text(curimg + "/" + (galleryarray.length));
          }
          })
        }, 10000);
        setInterval("rotateimages()", 3000);
      }
    </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <div class="container">
      <div class="phone">
        <div class="camera"></div>
        <div class="speaker"></div>
        <div class="sleep-button"></div>
        <div class="silent-switch"></div>
        <div class="volume up"></div>
        <div class="volume down"></div>
        <div class="screen">
          <img width="230" height="390" src="<?= url("assets/images/logo/logo2.png") ?>">
          <span class="timer">3</span>
          <div class="caption-container">
            <h3 class="caption"><?= $event['name'] ?></h3>
          </div>  
        </div>
        <div class="home-button"></div>
      </div>
    </div>

	</body>
<?php include path('include/footer.php'); } ?>