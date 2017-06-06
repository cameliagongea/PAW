<?php

class Login extends Controller
{
    public $login;
    public function __construct()
    {
        $this->login = $this->model('LoginM');
    }

    public function index()
    {
        $this->login();
        $this->view('login/index');
    }

    public function login()
    {
        var_dump($_POST);
        $login =  $this->model('LoginM');
        if(isset($_POST['loginEmail']) && isset($_POST['loginPassword']))
        {
            if($login->checkLogin($_POST['loginEmail'], $_POST['loginPassword']))
                return true;
                // $this->home->checkLogin($_POST['username']);
        }
         return false;
    }

    public function logout()
    {
    session_start();
    session_unset();
    unset($_SESSION);
    session_destroy();
//        var_dump($_SESSION);
    header("Location: http://127.0.0.1:122/IWasThere/public/home/index/");
    $this->view('home/index');

}

}