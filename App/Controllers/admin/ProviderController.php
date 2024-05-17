<?php
include_once './App/Models/Auth.php';
class ProviderController extends Controller
{
    public $data;
    public $providerModel;
    public $receiptModel;

    public function __construct()
    {
        $this->data = [];
        $this->providerModel = $this->model('ProviderModel');
        $this->receiptModel = $this->model('ReceiptModel');
    }

    // Function to show provider data from the database
    public function index()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProvider) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['providers'] = $this->providerModel->getAllProviders();
        $this->view('/Admin/pages/providers/index', $this->data);
    }

    // Function to create a new provider in the database
    public function create()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProvider) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // $this->data['name'] = $this->providerModel->getAllProvidersName();
        $this->view('/Admin/pages/providers/create', $this->data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //PHẦN XỬ LÝ SẮP XẾP TĂNG DẦN GIẢM DẦN
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
                $query = $db->query("SELECT * FROM providers ORDER BY " . $_POST["column_id"] . " " . $_POST["order"] . "");
                $query->execute();
                $output .= '
                       <div class="mb-3">
                           <form method="GET">
                               <div class="input-group">
                                   <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên nhà cung cấp">
                                   <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                               </div>
                           </form>
                       </div>  
                       <table class="table">
                       <thead>
                           <tr>
                                <th scope="col"><a class="column_sort" id="id" data-order="' . $order . '" href="#">ID</a></th>
                                <th scope="col"><a class="column_sort" id="name" data-order="' . $order . '" href="#">Tên nhà cung cấp</a></th>
                                <th scope="col"><a class="column_sort" id="description" data-order="' . $order . '" href="#">Mô tả</a></th>
                                <th scope="col"><a class="column_sort" id="status" data-order="' . $order . '" href="#">Trạng thái</a></th>
                                <th scope="col">Hành động</th>
                           </tr>
                       </thead>  
                   ';
                $providers2 = $query->fetchAll();
                //     echo '<pre>';
                //    print_r($providers2);
                //    echo '<pre>';
                //    die();
                foreach ($providers2 as $row) {
                    $output .= ' 
                       <tbody>  
                       <tr>
                               <th scope="row">' . $row["id"] . '</th>
                               <td>' . $row["name"] . '</td>
                               <td>' . $row["description"] . '</td>
                               <td>';
                    if ($row['status'] == '1') {
                        $output .= '<button class="btn btn-success" disabled>Active</button>';
                    } else {
                        $output .= '<button class="btn btn-danger" disabled>Inactive</button>';
                    }
                    $output .= '</td>
                                <td>
                               <a href="edit/' . $row['id'] . '" class="btn btn-primary">Sửa</a>
                               <a onclick="return confirm(\'Bạn có muốn xóa nhà cung cấp này không ?\')" href="delete/' . $row['id'] . '" class="btn btn-danger">Xóa</a>
                           </td>
                       </tr>
                       </tbody>
                       ';
                }
                $output .= '</table>';
                echo $output;
                //PHẦN XỬ LÝ SẮP XẾP TĂNG DẦN GIẢM DẦN
            } else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $status = $_POST['status'];

                // Get the current max id
                $maxId = $this->providerModel->getMaxId();
                $newId = $maxId + 1;

                $data = [
                    'id' => $newId,
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                ];
                if ($this->providerModel->insertProvider($data)) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm nhà cung cấp thành công',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                    $this->view('/Admin/pages/providers/create');
                } else {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm nhà cung cấp thất bại',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                    $this->view('/Admin/pages/providers/create');
                };
            }
        }
    }

    // Function to edit an existing provider in the database
    public function edit($providerId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProvider) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $provider = $this->providerModel->getById($providerId);

        $this->data['provider'] = $provider[0];
        $this->view('/Admin/pages/providers/edit', $this->data);
        // Redirect to the index page or show a success message
    }

    public function update($providerId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            $updateData = [
                'name' => $name,
                'description' => $description,
                'status' => $status,
            ];
            if ($this->providerModel->updateProvider($providerId, $updateData)) {
                $provider = $this->providerModel->getById($providerId);
                $this->data['provider'] = $provider[0];
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chỉnh sửa nhà cung cấp thành công',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                $this->view('/Admin/pages/providers/edit', $this->data);
            } else {
                $provider = $this->providerModel->getById($providerId);
                $this->data['provider'] = $provider[0];
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Chỉnh sửa nhà cung cấp thất bại',
                            showConfirmButton: false,
                            timer: 2250
                          });
                    });
                </script>";
                $this->view('/Admin/pages/providers/edit',);
            };
        }
    }

    public function delete($providerId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProvider) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // Check if provider is in receipt table
        $isInReceipt = $this->receiptModel->checkProviderInReceipt($providerId);

        if (!$isInReceipt) {
            // If provider is not in receipt table, delete it
            if ($this->providerModel->deleteProvider($providerId)) {
                $_SESSION['success'] = 'Xóa nhà cung cấp thành công';
                header('Location: /the-coffee/admin/provider/');
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
                            timer: 2250
                          });
                    });
                </script>";
            }
        } else {
            // If provider is in receipt table, set its status to 'Inactive'
            if ($this->providerModel->setProviderStatus($providerId, 0)) {
                $_SESSION['success'] = 'Nhà cung cấp đã được chuyển thành trạng thái Inactive vì có trong phiếu nhập';
                header('Location: /the-coffee/admin/provider/');
                exit();
            } else {
                $_SESSION['error'] = 'Không thể chuyển nhà cung cấp thành trạng thái Inactive';
            }
        }
    }
}
