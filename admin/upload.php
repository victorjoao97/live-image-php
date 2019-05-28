<?php
require '../config/config.php';

if(!isset($_SESSION["auth"])){
	if($_SESSION["auth"] != true){
		header("Location: " . url('admin','logon'));
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Upload de fotos para a Feira Tecnológica</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= url("assets/css/bootstrap.min.css") ?>">
	<script type="text/javascript" src="<?= url("admin/assets/js/jquery.min.js") ?>"></script>
	<script type="text/javascript" src="<?= url("admin/assets/js/file_uploads.js") ?>"></script>
	<script type="text/javascript" src="<?= url("admin/assets/js/vpb_script.js") ?>"></script>

</head>
<body>
	<div class="">
		<div class="container">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div style="margin-top:30px;" class="well well-lg">
				<?php if($events = DBRead("events","where actived = true")): ?>
					<form id="vasPLUS_Programming_Blog_Form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="off">
						<legend><h1>Upload de fotos<a class="pull-right btn btn-danger" href="<?= url("admin/event/all") ?>">voltar</a></h1></legend>
						<div class="form-group">
							<label for="event">Evento</label>
							<select name="event" id="event" class="form-control">
								<?php foreach ($events as $key => $value) {
									foreach (DBRead('events,events_users', "where events.id = '{$value['id']}' and (events_users.event_id = '{$value['id']}' and events_users.user_id = '{$_SESSION['user']}') order by date desc limit 1","events.id, events.name, events.location") as $key => $event) {
										echo "<option value='" .$event['id']. "'>" . $event['name'] . " - " . $event['location'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<?php echo '<input accept="image/*" class="form-control" onchange="vpb_upload_and_watermark_file();" type="file" name="vasPhoto_uploads[]" id="vasPhoto_uploads" multiple/>'; ?>
						</div>
					</form>
					<div id="vasPhoto_uploads_Status"></div>
				<?php else: ?>
					<h1>Nenhum evento</h1>
					<a href="<?= url("admin/event/add") ?>" class="btn btn-primary">Adicione um evento</a>
				<?php endif; ?>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</body>
</html>