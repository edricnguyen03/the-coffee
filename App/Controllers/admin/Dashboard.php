<?php
class Dashboard extends Controller
{
    public function index()
    {
        $this->view('/Admin/index',[]);
    }
}
