<?php

class TarefaService {

    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa) {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function create() {
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function read() {
        $query = '
            select
                t.id, s.status, t.tarefa 
            from 
                tb_tarefas as t
                left join tb_status as s on (t.id_status = s.id)
                ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function readPending_DoneTasks() {
        $query = '
            select
                t.id, s.status, t.tarefa
            from 
                tb_tarefas  as t
                left join tb_status as s on (t.id_status = s.id)
            where
                t.id_status = :id_status
                ';
        $stmt = $this->conexao->prepare($query);
        $stmt->BindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(){

        $query = 'update tb_tarefas set tarefa = :tarefa where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->BindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->BindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();

    }

    public function delete() {
        $query = 'delete from tb_tarefas where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->BindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();
    }

    public function checkTask() {
        $query = 'update tb_tarefas set id_status = :status where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->BindValue(':status', $this->tarefa->__get('id_status'));
        $stmt->BindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function uncheckTask() {
        $query = 'update tb_tarefas set id_status = :status where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->BindValue(':status', $this->tarefa->__get('id_status'));
        $stmt->BindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }
}
