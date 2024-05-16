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
    <link rel="stylesheet" href="./../../../resources/css/admin.css">
    <link href="./../../../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">THE COFFEE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Danh sách chức năng
                    </li>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], 6) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 3) == true) {
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
                                    <a href="../../product/" class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], 4) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                                Đơn hàng
                            </a>
                            <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="../../order/ " class="sidebar-link">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (Auth::checkPermission($_SESSION['login']['id'], 8) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 1) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 7) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 2) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 5) == true) {
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
                    if (Auth::checkPermission($_SESSION['login']['id'], 9) == true) {
                    ?>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#permission" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-handshake pe-2"></i>
                                Phân quyền
                            </a>
                            <ul id="permission" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="../../permission/create" class="sidebar-link">Thêm phân quyền</a>
                                </li>
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
                    <h3>CHI TIẾT HÓA ĐƠN</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách sản phẩm
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <!-- <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên hoặc email">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form> -->
                            </div>
                            <?php if (isset($_SESSION['error'])) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php echo $_SESSION['error']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success'])) : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                                <?php unset($_SESSION['success']); ?>
                            <?php endif; ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tiêu đề </th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!----------------------------------------Khuc nay cua tien ne------------------------------>
                                    <?php
                                    foreach ($orderProducts as $orderProduct) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $orderProduct['product_id']; ?></th>
                                            <td>
                                                <img src="/the-coffee/resources/images/products/<?php echo $orderProduct['thumb_image']; ?>" alt="" style="object-fit: cover; width: 30%;">
                                            </td>
                                            <td><?php echo $orderProduct['product_name']; ?></td>
                                            <td><?php echo $orderProduct['product_price']; ?></td>
                                            <td><?php echo $orderProduct['qty']; ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <div class="order-details"></div>
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>Thông tin nhận hàng</h2>
                                        <div class="info">
                                            <p><strong>Mã tài khoản:</strong> <?php echo $order->user_id; ?></p>
                                            <p><strong>Tên người nhận:</strong> <?php echo $order->name_receiver; ?></p>
                                            <p><strong>Địa chỉ người nhận:</strong> <?php echo $order->address_receiver; ?></p>
                                            <p><strong>Số điện thoại người nhận:</strong> <?php echo $order->phone_receiver; ?></p>
                                            <p><strong>Tổng tiền:</strong> <?php echo $order->total; ?></p>
                                            <p><strong>Trạng thái thanh toán:</strong> <?php echo ($order->payment_status == '1') ? 'Đã thanh toán' : 'Chưa thanh toán'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h2>Trạng thái đơn hàng</h2>
                                        <div class="status">
                                            <?php if ($order->order_status == '4') {
                                                echo '<p class="order-status icon "><strong style="padding-right:5px">>Trạng thái đơn hàng:</strong><span style="color: green;">Đã giao hàng</span></p>';
                                            } else if ($order->order_status == '5') {
                                                echo '<p class="order-status icon"><strong style="padding-right:5px">Trạng thái đơn hàng:</strong><span style="color: red;">Đã hủy</span></p>';
                                            } else {
                                                echo '<p class="order-status"><strong>Trạng thái đơn hàng:</strong></p>';
                                                echo '<select id="cbbTrangThaiDonHang" class="form-select">';
                                                echo '<option value="1" ' . ($order->order_status == '1' ? 'selected' : '') . '>Đang chờ xử lý</option>';
                                                echo '<option value="2" ' . ($order->order_status == '2' ? 'selected' : '') . '>Đã xác nhận và sẵn sàng giao hàng</option>';
                                                echo '<option value="3" ' . ($order->order_status == '3' ? 'selected' : '') . '>Đang giao hàng</option>';
                                                echo '<option value="4" ' . ($order->order_status == '4' ? 'selected' : '') . '>Đã giao hàng</option>';
                                                echo '<option value="5" ' . ($order->order_status == '5' ? 'selected' : '') . '>Đã hủy</option>';
                                                echo '</select>';
                                                echo '<button id="btn-LuuTrangThaiDonHang" class="btn btn-success mt-3">Lưu</button>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            require_once('./App/Views/Admin/layouts/footer.php');
            ?>
        </div>

        <!-- Modal -->

    </div>
    </div>
    <script src="./../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../../../resources/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
<script>
    addEventListener('DOMContentLoaded', function() {
        const btnLuuTrangThaiDonHang = document.getElementById('btn-LuuTrangThaiDonHang');
        const cbbTrangThaiDonHang = document.getElementById('cbbTrangThaiDonHang');
        const orderId = <?php echo $order->id; ?>;
        btnLuuTrangThaiDonHang.addEventListener('click', function() {
            const orderStatus = cbbTrangThaiDonHang.value;
            const data = {
                orderId: orderId,
                orderStatus: orderStatus
            };
            // Use SweetAlert to confirm the status change
            Swal.fire({
                title: 'Xác nhận đổi trạng thái đơn hàng',
                text: 'Đơn hàng đã hủy hoặc giao thành công sẽ không thể đổi nữa ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/the-coffee/admin/order/updateStatus',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            if (response == true) {
                                Swal.fire('Success', 'Cập nhật trạng thái đơn hàng thành công', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', 'Cập nhật trạng thái đơn hàng thất bại\n' + response, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', 'Cập nhật trạng thái đơn hàng thất bại\n' + error, 'error');
                        }
                    });
                }
            });
        });
    });
</script>