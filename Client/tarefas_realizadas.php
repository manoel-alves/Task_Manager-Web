<?php
	$acao = 'readDoneTasks';
	require 'tarefa_controller.php';
	include("functions.php")
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lista de Tarefas</title>

		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function remove(id) {
				location.href = "tarefas_realizadas.php?pag=tarefas_realizadas&acao=remove&id="+id;
			}

			function uncheckTask(id) {
				location.href = "todas_tarefas.php?acao=uncheckTask&id="+id;
			}

			function typed() {
				if(document.getElementById("inputNewTask").value.length > 0) {
					document.getElementById("button").disabled = false;
				}
				else {
					document.getElementById("button").disabled = true;
				}
			}
		</script>
	</head>

	<?php template_header(); ?>
		<div class="row">
			<div class="col-xl-2 col-md-3 col-sm-5">
				<nav class="navbar navbar-light bg-light nav-left p-0">
					<ul class="navbar-nav">
						<li class="nav-item px-md-5 py-2"><a class="nav-link" href="index.php">Tarefas pendentes</a></li>
						<li class="nav-item active px-md-5 py-2"><a class="nav-link" href="#">Tarefas Realizadas</a></li>
						<li class="nav-item px-md-5 py-2"><a class="nav-link" href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-xl-10 col-md-9 col-sm-7">
				<div class="scroll">
					<?php if(empty($tarefas)) { ?>
						<div class="text-center mt-5">
							<img src="img/noTasks.png" alt="Sem tarefas" width="300" >
							<h5 class="text-center my-4">Você não possui tarefas realizadas.</h5>
						</div>
					<?php } else { ?>
						<?php foreach($tarefas as $i => $tarefa) { ?>
							<div class="row px-4 py-3 mx-4 my-3 d-flex align-items-center taskBox">
								<input class="col-sm-1 form-check-input" type="checkbox" onclick="uncheckTask(<?= $tarefa->id ?>)" checked='true'>
								<div class="col-sm-8" id="tarefa_<?= $tarefa->id ?>"> 
									<span><?= $tarefa->tarefa ?></span>
								</div>
								<div class="col-sm-3 mt-2 d-flex justify-content-around options">
									<a class="mx-5 text-danger" href="#" onclick="remove(<?= $tarefa->id ?>)">Excluir</a>
								</div>
							</div>
						<?php } // foreach ?>
					<?php } //if else?>			
<?php template_footer(); ?>