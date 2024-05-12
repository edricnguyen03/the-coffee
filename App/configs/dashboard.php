<?php

$routes['default_controller'] = 'Home';
$routes['default_action'] = 'index';

//Admin
$routes['admin/logout'] = 'Login_Regis/Logout';

//Dashboard
$routes['admin/dashboard'] = 'admin/Dashboard/index';

//Stats
$routes['admin/stat'] = 'admin/StatsController/index';

// User
$routes['admin/user'] = 'admin/UserController/index';
$routes['admin/user/check_email'] = 'admin/UserController/check_email';
$routes['admin/user/alert'] = 'admin/UserController/alert';
//Create User
$routes['admin/user/create'] = 'admin/UserController/create';
$routes['admin/user/store'] = 'admin/UserController/store';
//Update User
$routes['admin/user/edit'] = 'admin/UserController/edit';
$routes['admin/user/update'] = 'admin/UserController/update';
//Delete User
$routes['admin/user/delete'] = 'admin/UserController/delete';


// Provider
$routes['admin/provider'] = 'admin/ProviderController/index';
$routes['admin/provider/alert'] = 'admin/ProviderController/alert';
//Create Provider
$routes['admin/provider/create'] = 'admin/ProviderController/create';
$routes['admin/provider/store'] = 'admin/ProviderController/store';
//Update Provider
$routes['admin/provider/edit'] = 'admin/ProviderController/edit';
$routes['admin/provider/update'] = 'admin/ProviderController/update';
//Delete Provider
$routes['admin/provider/delete'] = 'admin/ProviderController/delete';


$routes['base-img-url'] = 'http://localhost:8080/the-coffee/';
