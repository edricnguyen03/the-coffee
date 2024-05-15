<?php
include_once './App/Models/Auth.php';
class CategoryController extends Controller
{
    public $data;
    public $categoryModel;
    public $productModel;

    public function __construct()
    {
        $this->data = [];
        $this->categoryModel = $this->model('CategoryModel');
        $this->productModel = $this->model('ProductModel');
    }

    // Function to show permission data from the database
    public function index()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 2) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('/Admin/pages/categories/index', $this->data);
    }

    // Function to create a new permission in the database
    public function create()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 2) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->view('/Admin/pages/categories/create',);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];



            // Get the current max id
            $maxId = $this->categoryModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'status' => $status,
            ];
            if ($this->categoryModel->insertCategory($data)) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm danh mục thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/categories/create');
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm danh mục thất bại',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/categories/create');
            };
        }
    }


    // Function to edit an existing permission in the database
    public function edit($categoryId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 2) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $category = $this->categoryModel->getCategoryById($categoryId);

        $this->data['category'] = $category[0];
        $this->view('/Admin/pages/categories/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($categoryId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            $category = $this->categoryModel->getCategoryById($categoryId);
            $this->data['category'] = $category[0];

            $updateData = [
                'name' => $name,
                'status' => $status,
            ];
            if ($this->categoryModel->updateCategory($categoryId, $updateData)) {
                $category = $this->categoryModel->getCategoryById($categoryId);
                $this->data['category'] = $category[0];
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chỉnh sửa danh mục thành công',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/categories/edit', $this->data);
            } else {
                $category = $this->categoryModel->getCategoryById($categoryId);
                $this->data['category'] = $category[0];
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Chỉnh sửa danh mục thất bại',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/categories/edit', $this->data);
            };
        }
    }

    // Function to delete a permission from the database
    public function delete($categoryId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 2) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // Check if category is in product table
        $isInProduct = $this->productModel->checkCategoryInProduct($categoryId);
        if (!$isInProduct) {
            // If category is not in product table, delete it
            if ($this->categoryModel->deleteCategory($categoryId)) {
                $_SESSION['success'] = 'Xóa danh mục thành công';
                header('Location: /the-coffee/admin/category/');
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
            // If category is in product table, set its status to 'Inactive'
            if ($this->categoryModel->setCategoryStatus($categoryId, 'Inactive')) {
                $_SESSION['success'] = 'Danh mục đã được chuyển thành trạng thái Inactive vì có sản phẩm liên quan';
                header('Location: /the-coffee/admin/category/');
                exit();
            } else {
                $_SESSION['error'] = 'Không thể chuyển danh mục thành trạng thái Inactive';
            }
        }
    }
}
