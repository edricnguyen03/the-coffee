<?php
include_once './App/Models/Auth.php';
class Dashboard extends Controller
{
    public function index()
    {
        if (Auth::hasAdminPermission($_SESSION['login']['id']) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->view('/Admin/index',[]);
    }
}
