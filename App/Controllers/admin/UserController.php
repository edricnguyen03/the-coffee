<?php

class UserController extends Controller
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
        $this->data['users'] = $this->userModel->getAllUsers();
        $this->view('/Admin/pages/users/index', $this->data);
    }
    // Function to show user data from the database
    // Function to show user details

    // Function to create a new user in the database
    public function create()
    {
        // $this->userModel->createUser($userData);
        $this->view('/Admin/pages/users/create',);

        // Redirect to the index page or show a success message
    }
    public function store()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role_id'];

            $data = [
                'id' => null,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role_id' => $role
            ];
            if ($this->userModel->insertUser($data)) {
                $this->view('/Admin/pages/users/create', ['success' => 'Thêm mới thành công']);
            }
        } else {
            $this->view('/Admin/pages/users/create', ['error' => 'Thêm mới thất bại']);
        }
    }

    // Function to edit an existing user in the database
    public function edit($userId, $newUserData)
    {
        $this->userModel->updateUser($userId, $newUserData);
        // Redirect to the index page or show a success message
    }

    // Function to delete a user from the database
    public function delete($userId)
    {
        $this->userModel->deleteUser($userId);
        // Redirect to the index page or show a success message
    }
}
