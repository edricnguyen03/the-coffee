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

            if (!preg_match('/^[a-zA-Z0-9\sàáâãèéêìíòóôõùúýăđėĩũơưạảấầẩẫậắằẳẵặẹẻẽếềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]+$/', $name)) {
                $_SESSION['error'] = 'Tên danh mục không được chứa ký tự đặc biệt';
                $this->view('/Admin/pages/categories/create', $this->data);
                exit();
            }
            if (strlen(trim($name)) > 50 || strlen(trim($name)) < 4) {
                $_SESSION['error'] = 'Tên danh mục không được vượt quá 4-50 ký tự';
                $this->view('/Admin/pages/categories/create', $this->data);
            }

            // Get the current max id
            $maxId = $this->categoryModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'status' => $status,
            ];
            if ($this->categoryModel->insertCategory($data)) {
                $this->view('/Admin/pages/categories/create', ['success' => 'Thêm danh mục mới thành công']);
            } else {
                $this->view('/Admin/pages/categories/create', ['error' => 'Thêm danh mục mới thất bại']);
            };
        }
    }


    // Function to edit an existing permission in the database
    public function edit($categoryId)
    {
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

            if (!preg_match('/^[a-zA-Z0-9\sàáâãèéêìíòóôõùúýăđėĩũơưạảấầẩẫậắằẳẵặẹẻẽếềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]+$/', $name)) {
                $_SESSION['error'] = 'Tên danh mục không được chứa ký tự đặc biệt';
                $this->view('/Admin/pages/categories/edit', $this->data);
                exit();
            }
            if (strlen(trim($name)) > 50 || strlen(trim($name)) < 4) {
                $_SESSION['error'] = 'Tên danh mục không được vượt quá 4-50 ký tự';
                $this->view('/Admin/pages/categories/edit', $this->data);
            }

            $updateData = [
                'name' => $name,
                'status' => $status,
            ];
            if ($this->categoryModel->updateCategory($categoryId, $updateData)) {
                $category = $this->categoryModel->getCategoryById($categoryId);
                $this->data['category'] = $category[0];
                $_SESSION['success'] = 'Chỉnh sửa danh mục thành công';
                $this->view('/Admin/pages/categories/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/categories/edit', ['error' => 'Chỉnh sửa danh mục thất bại']);
            };
        }
    }

    // Function to delete a permission from the database
    public function delete($categoryId)
    {
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
                $_SESSION['error'] = 'Xóa danh mục thất bại';
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

    public function alert()
    {
        $this->view('/alert',);
    }
}
