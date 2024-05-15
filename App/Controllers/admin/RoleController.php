<?php
include_once './App/Models/Auth.php';
class RoleController extends Controller
{
    public $data;
    public $roleModel;
    public $permissionModel;
    public $permissionRoleModel;
    public $userModel;

    public function __construct()
    {
        $this->data = [];
        $this->roleModel = $this->model('RoleModel');
        $this->permissionModel = $this->model('PermissionModel');
        $this->permissionRoleModel = $this->model('PermissionRoleModel');
        $this->userModel = $this->model('UserModel');
    }

    // Function to show role data from the database
    public function index()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
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
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $this->data['permissions'] = $this->permissionModel->getAllPermissions();
            $description = $_POST['description'];
            // Get the current max id
            $maxId = $this->roleModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'description' => $description,
            ];
            if (!isset($_POST['permissions']) || $_POST['permissions'] == null) {
                $this->roleModel->insertRole($data);
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm vai trò thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/roles/create', $this->data);
                // exit();
            } else {
                $permissions = $_POST['permissions'];
            }

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
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm vai trò thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                // If role is inserted successfully, update permission_role model
                $this->view('/Admin/pages/roles/create', $this->data);
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm vai trò thất bại',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/roles/create',);
            };
        }
    }


    // Function to edit an existing role in the database
    public function edit($roleId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
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


            $updateData = [
                'name' => $name,
                'description' => $description,
            ];
            if (!isset($_POST['permissions']) || $_POST['permissions'] == null) {
                $this->permissionRoleModel->deletePermissionsByRoleId($roleId);

                $this->roleModel->updateRole($roleId, $updateData);
                $role = $this->roleModel->getRoleById($roleId);
                $this->data['permissions'] = $this->permissionModel->getAllPermissions();
                $rolePermissions = $this->permissionRoleModel->getPermissionsByRoleId($roleId);
                // Convert the result to an array of permission ids
                $this->data['rolePermissions'] = array_map(function ($permission) {
                    return $permission['permission_id'];
                }, $rolePermissions);
                $this->data['role'] = $role[0];
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chỉnh sửa vai trò thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/roles/edit', $this->data);
                exit();
            } else {
                $permissions = $_POST['permissions'];
            }


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
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chỉnh sửa vai trò thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/roles/edit', $this->data);
                exit();
            } else {
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
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Chỉnh sửa nhà cung cấp thất bại',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/roles/edit', $this->data);
            };
        }
    }

    // Function to delete a role from the database
    public function delete($roleId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 5) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $isRoleInUser = $this->userModel->checkRoleInUser($roleId);
        if (!$isRoleInUser) {
            // If role is not in user table, delete it
            if ($this->roleModel->deleteRole($roleId)) {
                $_SESSION['success'] = 'Xóa vai trò thành công';
                header('Location: /the-coffee/admin/role/');
                exit();
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Xóa danh mục thât bại',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
            }
        } else {
            // If role is in user table show an error message
            $_SESSION['error'] = 'Không thể xóa vai trò này vì có người dùng đang sử dụng';
            header('Location: /the-coffee/admin/role/');
            exit();
        }
    }
}
