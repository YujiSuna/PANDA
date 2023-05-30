<?php
require_once '/xampp/htdocs/PANDA/src/php/database/connection.php';
class Painel{
    public function listaTurma()
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT * FROM turmas WHERE situation = 1";
        $sql = $pdo -> prepare($sql);
        $sql -> execute();
        $retorno = [];
        
        if ($sql -> rowCount() > 0) {
            $dados = $sql -> fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $dado) {
                if ($dado['situation'] != 0) {
                    array_push($retorno, $dado);
                }
            }
            return $retorno;
        }
    }

    public function listaAvaliacao()
    {
        $connection = new Connection();
        $pdo = $connection -> connectBank();

        $sql = "SELECT * FROM avaliacoes WHERE situation = 1 ORDER BY name_avaliacao ASC";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $retorno = [];
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $dado) {
                if ($dado['situation'] != 0) {
                    array_push($retorno, $dado);
                }
            }
            return $retorno;
        }
    }

    public function listaRecado()
    {
        $connection = new Connection();
        $pdo = $connection -> connectBank();

        $sql = "SELECT * FROM recados WHERE situation = 1";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $retorno = [];
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $dado) {
                if ($dado['situation'] != 0) {
                    array_push($retorno, $dado);
                }
            }
            return $retorno;
        }
    }
}
