<?php
class Login_Regis extends Controller
{
     private $data;
     public function __construct()
     {
          $this->data = [];
     }
     function Login()
     {
         $_SESSION['login']['status'] = true;
         header('Location: /the-coffee/');
         exit();
     }

     function Register()
     {
          $this->view('/Client/pages/login-regis', $this->data);
     }
     function Logout(){
          unset($_SESSION['login']['status']);
          header('Location: /the-coffee/');
          exit();
     }
}
