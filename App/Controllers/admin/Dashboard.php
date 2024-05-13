<?php
class Dashboard extends Controller
{
    public function index()
    {
        $data['userModel'] = $this->model('UserModel');
        $this->view('/Admin/index', $data);
    }
}
