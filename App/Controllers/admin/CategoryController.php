<?php

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
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('/Admin/pages/categories/index', $this->data);
    }

    // Function to create a new permission in the database
    public function create()
    {
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
                $this->view('/Admin/pages/categories/create', ['success' => 'Thêm danh mục mới thành công']);
            } else {
                $this->view('/Admin/pages/categories/create', ['error' => 'Thêm danh mục mới thất bại']);
            };
        }
    }


    // Function to edit an existing permission in the database
    public function edit($categoryId)
    {
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
