<?php

require_once '/xampp/htdocs/PANDA/src/php/database/connection.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';

class Usuario
{
    public function login($email, $password)
    {
        $cSF = new SessionFunctions();
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->bindValue("password", md5($password));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch(PDO::FETCH_ASSOC);

            //situation = 0 (usuario inativado)
            //situation = 1 (usuario ativado)
            if ($dado['situation'] != 0) {
                $bool = $cSF->setSessionData($dado['id_user'], "idUser");
                $bool = $bool && $cSF->setSessionData($dado, "dados_user");
                $bool = $bool && $cSF->setSessionData($dado['nivel'], "nivel_user");
                return $bool;
            }
        }

        return false;
    }

    public function signin($name, $surname, $email, $password, $birthday, $gender, $phone)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT id_user FROM user WHERE email = :e";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            //predefinir como situation como 0 caso for usar validacao do email
            $sql = "INSERT INTO `user` 
                (`id_user`, `name`, `surname`, `email`, `password`, `birthday`, `gender`, `situation`, `phone`) 
                VALUES (NULL, :n, :sn, :e, :p, :b, :g, '1', :pn)";
            // VALUES (NULL, :n, :sn, :e, :p, :b, :g, '0', :pn)"; 
            $sql = $pdo->prepare($sql);
            $sql->bindValue("n", $name);
            $sql->bindValue("sn", $surname);
            $sql->bindValue("e", $email);
            $sql->bindValue("p", md5($password));
            $sql->bindValue("b", $birthday);
            $sql->bindValue("g", $gender);
            $sql->bindValue("pn", $phone);
            $sql->execute();
            return true;
        }
    }

    // public function confereSituationUser($id_user)
    // {
    //     $connection = new Connection();
    //     $pdo = $connection->connectBank();

    //     $sql = "SELECT * FROM user WHERE id_user = :id";
    //     $sql = $pdo->prepare($sql);
    //     $sql->bindValue(":id", $id_user);
    //     $sql->execute();
    //     $dado = $sql->fetch(PDO::FETCH_ASSOC);
    //     return $dado['situation'] == 0;
    // }

    public function getAllUser($categorized = true, $category = "all", $item = '*', $orderBy = 'ORDER BY name ASC')
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $item, nivel FROM user $orderBy";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $allUser = $sql->fetchAll(PDO::FETCH_ASSOC);

        //0-admin 1-professor 2-aluno
        if ($categorized) {
            $admin = array();
            $professor = array();
            $aluno = array();
            $estranho = array();

            foreach ($allUser as $user) {
                switch ($user["nivel"]) {
                    case '0':
                        array_push($admin, $user);
                        break;
                    case '1':
                        array_push($professor, $user);
                        break;
                    case '2':
                        array_push($aluno, $user);
                        break;

                    default:
                        array_push($estranho, $user);
                        break;
                }
            }

            $allUser = array(
                "admin" => $admin,
                "professor" => $professor,
                "aluno" => $aluno,
                "estranho" => $estranho
            );
        }

        if ($category != "all") {
            return $allUser[$category];
        }
        return $allUser;
    }

    public function getUser($value, $search = 'id_user', $return = "*")
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT $return FROM user WHERE $search = '$value'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function verifyUser($id)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        $sql = "SELECT situation FROM user WHERE id_user = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $situation = $sql->fetchAll(PDO::FETCH_ASSOC)[0]["situation"];

        // echo '$situation: ';
        var_dump($situation == 1);

        // echo '</br>';
        return $situation == 1;
    }

    public function updateSituation($id_user, $newSituation)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE user SET situation = $newSituation WHERE id_user = $id_user;";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            return true;
        } catch (PDOEXCEPTION $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function resetPassword($id_user, $newPassword)
    {
        $connection = new Connection();
        $pdo = $connection->connectBank();

        try {
            $sql = "UPDATE user SET password = :pass, situation = 1 WHERE id_user = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":pass", md5($newPassword));
            $sql->bindValue(":id", $id_user);
            $sql->execute();

            return true;
        } catch (Exception $e) {
            echo 'Erro ao renovar senha: ' . $e->getMessage();
            return false;
        }
    }
}




/* *** TESTS *** */
// $hd = new HandleData();

// echo '<pre>';
// $pu = new Usuario();

// $dados = $pu->getAllUser();
// $hd->printDadosKeys($dados, ['id_user', 'name']);

// $user = $pu->getUser('erick.kavano015@gmail.com', 'email');
// $hd ->printDadosKeys($user, ['id_user', 'situation']);

// $pu->verifyUser($user[0]['id_user']);
