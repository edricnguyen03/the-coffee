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
                $this->view('/Admin/pages/providers/create', ['success' => 'Thêm nhà cung cấp thành công']);
            } else {
                $this->view('/Admin/pages/providers/create', ['error' => 'Thêm nhà cung cấp thất bại']);
            };
        }
    }


    // Function to edit an existing provider in the database
    public function edit($providerId)
    {
        if (Auth::checkPermission($_SESSION['login']['id'], 7) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $provider = $this->providerModel->getProviderById($providerId);

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
                $provider = $this->providerModel->getProviderById($providerId);
                $this->data['provider'] = $provider[0];
                $_SESSION['success'] = 'Chỉnh sửa nhà cung cấp thành công';
                $this->view('/Admin/pages/providers/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/providers/edit', ['error' => 'Chỉnh sửa nhà cung cấp thất bại']);
            };
        }
    }

    // Function to delete a provider from the database
    // public function delete($providerId)
    // {
    //     $provider = $this->providerModel->getProviderById($providerId);
    //     if ($this->providerModel->deleteProvider($providerId)) {
    //         // If the deletion was successful, save success message to session
    //         $_SESSION['success'] = 'Xóa nhà cung cấp thành công';
    //         // Then redirect to the index page
    //         header('Location: /the-coffee/admin/provider/');
    //         exit();
    //     } else {
    //         // If the deletion failed, show an error message and stay on the current page
    //         // You can also save the error message to session and display it on the current page
    //         $_SESSION['error'] = 'Xóa nhà cung cấp thất bại';
    //     }
    // }
    public function delete($providerId)
    {
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
                $_SESSION['error'] = 'Xóa nhà cung cấp thất bại';
            }
        } else {
            // If provider is in receipt table, set its status to 'Inactive'
            if ($this->providerModel->setProviderStatus($providerId, 'Inactive')) {
                $_SESSION['success'] = 'Nhà cung cấp đã được chuyển thành trạng thái Inactive vì có trong phiếu nhập';
                header('Location: /the-coffee/admin/provider/');
                exit();
            } else {
                $_SESSION['error'] = 'Không thể chuyển nhà cung cấp thành trạng thái Inactive';
            }
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
