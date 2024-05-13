<?php

$routes['default_controller'] = 'Home';
$routes['default_action'] = 'index';

//Admin
$routes['admin/logout'] = 'Login_Regis/Logout';

//Dashboard
$routes['admin/dashboard'] = 'admin/Dashboard/index';

// Product
$routes['admin/product'] = 'admin/ProductController/index';
$routes['admin/product/search'] = 'admin/ProductController/search';
$routes['admin/product/alert'] = 'admin/ProductController/alert';
//Create product
$routes['admin/product/create'] = 'admin/ProductController/create';
$routes['admin/product/store'] = 'admin/ProductController/store';
//Update product
$routes['admin/product/edit'] = 'admin/ProductController/edit';
$routes['admin/product/update'] = 'admin/ProductController/update';
//Delete product
$routes['admin/product/delete'] = 'admin/ProductController/delete';

// Category
$routes['admin/category'] = 'admin/CategoryController/index';
$routes['admin/category/alert'] = 'admin/CategoryController/alert';
//Create Category
$routes['admin/category/create'] = 'admin/CategoryController/create';
$routes['admin/category/store'] = 'admin/CategoryController/store';
//Update Category
$routes['admin/category/edit'] = 'admin/CategoryController/edit';
$routes['admin/category/update'] = 'admin/CategoryController/update';
//Delete Category
$routes['admin/category/delete'] = 'admin/CategoryController/delete';


//Stats
$routes['admin/stat'] = 'admin/StatsController/index';
$routes['admin/stat/getTopProducts'] = 'admin/StatsController/getTopProducts';
$routes['admin/stat/income'] = 'admin/StatsController/income';
$routes['admin/stat/income/getIncomeCategories'] = 'admin/StatsController/getIncomeCategories';



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


// Category
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

//Order
$routes['admin/order'] = 'admin/OrderController/index';
$routes['admin/order/alert'] = 'admin/OrderController/alert';
$routes['admin/order/detail'] = 'admin/OrderController/edit';
$routes['admin/order/updateStatus'] = 'admin/OrderController/updateStatus'; // cái này của tiến viêt thêm nè


//Receipt
$routes['admin/receipt'] = 'admin/ReceiptController/index';
$routes['admin/receipt/alert'] = 'admin/ReceiptController/alert';
//Create Order
$routes['admin/receipt/create'] = 'admin/ReceiptController/create';
$routes['admin/receipt/store'] = 'admin/ReceiptController/store';
////Update User
$routes['admin/receipt/edit'] = 'admin/ReceiptController/edit';
$routes['admin/receipt/update'] = 'admin/ReceiptController/update';
//Delete User
$routes['admin/receipt/delete'] = 'admin/ReceiptController/delete';
