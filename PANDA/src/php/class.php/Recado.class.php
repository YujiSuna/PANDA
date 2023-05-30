<?php

require_once '/xampp/htdocs/PANDA/src/php/database/connection.php';

class Recado
{
    public function getAllRecados($item = '*', $orderBy = 'ORDER BY situation DESC, data_marcada DESC', $tipo=null)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        if($tipo==null){
            $tipo="";
        }else{
            $tipo = "&& tipo= $tipo";
        }

        $sql = "SELECT " . $item . " FROM recados WHERE situation = 1 $tipo $orderBy";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecado($id_recado, $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT " . $item . " FROM recados WHERE id_recado = $id_recado && situation = 1";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getAllRecadoBy($value, $search = 'fk_id_professor', $tipo = null, $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $tipo = ($tipo != null) ? "AND tipo = $tipo" : "";
        $sql = "SELECT $item FROM recados WHERE $search = $value $tipo && situation = 1";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getAllRecadoDestinosBy($value, $search = 'fk_id_destino', $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM recado_destinos WHERE $search = $value && situation = 1";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getRecadoDestinoBy($value, $search = 'fk_id_recado', $item = 'fk_id_destino')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM recado_destinos WHERE $search = $value && situation = 1";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function insertRecado($id_professor, $titulo, $mensagem, $dateMarcado, $tipo)
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $sql = "INSERT INTO recados (id_recado, fk_id_professor, name_recado, mensagem, tipo, data_marcada, situation) VALUES (NULL, '$id_professor', '$titulo', '$mensagem', '$tipo', '$dateMarcado' , '1')";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            $insertedID = $pdo->lastInsertId();
            return intval($insertedID);
        } catch (PDOException $e) {
            return "Erro ao inserir recado: " . $e->getMessage();
        }
    }

    public function insertRecadoDestino($id_recado, $id_destino)//criar insert recado turma log
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $id_recado = intval($id_recado);
            $id_destino = intval($id_destino);

            $sql = "INSERT INTO recado_destinos (id_recado_d, fk_id_recado, fk_id_destino, situation) VALUES (NULL, '$id_recado', '$id_destino', 1)";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function updateSituation($id_recado, $newSituation)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE recados SET situation = $newSituation WHERE id_recado = $id_recado;";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOEXCEPTION $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}


// $r = new Recado();
// echo '<pre>';
// $insertedRecado = $r->insertRecado(1, 'teste', 'testando', 0);
// var_dump($insertedRecado);
