<?php


class LoginController extends Controller
{
    public function index(){
        if(empty($_POST)){
            $this->render('login-form');
        }else{
            $login = Application::xssSecure($_POST['login']);
            $password = Application::xssSecure($_POST['password']);

            $users = Application::$config['users'];
            $logged = false;
            foreach ($users as $user){
                if($user['login']==$login && $user['password']==$password){
                    $logged=true;
                    setcookie('logged',1,0,'/');
                    header('Location: '.Application::$config['webroot']);
                }
            }

            if(!$logged){
                $error = "Не верные логин или пароль!";
                $this->render('login-form', ['error' => $error]);
            }
        }
    }

    public function logout(){
        if(isset($_COOKIE['logged']) && $_COOKIE['logged']==1){
            setcookie('logged',0,0,'/');
        }
        header('Location: '.Application::$config['webroot']);
    }
}