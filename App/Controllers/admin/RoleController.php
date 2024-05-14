<?php
include_once './App/Models/Auth.php';
class RoleController extends Controller
{
    public $data;
    public $roleModel;
    public $permissionModel;
    public $permissionRoleModel;

    public function __construct()
    {
        $this->data = [];
        $this->roleModel = $this->model('RoleModel');
        $this->permissionModel = $this->model('PermissionModel');
        $this->permissionRoleModel = $this->model('PermissionRoleModel');
    }

    // Function to show role data from the database
    public function index()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 5) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['roles'] = $this->roleModel->getAllRoles();
        $this->view('/Admin/pages/roles/index', $this->data);
    }

    // Function to create a new role in the database
    public function create()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 5) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['permissions'] = $this->permissionModel->getAllPermissions();
        $this->view('/Admin/pages/roles/create', $this->data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $permissions = $_POST['permissions'];

            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
                $_SESSION['error'] = 'Tên vai trò không được chứa ký tự đặc biệt';
                $this->view('/Admin/pages/products/create', $this->data);
                exit();
            }
            // Get the current max id
            $maxId = $this->roleModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'description' => $description,
            ];
            if ($this->roleModel->insertRole($data)) {
                if ((is_array($permissions)) || is_object($permissions)) {
                    foreach ($permissions as $permissionId) {
                        $data_permision_role = [
                            'role_id' => $newId,
                            'permission_id' => $permissionId
                        ];
                        $this->permissionRoleModel->insertPermissionRole($data_permision_role);
                    }
                }
                $_SESSION['success'] = 'Thêm vai trò thành công';
                $this->data['permissions'] = $this->permissionModel->getAllPermissions();
                // If role is inserted successfully, update permission_role model
                $this->view('/Admin/pages/roles/create', $this->data);
            } else {
                $this->view('/Admin/pages/roles/create', ['error' => 'Thêm vai trò thất bại']);
            };
        }
    }


    // Function to edit an existing role in the database
    public function edit($roleId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 5) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $role = $this->roleModel->getRoleById($roleId);
        $this->data['permissions'] = $this->permissionModel->getAllPermissions();
        $rolePermissions = $this->permissionRoleModel->getPermissionsByRoleId($roleId);
        // Convert the result to an array of permission ids
        $this->data['rolePermissions'] = array_map(function ($permission) {
            return $permission['permission_id'];
        }, $rolePermissions);
        $this->data['role'] = $role[0];
        $this->view('/Admin/pages/roles/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($roleId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $permissions = $_POST['permissions'];

            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
                $_SESSION['error'] = 'Tên vai trò không được chứa ký tự đặc biệt';
                $this->view('/Admin/pages/products/create', $this->data);
                exit();
            }
            $updateData = [
                'name' => $name,
                'description' => $description,
            ];
            if ($this->roleModel->updateRole($roleId, $updateData)) {
                // Delete all current permissions of the role
                $this->permissionRoleModel->deletePermissionsByRoleId($roleId);

                if ((is_array($permissions)) || is_object($permissions)) {
                    foreach ($permissions as $permissionId) {
                        $data_permision_role = [
                            'role_id' => $roleId,
                            'permission_id' => $permissionId
                        ];
                        $this->permissionRoleModel->insertPermissionRole($data_permision_role);
                    }
                }
                $role = $this->roleModel->getRoleById($roleId);
                $this->data['permissions'] = $this->permissionModel->getAllPermissions();
                $rolePermissions = $this->permissionRoleModel->getPermissionsByRoleId($roleId);
                // Convert the result to an array of permission ids
                $this->data['rolePermissions'] = array_map(function ($permission) {
                    return $permission['permission_id'];
                }, $rolePermissions);
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
        if (Auth::checkPermission($_SESSION['login']['id'], 5) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
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
