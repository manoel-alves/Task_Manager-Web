<?php
class Conexao
{
    private $DB_HOST = 'localhost';
    private $DB_USER = 'root';
    private $DB_PASS = '';
    private $DB_NAME = 'Task_Manager_db';

    public function conectar()
    {
        try {
            $conexao = new PDO(
                "mysql:host=$this->DB_HOST;dbname=$this->DB_NAME",
                "$this->DB_USER",
                "$this->DB_PASS"
            );

            return $conexao;
        } catch (PDOException $exception) {
            exit('Falha ao conectar ao banco!');
        }
    }
}
