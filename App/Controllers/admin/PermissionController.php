<?php
include_once './App/Models/Auth.php';
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
        if (Auth::checkPermission($_SESSION['login']['id'], 9) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['permissions'] = $this->permissionModel->getAllPermissions();
        $this->view('/Admin/pages/permissions/index', $this->data);
    }

    // Function to create a new permission in the database
    public function create()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 9) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
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
                $this->view('/Admin/pages/permissions/create', ['success' => 'Thêm phân quyền mới thành công']);
            } else {
                $this->view('/Admin/pages/permissions/create', ['error' => 'Thêm phân quyền mới thất bại']);
            };
        }
    }


    // Function to edit an existing permission in the database
    public function edit($permissionId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 9) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
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
                $_SESSION['success'] = 'Chỉnh sửa phân quyền thành công';
                $this->view('/Admin/pages/permissions/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/permissions/edit', ['error' => 'Chỉnh sửa phân quyền thất bại']);
            };
        }
    }

    // Function to delete a permission from the database
    public function delete($permissionId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 9) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        if ($this->permissionModel->deletePermission($permissionId)) {
            // If the deletion was successful, save success message to session
            $_SESSION['success'] = 'Xóa phân quyền thành công';
            // Then redirect to the index page
            header('Location: /the-coffee/admin/permission/');
            exit();
        } else {
            // If the deletion failed, show an error message and stay on the current page
            // You can also save the error message to session and display it on the current page
            $_SESSION['error'] = 'Xóa phân quyền thất bại';
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
