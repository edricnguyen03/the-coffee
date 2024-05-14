<?php
require_once './App/Models/Auth.php';
// Start the session
// Check if the user is logged in
if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
    // If not, display an alert message and redirect them to the login page
    // header('Location: alert');
    header('Location: ../../../Login_Regis/logout');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ WEBSITE</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1c4a893c55.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./../../../resources/css/admin.css">
    <link href="./../../../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="../../../">THE COFFEE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Danh sách chức năng
                    </li>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 6) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#stat" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Thống kê
                        </a>
                        <ul id="stat" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../stat/" class="sidebar-link">
                                    Sản phẩm bán chạy
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../stat/income" class="sidebar-link">
                                    Doanh thu
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 3) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Sản phẩm
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../product/create" class="sidebar-link">Thêm sản phẩm</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../product/ " class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 4) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Đơn hàng
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../order/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 8) == true){
                    ?>
                    <!-- Receipt -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#receipt" data-bs-toggle="collapse" aria-expanded="false"><i class="fas fa-receipt"></i>
                            Phiếu nhập
                        </a>
                        <ul id="receipt" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../receipt/create" class="sidebar-link">Thêm phiếu nhập</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../receipt/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 1) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Người dùng
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../user/create" class="sidebar-link">Thêm người dùng</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../user/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 7) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#provider" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-truck pe-2"></i>
                            Nhà cung cấp
                        </a>
                        <ul id="provider" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../provider/create" class="sidebar-link">Thêm nhà cung cấp</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../provider/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 2) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#category" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-tags pe-2"></i>
                            Danh mục
                        </a>
                        <ul id="category" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../category/create" class="sidebar-link">Thêm danh mục</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../category/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 5) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#role" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-user-shield"></i>
                            Vai trò
                        </a>
                        <ul id="role" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../role/create" class="sidebar-link">Thêm vai trò</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../role/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                     if(Auth::checkPermission($_SESSION['login']['id'], 9) == true){
                    ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#permission" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-handshake pe-2"></i>
                            Phân quyền
                        </a>
                        <ul id="permission" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../permission/" class="sidebar-link">Danh sách</a>
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
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="./../../../resources/images/header-logo.png" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="../../logout" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="text-center my-3 py-2">
                    <h3>QUẢN LÝ NHÀ CUNG CẤP</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title my-3 py-2">
                                Chinh sửa nhà cung cấp
                            </h5>
                        </div>
                        <div class="card-body">
                            <span id="error"></span>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success'])) : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                                <?php unset($_SESSION['success']); ?>
                            <?php endif; ?>
                            <form action="../update/<?php echo $role['id'] ?>" id="form1"  method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên vai trò</label>
                                    <input value="<?php echo $role['name'] ?>" type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class=" mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input value="<?php echo $role['description'] ?>" type="text" class="form-control" id="description" name="description" required>
                                </div>
                                <div class="mb-3">
                                    <label for="permission" class="form-label">Quyền</label>
                                    <?php
                                    foreach ($permissions as $permission) :  ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $permission['id']; ?>" id="permission<?php echo $permission['id']; ?>" name="permissions[]" <?php echo in_array((int)$permission['id'], array_map('intval', $rolePermissions)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="permission<?php echo $permission['id']; ?>">
                                                <?php echo $permission['name']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" id="submit1" name="submit1" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <?php
            require_once('./App/Views/Admin/layouts/footer.php');
            ?>
        </div>
    </div>
    <script src="./../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../../../resources/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('submit1').addEventListener('click', function() {
                if (validate()) {
                    document.getElementById('form1').submit();
                }
            });
            function validate() {
                let name = document.getElementById('name').value.trim();
                let description = document.getElementById('description').value.trim();
                if(name == '' || description == '') {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Không để trống các ô</div>';
                    return false;
                }
                if (!/^[a-zA-ZáàảãạăắằặẳẵâầấẩẫậèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđĐ\s]+$/.test(name)) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Tên không hợp lệ</div>';
                    return false;
                }
                if (!/^[a-zA-ZáàảãạăắằặẳẵâầấẩẫậèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđĐ\s]+$/.test(description)) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Mô tả không hợp lệ</div>';
                    return false;
                }
                return true;
            }
        });
        </script>
</body>

</html>