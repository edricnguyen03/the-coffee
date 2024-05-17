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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == false) {
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == false) {
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
            if (isset($_POST['column_id']) && !empty($_POST['column_id'])) {
                // echo '<pre>';
                // print_r($_POST['column_id']);
                // echo '<pre>';
                // die();
                global $db;
                $output = '';
                $order = $_POST["order"];
                if ($order == 'desc') {
                    $order = 'asc';
                } else {
                    $order = 'desc';
                }
                // $query = "SELECT * FROM receipts ORDER BY ".$_POST["column_id"]." ".$_POST["order"]."";  
                $query = $db->query("SELECT * FROM products ORDER BY " . $_POST["column_id"] . " " . $_POST["order"] . "");
                $query->execute();
                $output .= '
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên sản phẩm">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>  
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><a class="column_sort" id="id" data-order="' . $order . '" href="#">ID</a></th>
                            <th scope="col"><a class="column_sort" id="name" data-order="' . $order . '" href="#">Tên sản phẩm</a></th>
                            <th scope="col"><span id="thumb_image" data-order="' . $order . '" href="#">Hình ảnh</span></th>
                            <th scope="col"><a class="column_sort" id="price" data-order="' . $order . '" href="#">Giá tiền</a></th>
                            <th scope="col"><a class="column_sort" id="weight" data-order="' . $order . '" href="#">Cân nặng</a></th>
                            <th scope="col"><a class="column_sort" id="category_id" data-order="' . $order . '" href="#">Loại sản phẩm</a></th>
                            <th scope="col"><a class="column_sort" id="status" data-order="' . $order . '" href="#">Trạng thái</a></th>
                            <th scope="col"><a class="column_sort" id="stock" data-order="' . $order . '" href="#">Số lượng tồn</a></th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>  
                ';
                // $role_id = $user['role_id'];
                // $query = $db->query("SELECT * FROM roles WHERE id = $role_id");
                // $query->execute();
                // $role = $query->fetch();
                // echo $role['name'];
                $product2 = $query->fetchAll();
                // foreach ($product2 as $row) {
                //     echo '<pre>';
                //     print_r($row);
                //     echo '<pre>';
                // }
                // die();
                $categories = $this->categoryModel->get();
                foreach ($product2 as $row) {
                    // $role_id = $row['role_id'];
                    // $query = $db->query("SELECT * FROM roles WHERE id = $role_id");
                    // $query->execute();
                    // $role = $query->fetch();
                    // echo $role['name'];
                    $output .= ' 
                    <tbody>  
                    <tr>
                            <th scope="row">' . $row["id"] . '</th>
                                    <td>' . $row["name"] . '</td>
                                    <td> <img src="../../resources/images/products/' . $row["thumb_image"] . '" width="100"></td>
                                    <td>' . $row["price"] . '</td>
                                    <td>' . $row["weight"] . '</td>
                                    <td>';

                    foreach ($categories as $category) {
                        if ($category->id == $row['category_id']) {
                            $output .= $category->name;
                        }
                    }

                    $output .= '</td>
                                    <td>';
                    if ($row["status"] == '1') {
                        $output .= '<button class="btn btn-success" disabled>Active</button>';
                    } else {
                        $output .= '<button class="btn btn-danger" disabled>Inactive</button>';
                    }

                    $output .= '</td>
                                    <td>' . $row["stock"] . '</td>
                                    <td>
                                        <a href="edit/' . $row['id'] . '" class="btn btn-primary">Sửa</a>
                                        <a onclick="confirmDelete(event, ' . $row['id'] . ')" href="delete/' . $row['id'] . '" class="btn btn-danger">Xóa</a>

                    </tr>
                    </tbody>
                    ';
                }
                $output .= '</table>';
                echo $output;
                //PHẦN XỬ LÝ SẮP XẾP TĂNG DẦN GIẢM DẦN
            } else {
                $this->data['categories'] = $this->categoryModel->get();

                $name = $_POST['name'];

                if ($this->productModel->checkProductNameExists($name)) {
                    $_SESSION['error'] = 'Tên sản phẩm đã tồn tại';
                    $this->view('/Admin/pages/products/create', $this->data);
                    exit();
                }

                $slug = $this->createSlug($name);
                $category_id = $_POST['category_id'];
                $price = $_POST['price'];
                $weight = $_POST['weight'];
                $status = $_POST['status'];
                $content = $_POST['content'];
                $description = $_POST['description'];


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
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm sản phẩm thành công',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                    // $this->data['products'] = $this->productModel->getAllProducts();
                    $this->data['categories'] = $this->categoryModel->get();
                    $this->view('/Admin/pages/products/create', $this->data);
                    // exit();
                } else {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm sản phẩm thất bại',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                    $this->data['categories'] = $this->categoryModel->get();
                    $this->view('/Admin/pages/products/create', $this->data);
                    exit();
                };
            }
        }
    }

    // Function to edit an existing product in the database
    public function edit($productId)
    {

        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['categories'] = $this->categoryModel->get();
        $this->data['product'] =  $this->productModel->getProductById($productId);
        $this->view('/Admin/pages/products/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($productId)
    {
        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $slug = $this->createSlug($name);
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $weight = $_POST['weight'];
            $status = $_POST['status'];
            $content = $_POST['content'];
            $description = $_POST['description'];

            $this->data['categories'] = $this->categoryModel->get();
            $this->data['product'] =  $this->productModel->getProductById($productId);

            $oldName = $this->productModel->getProductById($productId)->name;

            if ($name != $oldName) {
                // Check if the product name already exists
                if ($this->productModel->checkProductNameExists($name)) {
                    $_SESSION['error'] = 'Tên sản phẩm đã tồn tại';
                    $this->view('/Admin/pages/products/edit', $this->data);
                    exit();
                }
            }
            $old_image = $_POST['old-image'];
            $filename = $old_image; // default to old image

            if (!empty($_FILES["upload-file"]["name"])) {
                $new_file = $_FILES["upload-file"]["name"];
                $temp_file = $_FILES["upload-file"]["tmp_name"];

                $extention = array('jpg', 'jpeg', 'png');
                $validation = pathinfo($new_file, PATHINFO_EXTENSION);

                if (!in_array($validation, $extention)) {
                    $_SESSION['error'] = 'Tệp đã chọn không phải là hình ảnh';
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
            if ($this->productModel->updateproduct($productId, $updateData)) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chỉnh sửa sản phẩm thành công',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";

                $this->view('/Admin/pages/products/edit', $this->data);

                exit();
            } else {

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Chỉnh sửa sản phẩm thất bại',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                $this->view('/Admin/pages/products/edit', $this->data);
                exit();
            };
        }
    }

    // Function to delete a product from the database
    public function delete($productId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $product = $this->productModel->getProductById($productId);
        $isInOrderProduct = $this->orderProductModel->checkProductInOrder($productId);
        if (!$isInOrderProduct) {
            // If product is not in order_product table, delete it
            if ($this->productModel->deleteProduct($productId) && unlink("resources/images/products/" . $product->thumb_image)) {
                $_SESSION['success'] = 'Xóa sản phẩm thành công';
                header('Location: /the-coffee/admin/product/');
                exit();
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Xóa sản phẩm thât bại',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == false) {
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
}
