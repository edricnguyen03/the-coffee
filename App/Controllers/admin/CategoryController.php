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
            header('Location: ../../Login_Regis/logout');
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
            header('Location: ../../Login_Regis/logout');
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
            if (isset($_POST['column_id']) && !empty($_POST['column_id'])){
                // echo '<pre>';
                // print_r($_POST['column_id']);
                // echo '<pre>';
                // die();
                global $db;
                $output = '';  
                $order = $_POST["order"];  
                if($order == 'desc')  
                {  
                    $order = 'asc';  
                }  
                else  
                {  
                    $order = 'desc';  
                }  
                // $query = "SELECT * FROM receipts ORDER BY ".$_POST["column_id"]." ".$_POST["order"]."";  
                $query = $db->query("SELECT * FROM categories ORDER BY ".$_POST["column_id"]." ".$_POST["order"]."");
                $query->execute();
                $output .= '
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên danh mục">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>  
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
                            <th scope="col"><a class="column_sort" id="name" data-order="'.$order.'" href="#">Tên Danh Mục</a></th>
                            <th scope="col"><a class="column_sort" id="status" data-order="'.$order.'" href="#">Trạng thái</a></th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>  
                ';
                $providers2 = $query->fetchAll();
             //     echo '<pre>';
             //    print_r($providers2);
             //    echo '<pre>';
             //    die();
                foreach ($providers2 as $row) 
                {  
                    $output .= ' 
                    <tbody>  
                    <tr>
                            <th scope="row">' . $row["id"] . '</th>
                            <td>' . $row["name"] . '</td>
                            <td>';
                            if ($row['status'] == '1') {
                                $output .= '<button class="btn btn-success" disabled>Active</button>';
                            } else {
                                $output .= '<button class="btn btn-danger" disabled>Inactive</button>';
                            }
                            $output .= '</td>
                            <td>
                                <a href="edit/' . $row["id"] . '" class="btn btn-primary">Sửa</a>
                                <a onclick="return confirm(\'Bạn có muốn xóa nhà cung cấp này không ?\')" href="delete/' . $row["id"] . '" class="btn btn-danger">Xóa</a>
                            </td>
                    </tr>
                    </tbody>
                    ';  
                }  
                $output .= '</table>';  
                echo $output;  
                //PHẦN XỬ LÝ SẮP XẾP TĂNG DẦN GIẢM DẦN
            }
            else {
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
    }


    // Function to edit an existing permission in the database
    public function edit($categoryId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
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
