<?php
require_once '/xampp/htdocs/PANDA/src/php/database/connection.php';

class Presenca
{
    public function insertPresenca($id_user, $id_turma  = null, $date  = null, $presenca = null)
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $sql = "INSERT INTO `presenca` (`fk_id_user`, `fk_id_turma`, `date`, `presenca`) VALUES ('$id_user', '$id_turma', '$date', '$presenca')";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPresencaBy($value, $search = 'fk_id_turma', $multiple = true, $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT " . $item . " FROM Presenca WHERE " . $search . " = :value";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":value", $value);
        $sql->execute();

        $condition = $multiple ?
            $sql->rowCount() > 0 :
            $sql->rowCount() == 1;

        if ($condition) {
            $return = $multiple ?
                $sql->fetchAll(PDO::FETCH_ASSOC) :
                $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $return = false;
        }
        return $return;
    }

    public function updatePresencaById($id_presenca, $newPresenca)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE presenca SET presenca = :nP WHERE id_presenca = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":nP", $newPresenca);
            $sql->bindValue(":id", $id_presenca);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}