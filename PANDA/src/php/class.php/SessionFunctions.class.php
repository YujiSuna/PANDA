<?php

class SessionFunctions
{
    public function verifyUser()
    {
        session_write_close();
        session_start();
        if (isset($_SESSION["idUser"])) {
            return $_SESSION["idUser"];
        }else{
            $this->destroySession();
            return false;
        }
    }

    public function destroySession()
    {
        session_write_close();
        session_start();
        header('Location: http://localhost/PANDA/');
        session_destroy();
    }

    public function getSessionData($key)
    {
        session_write_close();
        session_start();
        if (isset($_SESSION[$key])) {
            $data = $_SESSION[$key];
            session_write_close();
            return $data;
        }else {
            session_write_close();
            return false;
        }
    }

    public function setSessionData($data, $key)
    {
        session_write_close();
        session_start();
        $_SESSION[$key] = $data;
        $return =  isset($_SESSION[$key]) && !empty($_SESSION[$key]);
        session_write_close();
        return $return;
    }
}
