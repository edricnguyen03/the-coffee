<?php

class RoleController extends Controller
{
    public $data;
    public $roleModel;

    public function __construct()
    {
        $this->data = [];
        $this->roleModel = $this->model('RoleModel');
    }

    // Function to show role data from the database
    public function index()
    {
        $this->data['roles'] = $this->roleModel->getAllRoles();
        $this->view('/Admin/pages/roles/index', $this->data);
    }

    // Function to create a new role in the database
    public function create()
    {
        $this->view('/Admin/pages/roles/create',);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            // Get the current max id
            $maxId = $this->roleModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'description' => $description,
            ];
            if ($this->roleModel->insertRole($data)) {
                $this->view('/Admin/pages/roles/create', ['success' => 'Thêm vai trò mới thành công']);
            } else {
                $this->view('/Admin/pages/roles/create', ['error' => 'Thêm vài trò mới thất bại']);
            };
        }
    }


    // Function to edit an existing role in the database
    public function edit($roleId)
    {
        $role = $this->roleModel->getRoleById($roleId);

        $this->data['role'] = $role[0];
        $this->view('/Admin/pages/roles/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($roleId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $updateData = [
                'name' => $name,
                'description' => $description,
            ];
            if ($this->roleModel->updateRole($roleId, $updateData)) {
                $role = $this->roleModel->getRoleById($roleId);
                $this->data['role'] = $role[0];
                $_SESSION['success'] = 'Chỉnh sửa vai trò thành công';
                $this->view('/Admin/pages/roles/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/roles/edit', ['error' => 'Chỉnh sửa vai trò thất bại']);
            };
        }
    }

    // Function to delete a role from the database
    public function delete($roleId)
    {
        if ($this->roleModel->deleteRole($roleId)) {
            // If the deletion was successful, save success message to session
            $_SESSION['success'] = 'Xóa vai trò thành công';
            // Then redirect to the index page
            header('Location: /the-coffee/admin/role/');
            exit();
        } else {
            // If the deletion failed, show an error message and stay on the current page
            // You can also save the error message to session and display it on the current page
            $_SESSION['error'] = 'Xóa vai trò thất bại';
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
