<?php
require 'config/config.php';

$title = "Veja alguns";
include path('include/header.php');
?>

        <div class="inner cover">
           	<div class="row" style="text-shadow: none;">
            	<?php
	            $events = DBRead('events', 'where actived = true');
	            if ($events) {
	              echo "<h3>Confira quem já usou, e recomenda!</h3>";
	              foreach ($events as $key => $value) {
	                $path = path('assets/images/events/' . $value['id']);
	                $handle = opendir($path);
	                while (false !== ($file = readdir($handle))) {
	                  if ($file != "." && $file != "..") {
	                      $files[] = $file;
	                  }
	                }
	                $thumb = $files[rand(0,count($files)-1)];
	            ?>
	            <div class="col-sm-6 col-md-4 col-xs-4">
	            	<div>
	                 	<img src="<?= url('assets/images/events/' . $value['id'] . '/' . $thumb) ?>" alt="..." class="img-thumbnail" style="width: 300px; height: 300px">
	                	<div class="caption">
	                    	<h3><?= $value['name'] ?></h3>
	                    	<p><?= date_event($value['date'], "d/m/Y") . ' - ' . $value['location'] ?></p>
	                    	<p class="btn-block"><a href="<?= url('event/' . encode($value['name'],"-") . '/' . encode($value['location'],"-") . '/' . $value['id']) ?>" class="btn btn-danger" role="button">Ver</a> <a href="<?= url('download/' . encode($value['name']) . '/' . encode($value['location']) . '/' . $value['id']) ?>" class="btn btn-primary" role="button">Baixar</a></p>
	                  	</div>
	                </div>
	            </div>
	            <?php
	            unset($files,$thumb);
	              }
	            }else{ ?>
	              <h1>Ainda não temos nenhum colaborador, <a href="mailto:joao.nascimento92@etec.sp.gov.br">entre em contato</a> se quiser mudar isto</h1>
	            <?php } ?>

            </div>
        </div>

          <div class="mastfoot" style="color:#fff;">
            <div class="inner">
              <p class="lead copy">Copyright &copy; <a href="//fb.com/joaovictor.nascimento.9250" target="blank">João Victor Nascimento</a>, Todos Direitos Reservados.
                </p>
            </div>
          </div>

<?php include path('include/footer.php'); ?>