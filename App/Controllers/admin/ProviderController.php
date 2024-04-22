<?php

class ProviderController extends Controller
{
    public $data;
    public $providerModel;

    public function __construct()
    {
        $this->data = [];
        $this->providerModel = $this->model('ProviderModel');
    }

    // Function to show provider data from the database
    public function index()
    {
        $this->data['providers'] = $this->providerModel->getAllProviders();
        $this->view('/Admin/pages/providers/index', $this->data);
    }

    // Function to create a new provider in the database
    public function create()
    {
        $this->view('/Admin/pages/providers/create',);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            // Get the current max id
            $maxId = $this->providerModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'description' => $description,
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

            $updateData = [
                'name' => $name,
                'description' => $description,
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
    public function delete($providerId)
    {
        if ($this->providerModel->deleteProvider($providerId)) {
            // If the deletion was successful, save success message to session
            $_SESSION['success'] = 'Xóa người dùng thành công';
            // Then redirect to the index page
            header('Location: /the-coffee/admin/provider/');
            exit();
        } else {
            // If the deletion failed, show an error message and stay on the current page
            // You can also save the error message to session and display it on the current page
            $_SESSION['error'] = 'Xóa người dùng thất bại';
        }
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
