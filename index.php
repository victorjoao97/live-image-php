<?php
require 'config/config.php';

include path('include/header.php');
?>

          <div class="inner cover">
            <div class="row">
              <img src="<?= url('assets/images/logo/logo2.png') ?>">
              <h1>Você ao Vivo!</h1>
              <br>
              <div class="btn-group-vertical">
                <a href="<?= url("admin") ?>" class="btn btn-primary btn-lg btn-block">Administre seu evento</a>
                <br>
                <a href="<?= url("events") ?>" class="btn btn-danger btn-lg btn-block">Veja alguns</a>
              </div>
            </div>
          </div>

          <div class="mastfoot" style="color:#fff;">
            <div class="inner">
              <!-- <h1 class="cover-heading">Adquira para seu Evento!</h1> -->
              <p class="lead"><a href="mailto:joao.nascimento92@etec.sp.gov.br">Entre em contato</a></p>
              <p class="lead copy">Copyright &copy; <a href="//fb.com/joaovictor.nascimento.9250" target="blank">João Victor Nascimento</a>, Todos Direitos Reservados.
                </p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </body>
<?php include path('include/footer.php'); ?>