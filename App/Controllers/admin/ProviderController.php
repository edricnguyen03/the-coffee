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
        if (Auth::checkPermission($_SESSION['login']['id'], 7) == false) {
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
        if (Auth::checkPermission($_SESSION['login']['id'], 7) == false) {
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
                            timer: 1500
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
                            timer: 1500
                          });
                    });
                </script>";
                $this->view('/Admin/pages/providers/create');
            };
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
        if (Auth::checkPermission($_SESSION['login']['id'], 7) == false) {
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
                            timer: 1500
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
                            timer: 1500
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
        if (Auth::checkPermission($_SESSION['login']['id'], 7) == false) {
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
                            timer: 1500
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
