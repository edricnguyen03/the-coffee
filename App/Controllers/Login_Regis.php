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
          $this->data['type'] = 'login';
          $this->view('/Client/pages/login-regis', $this->data);
     }

     function Register()
     {
          $this->data['type'] = 'register';
          $this->view('/Client/pages/login-regis', $this->data);
     }
}
