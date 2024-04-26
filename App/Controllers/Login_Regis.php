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
          //Này xài ajax để lấy response 1 trong 3 trạng thái (-1,0,1) tương ứng với ([NotFound,WrongPwd],Banned,Success)
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
          //Này xài ajax để lấy response 1 trong 2 trạng thái (0,1) tương ứng với (Fail,Success)
          $id = $this->userModel->getMaxId();
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $status = 1;
          $role = 2;
          $data = [
               'id' => $id + 1,
               'name' => $name,
               'email' => $email,
               'password' => $password_hash,
               'status' => $status,
               'role_id' => $role
          ];

          //goi ham o usermodel
          $this->userModel->insertUser($data);

          // Add SweetAlert to show register success
          echo "<script>
               Swal.fire({
                    icon: 'success',
                    title: 'Đăng ký ',
                    text: 'Đăng ký thành công',
               });
          </script>";
          header('Location: /the-coffee');
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
          unset($_SESSION['login']['id']);
          header('Location: /the-coffee/');
          exit();
     }
}
