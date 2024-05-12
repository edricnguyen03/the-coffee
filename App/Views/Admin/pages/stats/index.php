<?php
require_once('./App/Views/Admin/layouts/header.php');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            <h3>THỐNG KÊ</h3>
        </div>
        <div class="container-fluid">
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Thống kê sản phẩm bán chạy theo khoảng thời gian </h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <form method="GET">
                            <div class="form-group">
                                <p><label for="from">Từ ngày</label></p>
                                <p><input type="datetime-local" class="form-control" name="from" placeholder="Từ ngày" required> </p>
                            </div>
                            <div class="form-group">
                                <p><label for="to">Đến ngày</label></p>
                                <p><input type="datetime-local" class="form-control" name="to" placeholder="Đến ngày" required> </p>
                            </div>
                            <div class="form-group">
                                <p><button class="btn btn-primary" type="submit">Thống kê</button></p>
                            </div>
                        </form>
                    </div>

                    <div class="mb-3">


                        <?php
                        global $db;

                        if (!isset($_GET['from']) || !isset($_GET['to'])) {
                            echo "<div class='alert alert-danger text-center' role='alert'>Vui lòng chọn khoảng thời gian để thống kê</div>";
                        } else {
                            $from_date = $_GET['from'];
                            $to_date = $_GET['to'];


                            $query = $db->query("SELECT op.product_id, SUM(op.qty) AS quantity_sold
                                FROM orders o
                                JOIN order_products op ON o.id = op.order_id
                                WHERE o.create_at BETWEEN '$from_date' AND '$to_date'
                                GROUP BY op.product_id  
                                ORDER BY `quantity_sold` DESC
                                LIMIT 5");

                            $query->execute();
                            $data = $query->fetchAll();
                            if ($query->rowCount() > 0) {

                        ?>

                                <canvas id="myChart" width="800" height="800"></canvas>
                                <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: [
                                                <?php
                                                foreach ($data as $item) {

                                                    echo "'" . $item['product_id'] . "', ";
                                                }
                                                ?>
                                            ],
                                            datasets: [{
                                                label: 'Số sản phẩm bán được',
                                                data: [
                                                    <?php
                                                    foreach ($data as $item) {
                                                        echo $item['quantity_sold'] . ", ";
                                                    }
                                                    ?>
                                                ],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)'
                                                ],
                                                borderWidth: 1,
                                                hoverBorderWidth: 3,
                                                hoverBorderColor: '#000'
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Top sản phẩm bán chạy nhất',
                                                fontSize: 20
                                            },
                                            legend: {
                                                display: true,
                                                position: 'right',
                                                labels: {
                                                    fontColor: '#000'
                                                }
                                            },
                                            responsive: false,
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            layout: {
                                                padding: {
                                                    left: 50,
                                                    right: 0,
                                                    top: 0,
                                                    bottom: 0
                                                }
                                            }



                                        }
                                    });
                                </script>

                            <?php
                            }
                            ?>


                        <?php
                        }
                        ?>



                    </div>

                </div>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">
                    Thống kê các sản phẩm thuộc một loại/tất cả sản phẩm</h5>
            </div>

            <div class="card-body">

            </div>
        </div>

    </main>
    <?php
    require_once('./App/Views/Admin/layouts/footer.php');
    ?>

</div>
</div>
<script src="./../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./../../resources/js/script.js"></script>

</body>

</html>