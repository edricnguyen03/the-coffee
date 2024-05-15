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
                            $_SESSION['login']['role'] = $this->userModel->getRole($user);
                            $_SESSION['login']['username'] = $this->userModel->getUserByEmail($email)[0]['name'];
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
        //Nếu muốn thêm trạng thái khác thì thêm case vào switch

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $repassword = $_POST['repassword'];
                $status = 1;
                $role = 2;

                //kiem tra co trung khop mat khau khong
                if ($password != $repassword) {
                    echo "notmatch";
                    return;
                } else {
                    $data = [
                        'id' => $this->userModel->getMaxId() + 1,
                        'name' => $name,
                        'email' => $email,
                        'password' => $password_hash,
                        'status' => $status,
                        'role_id' => $role
                    ];
                    $this->userModel->insertUser($data);
                    echo "success";
                }
            } else {
                echo "fail";
            }
        }
    }

    function Logout()
    {
        unset($_SESSION['login']['status']);
        unset($_SESSION['login']['id']);
        header('Location: /the-coffee/');
        exit();
    }
}
