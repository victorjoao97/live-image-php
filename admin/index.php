<?php 
require_once "../config/config.php";

if(!isset($_SESSION["auth"])){
	if($_SESSION["auth"] != true){
		header("Location: " . url('admin/logon'));
	}
}

$title = "Home";
include path('admin/include/header.php');

?>
<script type="text/javascript">
	function del(url, id){
		if (confirm("Excluir????") === true) {
			alert("Evento apagado");
			$("#event-" + id).remove();
		}
	}
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header"><?= $title ?></h1>
</div>
<?php include path('admin/include/footer.php'); ?>