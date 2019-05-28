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
                  <h3 class="masthead-brand"><a href="<?= url() ?>"><img width="100" src="<?= url("assets/images/icons/android-chrome-192x192.png") ?>"></a></h3>
                  <nav>
                    <ul class="nav masthead-nav">
                        <li class="active"><h1><span class="timer">Loading...</span></h1></li>
                    </ul>
                  </nav>
                </div>
            </div>
    <script type="text/javascript">

      var curimg=0;

      function rotateimages(){
        if (galleryarray.length == 0) {
          $("body").attr("style", "background-image:none; background-repeat: round;webkit-transition: all 3s ease;-moz-transition: all 3s ease;-o-transition: all 3s ease;transition: all 3s ease;");
        }else{
          document.getElementById("body").setAttribute("style", "background-image:url('"+galleryarray[curimg]+"'); background-repeat: round;webkit-transition: all 3s ease;-moz-transition: all 3s ease;-o-transition: all 3s ease;transition: all 3s ease;");
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
              $(".timer").text("0");
            }else{
              $(".timer").text(curimg + "/" + (galleryarray.length));
          }
          })
        }, 8000);
        setInterval("rotateimages()", 5000);
      }
    </script>

	          <div class="inner cover">
	            <div id="carrega"></div>
	          </div>

	          <div class="mastfoot">
	            <div class="inner">
                <div class="caption-container">
                  <h1 class="caption"><?= $event['name'] . ' - ' . date_event($event['date'] , "d/m/Y") . ' - ' . $event['location'] ?><br><?= $event['message'] ?></h1>
                </div>
					<p class="lead copy">LiveImage &copy; Copyright. <a href="//fb.com/joaovictor.nascimento.9250" target="blank">João Victor Nascimento</a>, Todos Direitos Reservados.
					</p>
	            </div>
	          </div>

	        </div>

	      </div>

	    </div>

	</body>
<?php include path('include/footer.php'); } ?>