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

     function check()
     {
          if (isset($_POST['action']) && $_POST['action'] == 'register-btn') {
               $name = $_POST['name'];
               $email = $_POST['email'];
               $sdt = $_POST['sdt'];
               $password = $_POST['password'];
               $repassword = $_POST['repassword'];
               if ($name == "" || $email == "" || $sdt == "" || $password == "" || $repassword == "") {
                    echo 0;
               } else if ($password != $repassword) {
                    echo 0;
               } else {
                    //tra ve loi
                    return 0;
               }
          }
     }
}
