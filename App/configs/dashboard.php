<?php

$routes['default_controller'] = 'Home';
$routes['default_action'] = 'index';

//Admin
$routes['admin/logout'] = 'Login_Regis/Logout';

//Dashboard
$routes['admin/dashboard'] = 'admin/Dashboard/index';



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


// Role
$routes['admin/role'] = 'admin/RoleController/index';
$routes['admin/role/alert'] = 'admin/RoleController/alert';
//Create role
$routes['admin/role/create'] = 'admin/RoleController/create';
$routes['admin/role/store'] = 'admin/RoleController/store';
//Update role
$routes['admin/role/edit'] = 'admin/RoleController/edit';
$routes['admin/role/update'] = 'admin/RoleController/update';
//Delete role
$routes['admin/role/delete'] = 'admin/RoleController/delete';

// Role
$routes['admin/permission'] = 'admin/PermissionController/index';
$routes['admin/permission/alert'] = 'admin/PermissionController/alert';
//Create permission
$routes['admin/permission/create'] = 'admin/PermissionController/create';
$routes['admin/permission/store'] = 'admin/PermissionController/store';
//Update permission
$routes['admin/permission/edit'] = 'admin/PermissionController/edit';
$routes['admin/permission/update'] = 'admin/PermissionController/update';
//Delete permission
$routes['admin/permission/delete'] = 'admin/PermissionController/delete';

$routes['base-img-url'] = 'http://localhost:8080/the-coffee/';
