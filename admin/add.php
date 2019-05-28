<?php 
require_once "../config/config.php";

if(!isset($_SESSION["auth"])){
	if($_SESSION["auth"] != true){
		header("Location: " . url('admin/logon'));
	}
}
if (!$_SESSION['su']) {
	header("Location: " . url('admin/home'));
}

if (!isset($_GET['obj']) || !isset($_GET['action'])) {
	header("Location: " . url('admin/home'));
}else{

	switch ($_GET['obj']) {
		case 'user':
			switch ($_GET['action']) {
				case 'add':
					if (isset($_POST['submit']))
					{
						$form['user'] = $_POST['user'];
						$form['pass'] = md5($_POST['pass']);
						$form['su'] = $_POST['su'];

						if ($form)
						{
							if (DBRead('users',"where user = '{$_POST['user']}' limit 1")[0])
							{
								$text = "<h3><span class=\"label label-danger\">Usuário cadastrado</span></h3>";
							}else{
								if (DBCreate('users',$form))
								{
									$text = "<h3><span class=\"label label-success\">Usuário cadastrado com sucesso</span></h3>";
								}
							}
						}
					}
					$title = "Incluir usuário";
					include path('admin/include/header.php');
					?>
					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						<h1 class="page-header"><?= $title ?></h1>
						<form method="post">
							<?= (isset($text)) ? $text : null ?>
							<div class="form-group">
								<label for="user">Usuário</label>
								<input type="text" id="user" name="user" class="form-control">
							</div>
							<div class="form-group">
								<label for="pass">Senha</label>
								<input type="password" id="pass" name="pass" class="form-control">
							</div>
							<div class="form-group">
								<label for="su" class="radio-inline"><input type="radio" id="su" name="su" value="1">Administrador</label>
								<label for="no_su" class="radio-inline"><input type="radio" id="no_su" name="su" value="0">Usuário</label>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-block btn-danger">
							</div>
						</form>	
					</div>
					<?php
					include path("admin/include/footer.php");
					break;
				
				case 'edit':
					$user = DBRead('users', "where id = '{$_GET['id']}'")[0];
					if (isset($_POST['submit']))
					{
						$form['user'] = $_POST['user'];
						$form['pass'] = md5($_POST['pass']);
						$form['su'] = $_POST['su'];

						if ($form)
						{
							if (DBRead('users',"where user = '{$_POST['user']}' limit 1")[0])
							{
								$text = "<h3><span class=\"label label-danger\">Usuário cadastrado</span></h3>";
							}else{
								if (DBCreate('users',$form))
								{
									$text = "<h3><span class=\"label label-success\">Usuário cadastrado com sucesso</span></h3>";
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
								<input type="text" id="user" name="user" class="form-control" value="<?= (isset($_GET["user"])) ? $_GET['user'] : null ?>">
							</div>
							<div class="form-group">
								<label for="pass">Senha</label>
								<input type="password" id="pass" name="pass" class="form-control">
							</div>
							<div class="form-group">
								<label for="su" class="radio-inline"><input type="radio" id="su" name="su" value="1">Administrador</label>
								<label for="no_su" class="radio-inline"><input type="radio" id="no_su" name="su" value="0">Usuário</label>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-block btn-danger">
							</div>
						</form>	
					</div>
					<?php
					include path("admin/include/footer.php");
					break;

				case 'all':

					$title = "Usuários";
					include path('admin/include/header.php');
					?>
					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						<h1 class="page-header"><?= $title ?></h1>
						<?php
						if ($users = DBRead('users'))
						{
							foreach ($users as $key => $value)
							{ ?>
								<div class="col-sm-6 col-md-3">
								    <div class="thumbnail">
								      <div class="caption">
								        <h3><?= $value['user'] ?></h3>
								        <p>
											<?php 
												if( !$value['actived'] )
													echo "<a href=\"" . url('admin/user/active/' . $value['id']) . "\" title=\"Ativar\" class=\"btn btn-default btn-sm\">Ativar</a>";
												else
													echo "<a href=\"" . url('admin/user/deactivate/' . $value['id']) . "\" title=\"Desativar\" class=\"btn btn-warning btn-sm\">Desativar</a>";
											?>
											<a href="<?= url('admin/user/edit/' . $value['id']) ?>" title="Editar" class="btn btn-primary btn-sm">Editar</a>
											<a onclick="del('<?= url('admin/user/delete/') ?>', <?= $value['id'] ?>)" class="btn btn-danger btn-sm">Deletar</a>
										</p>
								      </div>
								    </div>
								</div>
							<?php }	
						}else{
							echo "<h1>Nenhum usuário</h1>";
						}
						?>
					</div>
					<?php
					include path("admin/include/footer.php");
					break;
				
				default:
					# code...
					break;
			}
			break;

		case 'event':
			switch ($_GET['action'])
			{
				case 'add':
					if (isset($_POST['submit']))
					{
						$form['name'] = $_POST['name'];
						$form['date'] = $_POST['date'];
						$form['location'] = $_POST['location'];
						$form['message'] = $_POST['message'];
						$owners = $_POST['owners'];
						$form['actived'] = $_POST['actived'];

						if ($form['name'] || $form['date'] || $form['location'] || $form['message'] || $form['owners'] || $form['actived'])
						{

							$id_new = mysqli_fetch_array(DBExecute("show table status like 'events'"))['Auto_increment'];
							
							if (DBCreate("events",$form))
							{
								mkdir(path("assets/images/events/" . $id_new));
								foreach ($owners as $key => $value) {
									DBCreate("events_users",array("event_id" => $id_new, "user_id" => $value));
								}
								echo "<h3><span class=\"label label-danger\">Cadastrado com sucesso</span></h3>";
							}
							
						}
					}
					$title = "Incluir evento";
					include path('admin/include/header.php');
					?>
					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						<h1 class="page-header"><?= $title ?></h1>
						<form method="post">
							<?= (isset($text)) ? $text : null ?>
							<div class="form-group">
								<label for="name">Nome</label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="date">Data evento</label>
								<input type="date" id="date" name="date" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="location">Localização</label>
								<input type="text" id="location" name="location" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="message">Mensagem de Apresentação</label>
								<input type="text" id="message" name="message" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="owners">Proprietários</label>
								<select name="owners[]" id="owners" multiple class="form-control" required>
									<?php
									$users = DBRead("users");
									if ($users)
									{
										foreach ($users as $key => $value) {
											echo "<option value='".$value['id']."'>".$value['user']."</option>\n";
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="actived">Status</label>
								<select name="actived" id="actived" required class="form-control">
									<option value="1">Ativo</option>
									<option value="0">Desativo</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-block btn-danger">
							</div>
						</form>	
					</div>
					<?php
					include path("admin/include/footer.php");
					break;
				case 'all':
					$title = "Seus eventos";
					include path('admin/include/header.php');

					?>
					<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
						<h1 class="page-header"><?= $title ?></h1>
						<?php
							if ($_SESSION['su']) {
								$events = DBRead( 'events', 'order by date desc' );
							}else{
								$events = DBRead( 'events,events_users', "where events_users.event_id = events.id and events_users.user_id = '{$_SESSION['user']}' order by date desc" );
							}
							if( !$events ) { ?>
								<h2>Nenhum evento cadastrado</h2>
						<?php }
							else
								foreach ( $events as $value ):
								$path = path('assets/images/events/' . $value['id']);
					            $handle = opendir($path);
					            while (false !== ($file = readdir($handle))) {
					              if ($file != "." && $file != "..") {
					                  $files[] = $file;
					              }
					            }
					            $thumb = $files[rand(0,count($files)-1)];
						?>
						<div class="col-xs-6 col-sm-3 placeholder text-center" id="event-<?= $value['id'] ?>">
							<a href="<?= url('event/' . encode($value['name']) . '/' . encode($value['location']) . '/' . $value['id']) ?>" target="blank">
								<img src="<?= url('assets/images/events/' . $value['id'] . '/' . $thumb) ?>" class="img-responsive" alt="<?= $value['name'] ?>" style="height: 200px;">
							</a>
							<h4><?= $value['name'] ?></h4>
							<span class="text-muted"><?= $value['location'] ?></span>
							<ul class="list-group text-left">
								<li class="list-group-item">
									<span class="badge"><?= date_event($value['date'], "d/m/Y") ?></span>
									Data evento
								</li>
								<li class="list-group-item">
									<span class="badge"><?= date_event($value['date_created'], "d/m/Y") ?></span>
									Data criação
								</li>
								<li class="list-group-item">
									<span class="badge"><?= $value['location'] ?></span>
									Local
								</li>
								<li class="list-group-item">
									<span class="badge"><?= count($files) ?></span>
									Fotos
								</li>
							</ul>Proprietários
							<div class="well">
								<?php
								foreach (DBRead('events_users', "where event_id = '{$value['id']}'") as $prop)
								{
									foreach (DBRead('users', "where id = '{$prop['user_id']}'") as $users)
									{
										echo "<span class=\"label label-default\">".$users['user']."</span>";
									}
								}
								?>
							</div>
							<p>
								<?php 
									if( !$value['actived'] )
										echo "<a href=\"" . url('admin/event/active/' . $value['id']) . "\" title=\"Ativar\" class=\"btn btn-default btn-sm\">Ativar</a>";
									else
										echo "<a href=\"" . url('admin/event/deactivate/' . $value['id']) . "\" title=\"Desativar\" class=\"btn btn-warning btn-sm\">Desativar</a>";
								?>
								<a href="<?= url('admin/event/edit/' . $value['id']) ?>" title="Editar" class="btn btn-primary btn-sm">Editar</a>
								<a onclick="del('<?= url('admin/event/delete/') ?>', <?= $value['id'] ?>)" title="Deletar" class="btn btn-danger btn-sm">Deletar</a>
							</p>
						</div>
						<?php unset($files,$thumb); endforeach; ?>
					</div>
					<?php
					include path("admin/include/footer.php");
					break;
				
				default:
					# code...
					break;
			}
			break;
		
		default:
			# code...
			break;
	}

} ?>