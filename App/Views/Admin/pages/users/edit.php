<?php
// Start the session
// Check if the user is logged in
if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
    // If not, display an alert message and redirect them to the login page
    // header('Location: alert');
    header('Location: ../../../Login_Regis/logout');
    exit;
} else if ($_SESSION['login']['id'] != 1) {
    // If not, redirect them to the login page
    header('Location: ../alert');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./../../../resources/css/admin.css">
    <link href="./../../../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar sticky-top vh-100">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">THE COFFEE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Danh sách chức năng
                    </li>
                    <li class="sidebar-item">
                        <a href="../../dashboard/" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Thống kê
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Sản phẩm
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Thêm sản phẩm</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Đơn hàng
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
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
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#provider" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-handshake pe-2"></i>
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
                    <li class="sidebar-header">
                    <li class="sidebar-header">
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
                    </li>
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
                    <h3>QUẢN LÝ NGƯỜI DÙNG</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title my-3 py-2">
                                Chinh sửa người dùng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger text-center " style="display: none;" role="alert">
                            </div>
                            <div class="alert alert-success text-center" style="display: none;" role="alert">
                            </div>
                            <form id="edit_user" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="<?php echo $user['name'] ?>" type="text" class="form-control" id="name" name="name" required>
                                    <span class="error" id="name_error" style="color: red;"></span>
                                </div>
                                <div class=" mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="<?php echo $user['email'] ?>" type="email" class="form-control" id="email" name="email" required>
                                    <span class="error" id="email_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="error" id="password_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <span class="error" id="confirm_password_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select value="<?php echo $user['status'] ?>" class="form-select" id="status" name="status" required>
                                        <option value="1" <?php echo $user['status'] == 1 ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo $user['status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role ID</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="1" <?php echo $user['role_id'] == 1 ? 'selected' : ''; ?>>Super Admin</option>
                                        <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>User</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
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
    <script type="text/javascript">
        // Edit user
        $(document).ready(function() {
            $('#edit_user').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var params = new URLSearchParams(formData);

                var name = params.get('name');
                var email = params.get('email');
                var password = params.get('password');
                var confirm_password = params.get('confirm_password');
                var status = params.get('status');
                var role_id = params.get('role_id');
                var userId = <?php echo $user['id']; ?>;

                $('.error').text('');


                if (password != confirm_password) {
                    $('#confirm_password_error').text('Mật khẩu không trùng khớp').css('display', 'block');
                    return;
                } else if (name.length > 40 || name.length < 4 || /[^A-Za-z ]/.test(name)) {
                    $('#name_error').text('Tên không hợp lệ - Tối thiểu 4 ký tự, tối đa 40  ký tự và không chứa ký tự đặc biệt').css('display', 'block');
                    return;
                } else if (password.length < 4 || password.length > 10) {
                    $('#password_error').text('Mật khẩu không hợp lệ - Tối thiểu 6 ký tự và tối đa 20 ký tự').css('display', 'block');
                    return;
                } else if (email.length > 50 || !/^\S+@\S+\.\S+$/.test(email)) {
                    $('#email_error').text('Email không hợp lệ - Tối đa 50 ký tự và phải đúng định dạng email').css('display', 'block');
                    return;
                } else {
                    $.ajax({
                        url: '../check_email',
                        type: 'POST',
                        data: {
                            email: email,
                            id: userId,
                        },
                        dataType: 'json',
                    }).done(function(response) {
                        if (response.email_exists) {
                            $('#email_error').text('Email đã được sử dụng').css('display', 'block');
                        } else {
                            $.ajax({
                                url: '../update/' + <?php echo $user['id']; ?>,
                                type: 'POST',
                                data: {
                                    name: name,
                                    email: email,
                                    password: password,
                                    status: status,
                                    role_id: role_id
                                },
                                // ...
                            });
                            $.ajax({
                                url: '../update/' + <?php echo $user['id']; ?>,
                                type: 'POST',
                                data: {
                                    name: name,
                                    email: email,
                                    password: password,
                                    status: status,
                                    role_id: role_id
                                },
                            }).done(function(response) {
                                $('.alert-success').text('Chỉnh sửa người dùng thành công').css('display', 'block');
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                                $('.alert-danger').text('Chỉnh sửa người dùng thất bại').css('display', 'block');
                            });
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                    });
                }
            });
        });
    </script>

</body>

</html>