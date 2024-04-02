<?php
class Login_Regis extends Controller
{
     private $userModel;
     private $data;
     public function __construct()
     {
          $this->data = [];
          $this->userModel = $this->model('UserModel');
     }
     function Login()
     {
          $_SESSION['login']['status'] = true;
          header('Location: /the-coffee/');
          exit();
     }

     function Register()
     {
          //goi ham o usermodel
          echo "<script>alert('Dang ky thanh cong');</script>";
     }
     //add a validation function here
     //goi ham user-model.php tren day, echo ra gia tri tra ve
     function validation()
     {
          $val = $_POST['value'];
          $field = $_POST['field'];
          $result = $this->userModel->validation($field, $val);
          echo $result;
     }


     function Logout()
     {
          unset($_SESSION['login']['status']);
          header('Location: /the-coffee/');
          exit();
     }
}
