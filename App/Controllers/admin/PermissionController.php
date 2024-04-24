<?php

class PermissionController extends Controller
{
    public $data;
    public $permissionModel;

    public function __construct()
    {
        $this->data = [];
        $this->permissionModel = $this->model('PermissionModel');
    }

    // Function to show permission data from the database
    public function index()
    {
        $this->data['permissions'] = $this->permissionModel->getAllPermissions();
        $this->view('/Admin/pages/permissions/index', $this->data);
    }

    // Function to create a new permission in the database
    public function create()
    {
        $this->view('/Admin/pages/permissions/create',);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            // Get the current max id
            $maxId = $this->permissionModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'description' => $description,
            ];
            if ($this->permissionModel->insertPermission($data)) {
                $this->view('/Admin/pages/permissions/create', ['success' => 'Thêm nhà cung cấp thành công']);
            } else {
                $this->view('/Admin/pages/permissions/create', ['error' => 'Thêm nhà cung cấp thất bại']);
            };
        }
    }


    // Function to edit an existing permission in the database
    public function edit($permissionId)
    {
        $permission = $this->permissionModel->getPermissionById($permissionId);

        $this->data['permission'] = $permission[0];
        $this->view('/Admin/pages/permissions/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($permissionId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $updateData = [
                'name' => $name,
                'description' => $description,
            ];
            if ($this->permissionModel->updatePermission($permissionId, $updateData)) {
                $permission = $this->permissionModel->getPermissionById($permissionId);
                $this->data['permission'] = $permission[0];
                $_SESSION['success'] = 'Chỉnh sửa nhà cung cấp thành công';
                $this->view('/Admin/pages/permissions/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/permissions/edit', ['error' => 'Chỉnh sửa nhà cung cấp thất bại']);
            };
        }
    }

    // Function to delete a permission from the database
    public function delete($permissionId)
    {
        if ($this->permissionModel->deletePermission($permissionId)) {
            // If the deletion was successful, save success message to session
            $_SESSION['success'] = 'Xóa quyền thành công';
            // Then redirect to the index page
            header('Location: /the-coffee/admin/permission/');
            exit();
        } else {
            // If the deletion failed, show an error message and stay on the current page
            // You can also save the error message to session and display it on the current page
            $_SESSION['error'] = 'Xóa quyền thất bại';
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
