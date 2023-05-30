<?php
class Connection
{
    // public function connectBank($banco = false, $host = "localhost", $username = "root", $password = "")
    public function connectBank($banco = false, $host = "localhost:3306", $username = "root", $password = "")
    {
        try {
            $dbname = (!$banco) ? "dbname=db_panda" : "dbname=$banco";
            $dsn = "mysql:host=$host;$dbname";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo '<script>console.log("connected to bank: ' . $banco . '")</script>';
            return $pdo;
        } catch (PDOException $e) {
            $msg = $e->getMessage(); //Error connectBank():try1
            // echo '<script>console.error("Error connectBank():try1: ' . $msg . '")</script>';

            if (!function_exists('str_contains')) {
                function str_contains(string $haystack, string $needle): bool
                {
                    return '' === $needle || false !== strpos($haystack, $needle);
                }
            }

            if (str_contains($e->getMessage(), "Unknown database")) {
                // echo "<script>console.log('Creating Database: $banco')</script>";
                try {
                    $dsn = "mysql:host=$host;";
                    $sql =  "CREATE DATABASE IF NOT EXISTS $banco;";
                    $pdo = new PDO($dsn, $username, $password);
                    $sql = $pdo->prepare($sql);
                    $sql->execute();
                    $this->createTableUser($pdo, $banco);
                    $this->createTableTurmas($pdo, $banco);
                    $this->createTableRecados($pdo, $banco);
                    $this->createTablePresenca($pdo, $banco);
                    $this->createTableAvaliacoes($pdo, $banco);
                    $this->createTableTurmaAlunos($pdo, $banco);
                } catch (PDOException $e) {
                    echo $e->getMessage(); //Error connectBank():try2
                }
                return $this->connectBank($banco);
            }
        }
    }

    //mudar para private
    public function createTableUser($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableUser')</script>";
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `$banco`.`user` ( `id_user` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `surname` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(32) NOT NULL , `birthday` TEXT NOT NULL , `gender` VARCHAR(1) NOT NULL COMMENT 'M (masculino)\r\nF (feminino)\r\nN (nao especificar)' , `phone` VARCHAR(11) NOT NULL , `nivel` INT(1) NOT NULL , `situation` INT(1) NOT NULL , PRIMARY KEY (`id_user`)) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableUser()
        }
    }

    //mudar para private
    public function createTableTurmas($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableTurmas')</script>";
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `$banco`.`turmas` ( `id_turma` INT NOT NULL AUTO_INCREMENT , `fk_id_professor` INT NOT NULL , `name_turma` TEXT NOT NULL , `imagem_turma` TEXT NULL DEFAULT NULL , `detalhe` TEXT NULL DEFAULT NULL , `situation` INT(1) NOT NULL DEFAULT '1' , PRIMARY KEY (`id_turma`)) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableTurmas()
        }
    }

    //mudar para private
    public function createTableRecados($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableRecados')</script>";
        try {
            $sql = "CREATE TABLE `$banco`.`recados` ( `id_recado` INT NOT NULL AUTO_INCREMENT , `fk_id_professor` INT NOT NULL , `name_recado` VARCHAR(50) NOT NULL , `mensagem` TEXT NOT NULL , `tipo` INT(1) NOT NULL , `situation` INT(1) NOT NULL , PRIMARY KEY (`id_recado`)) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableRecados()
        }
    }

    //mudar para private
    public function createTablePresenca($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableAvaliacoes')</script>";
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `$banco`.`presenca` ( `fk_id_user` INT NOT NULL , `fk_id_turma` INT NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `presenca` INT NOT NULL DEFAULT '1' ) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableAvaliacoes()
        }
    }

    //mudar para private
    public function createTableAvaliacoes($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableAvaliacoes')</script>";
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `$banco`. `avaliacoes` ( `id_avaliacao` INT NOT NULL AUTO_INCREMENT , `fk_id_professor` INT NOT NULL , `name_avaliacao` TEXT NOT NULL , `detalhe` TEXT NOT NULL , `tipo` INT NOT NULL , `situation` INT NOT NULL , PRIMARY KEY (`id_avaliacao`)) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableAvaliacoes()
        }
    }

    //mudar para private
    public function createTableTurmaAlunos($pdo, $banco)
    {
        // echo "<script>console.log('Creating TableAvaliacoes')</script>";
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `$banco`. `turma_alunos` ( `fk_id_user` INT NOT NULL , `fk_id_turma` INT NOT NULL ) ENGINE = InnoDB;";
            $sql = $pdo->prepare($sql);
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage(); //Error createTableAvaliacoes()
        }
    }

    public function dropBank($banco = false, $host = "localhost", $username = "root", $password = "")
    {
        if ($banco) {
            try {
                $dsn = "mysql:host=$host";
                $pdo = new PDO($dsn, $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "DROP DATABASE IF EXISTS `$banco`";
                $sql = $pdo->prepare($sql);
                $sql->execute();
                // echo '<script>console.log("dropped bank: ' . $banco . '")</script>';
            } catch (PDOException $e) {
                $msg = $e->getMessage(); //Error dropBank():try
                echo '<script>console.error("Error dropBank():try: ' . $msg . '")</script>';
            }
        }
    }
}

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

// $conn = new Connection();
// $conn->dropBank("db_panda_test");
// $conn->connectBank("db_panda_test");
