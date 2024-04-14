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
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $email = $_POST['username'];
                    $password = $_POST['password'];
                    $user = $this->userModel->login($email, $password);
                    switch ($user) {

                         case "notFound": {
                                   $_SESSION['login']['status'] = -1;
                                   echo "notFound";
                                   break;
                              }
                         case "banned": {
                                   $_SESSION['login']['status'] = 0;
                                   echo "banned";
                                   break;
                              }
                         case "wrongPassword": {
                                   $_SESSION['login']['status'] = -1;
                                   echo "wrongPassword";
                                   break;
                              }
                         default: {
                                   $_SESSION['login']['id'] = $user;
                                   $_SESSION['login']['status'] = 1;
                                   echo "success";
                                   break;
                              }
                    }
               }
          }
     }

     function Register()
     {
          //goi ham o usermodel
          echo "<script>alert('Đăng ký thành công');</script>";
          // $this->userModel->createUser();
          header('Location: /index.php');
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
