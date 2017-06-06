<?php

class LoginM extends Model
{

    public function checkLogin($email, $password)
    {
        $sth = $this->db->prepare("SELECT * FROM user WHERE email = '$email' LIMIT 1");
        $sth->execute();
        $user = $sth->fetch();
        if ( hash_equals($user['password'], crypt($password, $user['password'])) ) {
            session_start(); // Starting Session
            $_SESSION['email'] = $user['email'];
            var_dump($_SESSION);
            return true;
        }
        return false;
    }
}