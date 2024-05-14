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
                                <p><button class="btn btn-primary" type="button" id="btnThongKe">Thống kê</button></p>
                            </div>
                        </form>
                    </div>

                    <div class="mb-3" id="content">

                    </div>



                </div>
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

<script>
    // vẽ biểu đồ

    document.addEventListener('DOMContentLoaded', function() {

        var btnThongKe = document.getElementById('btnThongKe');
        var content = document.getElementById('content');
        var chart = null;
        var chartBox = document.getElementById('chartBox');

        //them su kien cho nut thong ke
        btnThongKe.addEventListener('click', function() {

            //kiem tra xem nguoi dung da chon khoang thoi gian chua
            if (document.querySelector('input[name="from"]').value == '' || document.querySelector('input[name="to"]').value == '') {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Vui lòng chọn khoảng thời gian để thống kê</div>';
                return;
            }

            //lay du lieu cua 2 ngay
            var fromDate = document.querySelector('input[name="from"]').value;
            var toDate = document.querySelector('input[name="to"]').value;

            //kiem tra tu ngay phai nho hon hoac bang den ngay
            if (fromDate > toDate) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Từ ngày phải nhỏ hơn hoặc bằng đến ngày</div>';
                return;
            }

            // cắt chuỗi đại diện cho thời gian từ vị trí 0 đến vị trí 15, bao gồm năm, tháng, ngày, giờ và phút, để lấy thời gian hiện tại ở dạng "YYYY-MM-DDThh:mm
            if (fromDate > new Date().toISOString().slice(0, 16)) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Từ ngày không được lớn hơn ngày hiện tại</div>';
                return;
            }

            //từ ngày không được quá 20 năm
            if (fromDate < new Date(new Date().getFullYear() - 20, new Date().getMonth(), new Date().getDate()).toISOString().slice(0, 16)) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Từ ngày không được nhỏ hơn 20 năm trước</div>';
                return;
            }

            //đến ngày không được là ngày tương lai
            if (toDate > new Date().toISOString().slice(0, 16)) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Đến ngày không được lớn hơn ngày hiện tại</div>';
                return;
            }

            $.ajax({
                url: '/the-coffee/admin/stat/getTopProducts',
                type: 'POST',
                data: {
                    from: fromDate,
                    to: toDate
                },
                success: function(response) {
                    let index = 0;
                    let maxSold = -1;
                    let maxSoldName = '';
                    let secondSold = -1;
                    let secondSoldName = '';
                    let html = '<table class="table">' +
                        '<thead>' +
                        '<tr>' +
                        '<th scope="col">STT</th>' +
                        '<th scope="col">Tên sản phẩm</th>' +
                        '<th scope="col">Số lượng bán được</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    JSON.parse(response).forEach((item, index = 0) => {

                        html += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + item['name'] + '</td>' +
                            '<td>' + item['quantity_sold'] + '</td>' +
                            '</tr>';
                        if (parseInt(item['quantity_sold']) > maxSold) {
                            secondSold = maxSold;
                            secondSoldName = maxSoldName;
                            maxSold = parseInt(item['quantity_sold']);
                            maxSoldName = item['name'];
                        } else if (parseInt(item['quantity_sold']) > secondSold) {
                            secondSold = parseInt(item['quantity_sold']);
                            secondSoldName = item['name'];
                        }
                    });

                    // tạo thẻ canvas để vẽ biểu đồ
                    var chartTag = '<div class="mb-3" style="width:60%;" id="chartBox">' + '<canvas id="myChart" width="600px" height = "600px"></canvas></div>';


                    //innerHTML 2 lần
                    let topSale = '<div class="alert alert-success text-center" role="alert">Sản phẩm bán chạy nhất: ' + maxSoldName + ' với số lượng bán được là ' + maxSold + '</div>';
                    topSale += '<div class="alert alert-success text-center" role="alert">Sản phẩm bán chạy thứ 2: ' + secondSoldName + ' với số lượng bán được là ' + secondSold + '</div>';
                    content.innerHTML = topSale;
                    content.innerHTML += html;
                    //content.innerHTML += chartTag;
                    content.innerHTML += chartTag;
                    drawChart(JSON.parse(response));
                }

            });

        });

        function drawChart($data) {
            var ctx = document.getElementById('myChart').getContext('2d');

            // Nếu biểu đồ đã tồn tại, hủy nó trước khi vẽ biểu đồ mới
            if (chart !== null) {
                chart.destroy();
            }

            // Lấy số lượng cột của data
            var numOfColumns = $data.length;

            // tạo mảng các nhãn cho các cột
            var labels = [];
            $data.forEach((item) => {
                labels.push(item['name']);
            });

            //tạo mảng giá trị cho các cột

            var value = [];
            $data.forEach((item) => {
                value.push(item['quantity_sold']);
            });

            // vẽ biểu đồ
            chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels, // tên các cột
                    datasets: [{
                        label: 'Số lượng sản phẩm bán được',
                        data: value, // giá trị của các cột
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>

</body>

</html>