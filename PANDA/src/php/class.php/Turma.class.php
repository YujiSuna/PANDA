<?php
require_once '/xampp/htdocs/PANDA/src/php/database/connection.php';

class Turma
{
    public function insertTurma($name_turma, $id_professor, $detalhe)
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            if (empty($detalhe)) {
                $detalhe = 'sem detalhe';
            }
            $sql = "INSERT INTO turmas (fk_id_professor, name_turma, detalhe) VALUES ('$id_professor', '$name_turma', '$detalhe')";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllTurma($condition = 'where situation = 1', $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT " . $item . " FROM turmas $condition";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        // echo '<strong>getAllTurma()</strong>: </br>';
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTurmaBy($value, $search = 'id_turma', $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM turmas WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTurma($value, $search = 'id_turma', $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();


        $sql = "SELECT $item FROM turmas WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $count = $sql->rowCount();
        if ($count > 0) {
            if ($count == 1) {
                $return = $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                $return = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            $return = false;
        }
        return $return;
    }

    public function updateSituation($id_turma, $newSituation)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE turmas SET situation = $newSituation WHERE id_turma = $id_turma;";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOEXCEPTION $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllTurmasAlunos($item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();


        $sql = "SELECT " . $item . " FROM turma_alunos;";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTurmaAlunos($value, $search = "fk_id_turma", $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM turma_alunos WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        // echo '<strong>getAllTurmaAlunos()</strong>: </br>';
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTurmaAlunoNumBy($value, $search = "fk_id_turma")
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT id_aluno_t FROM turma_alunos WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->rowCount();
    }

    public function insertTurmaAlunos($id_turma, $id_aluno)
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $sql = "SELECT * FROM `turma_alunos` WHERE `fk_id_user` = $id_aluno && `fk_id_turma` = $id_turma";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            $condition = $sql->rowCount() == 0;

            if ($condition) {
                $sql = "INSERT INTO `turma_alunos` (`id_aluno_t`, `fk_id_user`, `fk_id_turma`) VALUES (NULL, '$id_aluno', '$id_turma')";
                $sql = $pdo->prepare($sql);
                $sql->execute();
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
