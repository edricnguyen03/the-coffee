<?php
require_once('./App/Views/Admin/layouts/header.php');
?>

<style>
    .icon {
        padding: 5px;
    }

    .column_sort, .column_dif {
        text-decoration: none;
        color: white;
    }

    .column_dif:hover {
        cursor: no-drop;
    }
</style>

<div class="main">
    <nav class="navbar navbar-expand px-3 border-bottom" style="height:100px;">
        <button class="btn" id="sidebar-toggle" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                        <img src="../../resources/images/header-logo.png" class="avatar img-fluid rounded" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="../logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="content px-3 py-2">
        <div class="text-center my-3 py-2">
            <h3>QUẢN LÝ HÓA ĐƠN</h3>
        </div>
        <div class="container-fluid">
            <!-- Table Element -->
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Danh sách hóa đơn
                    </h5>
                </div>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <div class="card-body" id="receipt_table">
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên khách hàng" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><a class="column_sort" id="id" data-order="desc" href="#">ID<i class="fas fa-caret-up icon"></i></a></th>
                                <th scope="col"><a class="column_sort" id="name_receiver" data-order="desc" href="#">Tên Khách hàng</a></th>
                                <th scope="col"><a class="column_sort" id="total" data-order="desc" href="#">Số tiền</a></th>
                                <th scope="col"><a class="column_sort" id="payment_status" data-order="desc" href="#">Tình trạng thanh toán</a></th>
                                <th scope="col"><a class="column_sort" id="order_status" data-order="desc" href="#">Tình trạng đơn hàng</a></th>
                                <th scope="col"><a class="column_sort" id="create_at" data-order="desc" href="#">Ngày</a></th>
                                <th scope="col"><a class="column_dif">Hành động</a></th>
                            </tr>
                        </thead>
                        <?php
                        global $db;
                        // echo $_GET['search'];
                        if (isset($_GET['search'])) {
                            $filterValues = $_GET['search'];
                            $query = $db->query("SELECT * FROM orders WHERE CONCAT( name_receiver ,phone_receiver) LIKE '%$filterValues%'");
                            $query->execute();
                            $orders = $query->fetchAll();
                            if ($query->rowCount() > 0) {
                                foreach ($orders as $order) {
                        ?>

                                    <tr>
                                        <th scope="row"><?php echo $order['id']; ?></th>
                                        <td><?php echo $order['name_receiver']; ?></td>

                                        <td>
                                            <?php
                                            echo $order['total'];
                                            ?>
                                        </td>

                                        <td>
                                            <?php if ($order['payment_status'] == '1') { ?>
                                                <button class="btn btn-success" disabled>Đã thanh toán</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>Chưa thanh toán</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($order['order_status'] == 1) { ?>
                                                <span style="color: #0d6efd;">Đang chờ xử lý</span>
                                            <?php } elseif ($order['order_status'] == 2) { ?>
                                                <span style="color: #0d6efd;">Đã xác nhận và sẵn sàng giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 3) { ?>
                                                <span style="color: #0d6efd;">Đang giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 4) { ?>
                                                <span style="color: green;">Đã giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 5) { ?>
                                                <span style="color: red;">Đã hủy</span>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $order['create_at']; ?></td>
                                        <td>
                                            <a href="detail/<?php echo $order['id']; ?>" class="btn btn-primary">Chi tiết</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">KHÔNG TÌM THẤY ĐƠN HÀNG</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tbody>
                                <?php
                            } else {
                                $query = $db->query("SELECT * FROM orders");

                                $query->execute();
                                $orders = $query->fetchAll();

                                // echo '<pre>';
                                // print_r($orders);
                                // echo '<pre>'; ;

                                // $query_run = mysqli_query($conn, $query);
                                // $users = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                                foreach ($orders as $order) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $order['id']; ?></th>
                                        <td><?php echo $order['name_receiver']; ?></td>

                                        <td>
                                            <?php echo $order['total']; ?>
                                            <?php
                                            // $orderId_curr = $order['id'];
                                            // $query = $db->query("SELECT order_id, COUNT(*) AS order_count FROM order_products WHERE order_id = '$orderId_curr' GROUP BY order_id");
                                            // $query->execute();
                                            // $arr = $query->fetchAll();
                                            // if (!empty($arr)) {
                                            //     // Lấy giá trị của order_count từ mảng
                                            //     $orderCount = $arr[0]['order_count'];
                                            //     // Hiển thị giá trị order_count
                                            //     echo $orderCount;
                                            // }
                                            // echo '<pre>';
                                            // print_r($arr);
                                            // echo '<pre>'; ;;
                                            //
                                            ?>
                                        </td>

                                        <td>
                                            <?php if ($order['payment_status'] == '1') { ?>
                                                <button class="btn btn-success" disabled>Đã thanh toán</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>Chưa thanh toán</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($order['order_status'] == 1) { ?>
                                                <span style="color: #0d6efd;">Đang chờ xử lý</span>
                                            <?php } elseif ($order['order_status'] == 2) { ?>
                                                <span style="color: #0d6efd;">Đã xác nhận và sẵn sàng giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 3) { ?>
                                                <span style="color: #0d6efd;">Đang giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 4) { ?>
                                                <span style="color: green;">Đã giao hàng</span>
                                            <?php } elseif ($order['order_status'] == 5) { ?>
                                                <span style="color: red;">Đã hủy</span>
                                            <?php } ?>
                                            <!-- <select id="selectBox">
                                                <option value="0">
                                                    Đang chờ xử lý
                                                </option>
                                                <option value="1">
                                                    Đã xác nhận và sẵn sàng giao hàng
                                                </option>
                                                <option value="2">
                                                    Đang giao hàng
                                                </option>
                                                <option value="3">
                                                    Đã giao hàng
                                                </option>
                                                <option value="4">
                                                    Đã hủy
                                                </option>
                                            </select> -->
                                        </td>
                                        <td><?php echo $order['create_at']; ?></td>
                                        <td>
                                            <a href="detail/<?php echo $order['id']; ?>" class="btn btn-primary">Chi tiết</a>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <?php
    require_once('./App/Views/Admin/layouts/footer.php');
    ?>
</div>
</div>
<script src="./../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./../../resources/js/script.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.column_sort', function() {
            var column_id = $(this).attr("id");
            var order = $(this).data("order");
            var arrow = '';
            //glyphicon glyphicon-arrow-up  
            //glyphicon glyphicon-arrow-down  
            if (order == 'desc') {
                arrow = '<i class="fas fa-caret-down icon"></i>';
            } else {
                arrow = '<i class="fas fa-caret-up icon"></i>';
            }
            $.ajax({
                url: "store",
                method: "POST",
                data: {
                    column_id: column_id,
                    order: order
                },
                success: function(data) {
                    $('#receipt_table').html(data);
                    $('#' + column_id + '').append(arrow);
                }
            })
        });
    });
</script>

</html>