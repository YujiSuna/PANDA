<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Painel.class.php';
// require_once '/xampp/htdocs/PANDA/src/php/class.php/class.handleData.php';

class Avaliacao
{
    public function getAllAvaliacoes($item = '*', $orderBy = 'ORDER BY situation DESC, name_avaliacao ASC')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM avaliacoes $orderBy";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAvaliacoesBy($value, $search, $tipo, $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM avaliacoes WHERE $search = $value AND tipo = $tipo";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvaliacao($value, $search = "id_avaliacao", $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM avaliacoes WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function insertAvaliacao($id_professor, $name_avaliacao, $data, $detalhe, $tipo)
    {
        $array = [$id_professor, $name_avaliacao, $data, $detalhe, $tipo];
        foreach ($array as $element) {
            if ($element == '' || $element == null) {
                return false;
            }
        }
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $sql = "INSERT INTO avaliacoes (id_avaliacao, fk_id_professor, name_avaliacao, data_marcada, detalhe, tipo, situation) VALUES (NULL, '" . $id_professor . "', '" . $name_avaliacao . "', '" . $data . "', '" . $detalhe . "', '" . $tipo . "', '1')";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateSituation($id_avaliacao, $newSituation)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE avaliacoes SET situation = $newSituation WHERE id_avaliacao = $id_avaliacao;";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOEXCEPTION $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllAvaliacoesLogsBy($value, $search = "fk_id_avaliacao", $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item FROM avaliacoes_logs WHERE $search = $value";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvaliacoesLogBy($search, $item = '*')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "SELECT $item FROM avaliacoes_logs WHERE $search";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOEXCEPTION $e) {
            // echo $e->getMessage();
            return false;
        }
    }

    public function updateAvaliacaoLogBy($id_avaliacao_log, $newValue1, $newValue2)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE avaliacoes_logs SET aprovado = $newValue1, falta = $newValue2 WHERE avaliacoes_logs.id_avaliacao_log = $id_avaliacao_log";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }

    public function insertAvaliacaoLog($fk_id_avaliacao, $fk_id_user, $aprovado, $falta)
    {
        try {
            $connection = new Connection();
            $pdo = $connection->connectBank();

            $sql = "INSERT INTO avaliacoes_logs (fk_id_avaliacao, fk_id_user, aprovado, falta, data_modificada) VALUES ($fk_id_avaliacao, $fk_id_user, $aprovado, $falta, CURRENT_DATE());";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

// $cAvaliacao = new Avaliacao();
// $resultado = $cAvaliacao->insertAvaliacaoLog(1, 1, 1, 0);

// var_dump($resultado);
