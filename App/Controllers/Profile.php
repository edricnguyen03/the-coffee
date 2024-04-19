<?php
class Profile extends Controller
{
    public $data;
    private $profile;
    public $userModel;
    public function __construct()
    {
        $this->data = [];
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }
        $userid = $_SESSION['login']['id'];
        $user = $this->userModel->getUserById($userid);

        $this->data['user'] = $user[0];
        $this->view('/Client/Profile', $this->data);
    }

    public function editName()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }
        if (!isset($_POST["userId"]) || !isset($_POST["userName"])) {
            echo "fail";
            return;
        }
        $userId = $_POST["userId"];
        $name = $_POST["userName"];

        echo $this->userModel->editName($userId, $name);
    }

    public function changePassword()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }
        if (!isset($_POST["userId"]) || !isset($_POST["currentPassword"]) || !isset($_POST["newPassword"])) {
            echo "fail";
            return;
        }
        $userId = $_POST["userId"];
        $currentPassword = $_POST["currentPassword"];
        $newPassword = $_POST["newPassword"];

        echo $this->userModel->changePassword($userId, $currentPassword, $newPassword);
    }
}
