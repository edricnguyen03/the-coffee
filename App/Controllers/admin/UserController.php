<?php
include_once './App/Models/Auth.php';
class UserController extends Controller
{
    public $data;
    public $userModel;
    public $orderModel;
    public $roleModel;

    public function __construct()
    {
        $this->data = [];
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrdersModel');
        $this->roleModel = $this->model('RoleModel');
    }

    // Function to show user data from the database
    public function index()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 1) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['users'] = $this->userModel->getAllUsers();
        $this->view('/Admin/pages/users/index', $this->data);
    }

    // Function to create a new user in the database
    public function create()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 1) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['roles'] = $this->roleModel->getAllRoles();
        $this->view('/Admin/pages/users/create', $this->data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $status = $_POST['status'];
            $role = $_POST['role_id'];


            // Get the current max id
            $maxId = $this->userModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'email' => $email,
                'password' => $password_hash,
                'status' => $status, // '1' or '0
                'role_id' => $role
            ];
            // echo '<pre>';
            // print_r($data);
            // echo '<pre>';
            $this->userModel->insertUser($data);
        }
    }


    // Function to edit an existing user in the database
    public function edit($userId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 1) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $user = $this->userModel->getUserById($userId);
        $this->data['user'] = $user[0];
        $this->data['roles'] = $this->roleModel->getAllRoles();
        $this->view('/Admin/pages/users/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $status = $_POST['status'];
            $role = $_POST['role_id'];

            $updateData = [
                'name' => $name,
                'email' => $email,
                'status' => $status, // '1' or '0
                'role_id' => $role
            ];
            if ($this->userModel->updateUser($userId, $updateData)) {
                $user = $this->userModel->getUserById($userId);
                $this->data['user'] = $user[0];
                echo json_encode(['success' => true, 'user' => $this->data['user']]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Không được để trống dữ liệu']);
        }
    }

    // Function to delete a user from the database
    // public function delete($userId)
    // {
    //     if ($this->userModel->deleteUser($userId)) {
    //         // If the deletion was successful, save success message to session
    //         $_SESSION['success'] = 'Xóa người dùng thành công';
    //         // Then redirect to the index page
    //         header('Location: /the-coffee/admin/user/');
    //         exit();
    //     } else {
    //         // If the deletion failed, show an error message and stay on the current page
    //         // You can also save the error message to session and display it on the current page
    //         $_SESSION['error'] = 'Xóa người dùng thất bại';
    //     }
    // }
    public function delete($userId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 1) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // Check if user is in order table
        $isInOrder = $this->orderModel->checkUserInOrder($userId);
        if (!$isInOrder) {
            // If user is not in order table, delete it
            if ($this->userModel->deleteUser($userId)) {
                $_SESSION['success'] = 'Xóa người dùng thành công';
                header('Location: /the-coffee/admin/user/');
                exit();
            } else {
                $_SESSION['error'] = 'Xóa người dùng thất bại';
            }
        } else {
            // If user is in order table, set its status to 'Inactive'
            if ($this->userModel->setUserStatus($userId, 'Inactive')) {
                $_SESSION['success'] = 'Người dùng đã được chuyển thành trạng thái Inactive vì có trong đơn hàng';
                header('Location: /the-coffee/admin/user/');
                exit();
            } else {
                $_SESSION['error'] = 'Không thể chuyển người dùng thành trạng thái Inactive';
            }
        }
    }

    public function check_email()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $currentUserId = isset($_POST['id']) ? $_POST['id'] : null;
            $user = $this->userModel->getUserByEmail($email);
            if (isset($user[0]) && isset($user[0]['id']) && $user[0]['id'] != $currentUserId) {
                echo json_encode(array('email_exists' => true));
            } else {
                echo json_encode(array('email_exists' => false));
            }
        }
    }
}
