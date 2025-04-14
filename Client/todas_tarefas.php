<?php
	$acao = 'read';
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
			function edit(id, txt_tarefa) {
				// form de edicao
				let form = document.createElement('form')
				form.action = 'todas_tarefas.php?pag=todas_tarefas&acao=update'
				form.method = 'post'
				form.className = 'row text-center'
				// input 
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col form-control'
				inputTarefa.value = txt_tarefa
				// input hidden
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id
				// send button
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'
				
				// incluir input, input hidden e button no form
				form.appendChild(inputTarefa)
				form.appendChild(inputId)
				form.appendChild(button)

				// selecionar div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				// limpar texto de tarefa
				tarefa.innerHTML = ''
				// incluir form
				tarefa.insertBefore(form, tarefa[0])

			}

			function remove(id) {
				location.href = "todas_tarefas.php?pag=todas_tarefas&acao=remove&id="+id;
			}

			function checkTask(id) {
				location.href = "todas_tarefas.php?pag=todas_tarefas&acao=checkTask&id="+id;
			}

			function uncheckTask(id) {
				location.href = "todas_tarefas.php?pag=todas_tarefas&acao=uncheckTask&id="+id;
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
						<li class="nav-item px-md-5 py-2"><a class="nav-link" href="tarefas_realizadas.php">Tarefas Realizadas</a></li>
						<li class="nav-item active px-md-5 py-2"><a class="nav-link" href="#">Todas tarefas</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-xl-10 col-md-9 col-sm-7">
				<div class="scroll">
					<?php if(empty($tarefas)) { ?>
						<div class="text-center mt-5">
							<img src="img/notAdded.png" alt="Sem tarefas" width="300" >
							<h5 class="text-center my-4">Você não possui tarefas ainda.</h5>
						</div>
					<?php } else { ?>
						<?php foreach($tarefas as $i => $tarefa) { ?>
							<div class="row px-4 py-3 mx-4 my-3 d-flex align-items-center taskBox">
								<?php if($tarefa->status == 'realizada') { ?>
									<input class="col-sm-1 form-check-input" type="checkbox" onclick="uncheckTask(<?= $tarefa->id ?>)" checked='true'>
									<div class="col-sm-8" id="tarefa_<?= $tarefa->id ?>"> 
										<span><s><?= $tarefa->tarefa ?></s> (<?= $tarefa->status ?>)</span>
									</div>
								<?php } else { ?>
									<input class="col-sm-1 form-check-input" type="checkbox" onclick="checkTask(<?= $tarefa->id ?>)">
									<div class="col-sm-8" id="tarefa_<?= $tarefa->id ?>"> 
										<span><?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)</span>
									</div>
								<?php } ?>
								<div class="col-sm-3 mt-2 d-flex justify-content-around options">
									<?php if($tarefa->status == 'pendente') { ?>
										<a class="mx-5 text-info" href="#" onclick="edit(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')">Editar</a>
										<div class="line"></div>
									<?php } ?>
									<a class="mx-5 text-danger" href="#" onclick="remove(<?= $tarefa->id ?>)">Excluir</a>
								</div>
							</div>
						<?php } // foreach ?>
					<?php } //if else?>
<?php template_footer(); ?>