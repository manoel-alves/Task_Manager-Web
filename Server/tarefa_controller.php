<?php

require "../Server/tarefa.model.php";
require "../Server/tarefa.service.php";
require "../Server/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'create') {
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->create();

    header('Location: index.php?include=1');
} else if ($acao == 'read') {
    $tarefa = new Tarefa();
    $conexao =  new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->read();
} else if ($acao == 'readPendingTasks') {
    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);

    $conexao = new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->readPending_DoneTasks();
} else if ($acao == 'readDoneTasks') {
    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 2);

    $conexao = new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->readPending_DoneTasks();
} else if ($acao == 'update') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao =  new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    if ($tarefaService->update()) {
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }
    }
} else if ($acao == 'remove') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao =  new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefaService->delete();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php?delete=success');
    } else if (isset($_GET['pag']) && $_GET['pag'] == 'tarefas_realizadas') {
        header('location: tarefas_realizadas.php?delete=success');
    } else {
        header('location: todas_tarefas.php?delete=success');
    }
} else if ($acao == 'checkTask') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);

    $conexao =  new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefaService->checkTask();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php');
    } else {
        header('location: todas_tarefas.php');
    }
} else if ($acao == 'uncheckTask') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 1);

    $conexao =  new Conexao();

    $tarefaService =  new TarefaService($conexao, $tarefa);
    $tarefaService->uncheckTask();

    if ($_GET['pag'] && $_GET['pag'] == 'tarefas_realizadas') {
        header('location: tarefas_realizadas.php');
    } else {
        header('location: todas_tarefas.php');
    }
}
