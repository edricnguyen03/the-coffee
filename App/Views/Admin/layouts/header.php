<?php
require_once './App/Models/Auth.php';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ WEBSITE</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1c4a893c55.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./../../resources/css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="./../../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar sticky-top vh-100 ">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="../../">THE COFFEE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Danh sách chức năng
                    </li>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionDashboard) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#stat" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                Thống kê
                            </a>
                            <ul id="stat" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/stat/index" class="sidebar-link">
                                        Sản phẩm bán chạy
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/stat/income" class="sidebar-link">
                                        Doanh thu
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProduct) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-layer-group"></i>
                                Sản phẩm
                            </a>
                            <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/product/create" class="sidebar-link">Thêm sản phẩm</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/product/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionOrder) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#order" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                                Đơn hàng
                            </a>
                            <ul id="order" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/order/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionReceipt) == true) {
                    ?>
                        <!-- Receipt -->
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#receipt" data-bs-toggle="collapse" aria-expanded="false"><i class="fas fa-receipt pe-2"></i>
                                Phiếu nhập
                            </a>
                            <ul id="receipt" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/receipt/create" class="sidebar-link">Thêm phiếu nhập</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/receipt/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionUser) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                                Người dùng
                            </a>
                            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/user/create" class="sidebar-link">Thêm người dùng</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/the-coffee/admin/user/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionProvider) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#provider" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-truck pe-2"></i>
                                Nhà cung cấp
                            </a>
                            <ul id="provider" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="../provider/create" class="sidebar-link">Thêm nhà cung cấp</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../provider/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionCategory) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#category" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-tags pe-2"></i>
                                Danh mục
                            </a>
                            <ul id="category" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="../category/create" class="sidebar-link">Thêm danh mục</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../category/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionRole) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#role" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-user-shield"></i>
                                Vai trò
                            </a>
                            <ul id="role" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="../role/create" class="sidebar-link">Thêm vai trò</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../role/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionPermission) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#permission" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-handshake pe-2"></i>
                                Phân quyền
                            </a>
                            <ul id="permission" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <!-- <li class="sidebar-item">
                                <a href="../permission/create" class="sidebar-link">Thêm phân quyền</a>
                            </li> -->
                                <li class="sidebar-item">
                                    <a href="../permission/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <!-- <li class="sidebar-header">
                        Multi Level Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1" data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </aside>