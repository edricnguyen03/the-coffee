<?php
include_once './App/Models/Auth.php';
class productController extends Controller
{
    public $data;
    public $productModel;
    public $categoryModel;
    public $orderProductModel;

    public function __construct()
    {
        $this->data = [];
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
    }

    // Function to show product data from the database
    public function index()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 3) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['categories'] = $this->categoryModel->get();
        $this->data['products'] = $this->productModel->getAllProducts();
        $this->view('/Admin/pages/products/index', $this->data);
    }

    // Function to create a new product in the database
    public function create()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 3) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['categories'] = $this->categoryModel->get();
        $this->view('/Admin/pages/products/create', $this->data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->data['categories'] = $this->categoryModel->get();

            $name = $_POST['name'];

            $slug = $this->createSlug($name);
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $weight = $_POST['weight'];
            $status = $_POST['status'];
            $content = $_POST['content'];
            $description = $_POST['description'];

            // Check if the product name already exists
            // if ($this->productModel->checkProductNameExists($name)) {
            //     $_SESSION['error'] = 'Tên sản phẩm đã tồn tại';
            //     $this->view('/Admin/pages/products/create', $this->data);
            //     exit();
            // }
            // if (!preg_match('/^[a-zA-Z0-9\sàáâãèéêìíòóôõùúýăđėĩũơưạảấầẩẫậắằẳẵặẹẻẽếềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]+$/', $name)) {
            //     $_SESSION['error'] = 'Tên sản phẩm không được chứa ký tự đặc biệt';
            //     $this->view('/Admin/pages/products/create', $this->data);
            //     exit();
            // }

            // if ($price > 5000 && $price < 10000000) {
            //     $_SESSION['error'] = 'Giá sản phẩm phải từ 5000đ đến 10000000đ';
            //     $this->view('/Admin/pages/products/create', $this->data);
            //     exit();
            // }

            // if ($weight > 0 && $weight < 20000) {
            //     $_SESSION['error'] = 'Khối lượng sản phẩm phải từ 0 đến 20000 gram';
            //     $this->view('/Admin/pages/products/create', $this->data);
            //     exit();
            // }



            $filename = uniqid() . '_' . $_FILES["uploadfile"]["name"];
            $folder = "resources/images/products/" . $filename;

            $check = getimagesize($_FILES["uploadfile"]["tmp_name"]);
            if ($check === false) {
                $_SESSION['error'] = 'Tệp đã chọn không phải là hình ảnh';
                $this->view('/Admin/pages/products/create', $this->data);
                exit();
            }


            // Get the current max id
            $maxId = $this->productModel->getMaxId();
            $newId = $maxId + 1;

            $dataInsert = [
                'id' => $newId,
                'name' => $name,
                'slug' => $slug,
                'thumb_image' => $filename,
                'category_id' => $category_id,
                'price' => $price,
                'weight' => $weight,
                'status' => $status,
                'content' => $content,
                'description' => $description,
            ];
            if ($this->productModel->insertProduct($dataInsert) && move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder)) {
                $_SESSION['success'] = 'Thêm sản phẩm thành công';
                $this->data['products'] = $this->productModel->getAllProducts();
                $this->view('/Admin/pages/products/index', $this->data);
                exit();
            } else {
                $_SESSION['error'] = 'Thêm sản phẩm thất bại';
                $this->view('/Admin/pages/products/create', $this->data);
                exit();
            };
        }
    }


    // Function to edit an existing product in the database
    public function edit($productId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 3) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['categories'] = $this->categoryModel->get();
        $this->data['product'] =  $this->productModel->getById($productId);
        $this->view('/Admin/pages/products/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'];
            $slug = $this->createSlug($name);
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $weight = $_POST['weight'];
            $status = $_POST['status'];
            $content = $_POST['content'];
            $description = $_POST['description'];


            $oldName = $this->productModel->getById($productId)->name;
            if ($name != $oldName) {
                // Check if the product name already exists
                if ($this->productModel->checkProductNameExists($name)) {
                    $_SESSION['error'] = 'Tên sản phẩm đã tồn tại';
                    $this->data['categories'] = $this->categoryModel->get();
                    $this->data['product'] =  $this->productModel->getById($productId);
                    $this->view('/Admin/pages/products/edit', $this->data);
                    exit();
                }
            }

            $this->data['categories'] = $this->categoryModel->get();
            $this->data['product'] =  $this->productModel->getById($productId);

            // if (!preg_match('/^[a-zA-Z0-9 àáâãèéêìíòóôõùúýăđėĩũơưạảấầẩẫậắằẳẵặẹẻẽếềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]+$/', $name)) {
            //     $_SESSION['error'] = 'Tên sản phẩm không được chứa ký tự đặc biệt';
            //     $this->view('/Admin/pages/products/edit', $this->data);
            //     exit();
            // }

            // if (strlen(trim($name)) > 50 || strlen(trim($name)) < 4) {
            //     $_SESSION['error'] = 'Tên sản phẩm không được vượt quá 4-50 ký tự';
            //     $this->view('/Admin/pages/roles/edit', $this->data);
            //     exit();
            // }

            // if ($price < 5000 || $price > 10000000) {
            //     $_SESSION['error'] = 'Giá sản phẩm phải từ 5000đ đến 10000000đ';
            //     unset($_SESSION['username']);
            //     $this->view('/Admin/pages/products/edit', $this->data);
            //     exit();
            // }

            // if ($weight < 1 || $weight > 20000) {
            //     $_SESSION['error'] = 'Khối lượng sản phẩm phải từ 0 đến 20000 gram';
            //     $this->view('/Admin/pages/products/edit', $this->data);
            //     exit();
            // }



            $old_image = $_POST['old-image'];
            $filename = $old_image; // default to old image

            if (!empty($_FILES["upload-file"]["name"])) {
                $new_file = $_FILES["upload-file"]["name"];
                $temp_file = $_FILES["upload-file"]["tmp_name"];

                $extention = array('jpg', 'jpeg', 'png');
                $validation = pathinfo($new_file, PATHINFO_EXTENSION);

                if (!in_array($validation, $extention)) {
                    $_SESSION['error'] = 'Tệp đã chọn không phải là hình ảnh';
                    $this->data['categories'] = $this->categoryModel->get();
                    $this->data['product'] =  $this->productModel->getById($productId);
                    $this->view('/Admin/pages/products/edit', $this->data);
                    exit();
                } else {
                    $new_name = uniqid() . '_' . $new_file;
                    $filename = $new_name;
                    $folder = "resources/images/products/" . $filename;
                    move_uploaded_file($temp_file, $folder);
                    $oldImagePath = "resources/images/products/" . $_POST['old-image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
            // $folder = "resources/images/products/" . $filename;

            $updateData = [
                'name' => $name,
                'slug' => $slug,
                'thumb_image' => $filename,
                'category_id' => $category_id,
                'price' => $price,
                'weight' => $weight,
                'status' => $status,
                'content' => $content,
                'description' => $description,
            ];

            // echo '<pre>';
            // print_r($updateData);
            // echo '<pre>';
            // die();
            if ($this->productModel->updateproduct($productId, $updateData)) {
                $_SESSION['success'] = 'Chỉnh sửa sản phẩm thành công';
                $this->data['categories'] = $this->categoryModel->get();
                $this->data['product'] =  $this->productModel->getById($productId);
                $this->view('/Admin/pages/products/edit', $this->data);
                exit();
            } else {
                // $_SESSION['error'] = 'Chỉnh sửa sản phẩm không thành công';
                $this->data['categories'] = $this->categoryModel->get();
                $this->data['product'] =  $this->productModel->getById($productId);
                $this->view('/Admin/pages/products/edit', $this->data);
                exit();
            };
        }
    }

    // Function to delete a product from the database
    public function delete($productId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 3) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $product = $this->productModel->getById($productId);
        $isInOrderProduct = $this->orderProductModel->checkProductInOrder($productId);
        if (!$isInOrderProduct) {
            // If product is not in order_product table, delete it
            if ($this->productModel->deleteProduct($productId) && unlink("resources/images/products/" . $product->thumb_image)) {
                $_SESSION['success'] = 'Xóa nhà sản phẩm thành công';
                header('Location: /the-coffee/admin/product/');
                exit();
            } else {
                $_SESSION['error'] = 'Xóa nhà sản phẩm thất bại';
            }
        } else {
            // If product is in order_product table, set its status to 'Inactive'
            if ($this->productModel->setProductStatus($productId, 'Inactive')) {
                $_SESSION['success'] = 'Sản phẩm đã được chuyển thành trạng thái Inactive vì có trong đơn hàng';
                header('Location: /the-coffee/admin/product/');
                exit();
            } else {
                $_SESSION['error'] = 'Không thể chuyển sản phẩm thành trạng thái Inactive';
            }
        }
    }

    public function createSlug($name)
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $name);
        $slug = strtolower($slug); // Convert to lowercase
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug); // Replace all non-letter or non-number characters with hyphens
        $slug = trim($slug, '-'); // Remove hyphens from the beginning and end
        return $slug;
    }

    public function search()
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 3) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        if (isset($_GET['search'])) {
            $key = $_GET['search'];
            $this->data['categories'] = $this->categoryModel->get();
            $this->data['products'] = $this->productModel->search($key);
            $this->view('/Admin/pages/products/index', $this->data);
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
