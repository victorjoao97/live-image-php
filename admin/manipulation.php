<?php 
require_once "../config/config.php";

if(!isset($_SESSION["auth"])){
	if($_SESSION["auth"] != true){
		header("Location: " . url('admin/logon'));
	}
}
if (!isset($_GET['obj']) || !isset($_GET['action']) || !isset($_GET['id']))
{
	header("Location: " . url('admin/home'));
}else{

	switch ($_GET['obj']) {
		case 'photo':
			switch ($_GET['action']) {
				case 'delete':
					$url = path("assets/images/events/" . strstr($_GET['id'],"-",true) . "/" . substr(strstr($_GET['id'],"-"), 1) . ".jpg");
					if (unlink($url))
					{
						header("location: " . url("admin/event/edit/" . strstr($_GET['id'],"-",true)));
					}else{
						header("location: " . url("admin/error/photo"));
					}
				break;
				
				default:
					header("location: " . url("admin/event/all"));
					break;
			}
			break;
		case 'event':
			if ($_SESSION['su']) {
				$event = DBRead( 'events', "where id = '{$_GET['id']}' order by date desc limit 1" )[0];
			}else{
				$event = DBRead('events,events_users', "where events.id = '{$_GET['id']}' and (events_users.event_id = '{$_GET['id']}' and events_users.user_id = '{$_SESSION['user']}') order by date desc limit 1")[0];
			}
			if(!$event)
			{
				header("Location: " . url('admin/event/add'));
			}else
			{
				switch ($_GET['action']) {
					case 'delete':

						if (deldir(path("assets/images/events/" . $event['id']))) {
							if (DBDelete('events',"id = '{$event['id']}'")) {
								header("Location: " . url('admin/event/all'));
							}else{
								header("location: " . url("admin/error/event"));
							}
						}
						
						break;
					case 'active':
						if (DBUpdate('events',array("actived"=>1),"id = '{$event['id']}'")) {
							header("Location: " . url('admin/event/all'));
						}
						break;

					case 'deactivate':
						if (DBUpdate('events',array("actived"=>0),"id = '{$event['id']}'")) {
							header("Location: " . url('admin/event/all'));
						}
						break;
					
					case 'edit':
						$title = "Alterar " . $event['name'] . ' - ' . $event['location'];
						include path('admin/include/header.php');

						?>
						<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
							<h1 class="page-header"><?= $title ?><a href="<?= url("admin/upload") ?>" class="btn btn-primary pull-right">Add Photo</a></h1>
							<?php
								if( !$event ) { ?>
									<h2>Nenhum evento cadastrado</h2>";
							<?php }
								else
									$path = path('assets/images/events/' . $event['id']);
									$handle = opendir($path);
						            if(count(scandir($path)) > 2)
						            {
						            while (false !== ($file = readdir($handle))) {
						            	var_dump($file);
						              if ($file != "." && $file != "..") {
						              	$i = 0;
										$i++;
						              	$path_file = url('assets/images/events/' . $event['id'] . '/' . $file);
						              	$path = path('assets/images/events/' . $event['id'] . '/' . $file);
						                  ?>
							<div class="col-xs-6 col-sm-3 placeholder text-center" id="event-<?= $event['id'] ?>">
									<a data-toggle="modal" data-target="#myModal-<?= $i ?>">
										<img src="<?= $path_file ?>" class="img-responsive" alt="<?= $file ?>" style="width: 200px; height: 200px;">
									</a>
								<h4><?= $file ?></h4>
								<span class="text-muted"><?= $event['name'] . " - " . $event['location'] ?></span>
								<ul class="list-group text-left">
									<li class="list-group-item">
										<span class="badge"><?= date("d/m/y h:i:s", filemtime($path)) ?></span>
										Criado
									</li>
								</ul>
								<p>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal-<?= $i ?>">Ver</button>
									<a onclick="del('<?= url('admin/photo/delete/') ?>', '<?= $event['id'] . "-" . strstr($file,".",true) ?>')" class="btn btn-danger btn-sm">Deletar<?= $i ?></a>
								</p>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="myModal-<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?= $file ?></h4>
							      </div>
							      <div class="modal-body">
							        <img src="<?= $path_file ?>" class="img-responsive">
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
									<a onclick="del('<?= url('admin/photo/delete/') ?>', '<?= $event['id'] . "-" . strstr($file,".",true) ?>')" class="btn btn-danger">Deletar</a>
							      </div>
							    </div>
							  </div>
							</div>
						                  <?php
						               }
							?>
					<?php		}
							}else{ ?>
								<h3><span class=\"label label-danger\">Nenhuma foto encontrada</span></h3>
					<?php		}
					?> 
							</div> <?php
							include path("admin/include/footer.php");
						break;
					
					default:
						# code...
						break;
				}
			}
			break;

			case 'user':

				if ($_SESSION['su']) {
					$user = DBRead( 'users', "where id = '{$_GET['id']}'")[0];
				}
				if(!$user)
				{
					header("Location: " . url('admin/home'));
				}else
				{

					switch ($_GET['action'])
					{
						case 'active':
						if (DBUpdate('users',array("actived"=>1),"id = '{$user['id']}'")) {
							header("Location: " . url('admin/user/all'));
						}
						break;
					
						case 'deactivate':
						if (DBUpdate('users',array("actived"=>0),"id = '{$user['id']}'")) {
							header("Location: " . url('admin/user/all'));
						}
						break;

						case 'delete':
						if (DBDelete('users', "id = '{$user['id']}'")) {
							header("Location: " . url('admin/user/all'));
						}
						break;
					
						case 'edit':
						$user = DBRead('users', "where id = '{$_GET['id']}'")[0];
						if (isset($_POST['submit']))
						{
							$form['user'] = $_POST['user'];
							if ($_POST['pass'])
							{
								$form['pass'] = md5($_POST['pass']);
							}
							$form['su'] = $_POST['su'];

							if ($form)
							{
								
								if (DBRead('users',"where id <> '{$_GET['id']}' and user = '{$form['user']}' limit 1")[0])
								{
									$text = "<h3><span class=\"label label-danger\">Usuário cadastrado</span></h3>";
								}elseif(DBRead('users',"where user <> '{$form['user']}' limit 1")[0]){
									if (DBUpdate('users',$form,"id = '{$_GET['id']}'"))
									{
										$text = "<h3><span class=\"label label-success\">Usuário cadastrado com sucesso</span></h3>";
										header("location: " . url("admin/user/edit/" . $_GET['id']));
									}
								}
							}
						}
						$title = "Editar usuário - " . $user['user'];
						include path('admin/include/header.php');
						?>
						<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
							<h1 class="page-header"><?= $title ?></h1>
							<form method="post">
								<?= (isset($text)) ? $text : null ?>
								<div class="form-group">
									<label for="user">Usuário</label>
									<input type="text" id="user" name="user" class="form-control" value="<?= $user['user'] ?>">
								</div>
								<div class="form-group">
									<label for="pass">Senha</label>
									<input type="password" id="pass" name="pass" class="form-control">
								</div>
								<div class="form-group">
									<label for="su" class="radio-inline"><input <?= ($user['su'] == true) ? "checked=\"checked\"" : null ?> type="radio" id="su" name="su" value="1">Administrador</label>
									<label for="no_su" class="radio-inline"><input  <?= ($user['su'] == false) ? "checked=\"checked\"" : null ?> type="radio" id="no_su" name="su" value="0">Usuário</label>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-block btn-danger">
								</div>
							</form>	
						</div>

					<?php break;
					
					default:
						# code...
						break;
				}
			}
		
		default:
			# code...
			break;
	}
}
?>