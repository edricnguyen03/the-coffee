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
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">
                    Thống kê tình hình kinh doanh</h5>
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
                            <p><button class="btn btn-primary" id="btnThongKe" type="button">Thống kê</button></p>
                        </div>
                    </form>
                </div>
                <div class="mb-3" id="content">
                    <canvas id="chart" width="100%" height="50%"></canvas>

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
    document.addEventListener("DOMContentLoaded", function() {
        var btnThongKe = document.getElementById('btnThongKe');
        var content = document.getElementById('content');
        var myChart = null;

        btnThongKe.addEventListener('click', function() {
            if (document.querySelector('input[name="from"]').value == '' || document.querySelector('input[name="to"]').value == '') {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Vui lòng chọn khoảng thời gian để thống kê</div>';
                return;
            }

            var fromDate = document.querySelector('input[name="from"]').value;
            var toDate = document.querySelector('input[name="to"]').value;
            if (fromDate > toDate) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Từ ngày phải nhỏ hơn hoặc bằng Đến ngày</div>';
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
            //đến ngày không được ở tương lai
            if (toDate > new Date().toISOString().slice(0, 16)) {
                content.innerHTML = '<div class="alert alert-danger text-center" role="alert">Đến ngày không được lớn hơn ngày hiện tại</div>';
                return;
            }

            $.ajax({
                url: '/the-coffee/admin/stat/income/getIncomeCategories',
                type: 'POST',
                data: {
                    fromDate: fromDate,
                    toDate: toDate
                },
                success: function(response) {
                    let mainTotal = 0;
                    let mainQty = 0;
                    let html = '<table class="table">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Danh mục</th>' +
                        '<th>Số lượng bán</th>' +
                        '<th>Tổng doanh thu</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    JSON.parse(response).forEach(item => {
                        html += '<tr>' +
                            '<td>' + item['name'] + '</td>' +
                            '<td>' + item['qty'] + '</td>' +
                            '<td>' + item['total'] + '</td>' +
                            '</tr>';
                        mainTotal += parseInt(item['total']);
                        mainQty += parseInt(item['qty']);
                    });
                    html += '<tr>' +
                        '<td>Tất cả</td>' +
                        '<td>' + mainQty + '</td>' +
                        '<td>' + mainTotal + '</td>' +
                        '</tbody></table>';

                    //tạo thẻ canvas để vẽ biểu đồ
                    var chartTag = '<canvas id="chart" width="100%" height="50%"></canvas>';
                    //innerHTML 2 lần

                    content.innerHTML = html;
                    content.innerHTML += chartTag;
                    drawChart(JSON.parse(response));
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        function drawChart($data) {
            var ctx = document.getElementById('chart').getContext('2d');

            // Nếu biểu đồ đã tồn tại, hủy nó trước khi vẽ biểu đồ mới
            if (myChart !== null) {
                myChart.destroy();
            }

            // Số cột được truyền vào
            var numOfColumns = $data.length;

            // Tạo một mảng các nhãn cho các cột
            var labels = [];
            $data.forEach(item => {
                labels.push(item['name']);
            });

            // Tạo một mảng các giá trị cho các cột
            var value = [];
            $data.forEach(item => {
                value.push(item['total']);
            });

            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu sản phẩm theo danh mục',
                        data: value, // Dữ liệu cột
                        backgroundColor: 'rgba(0, 128, 0, 0.2)',
                        borderColor: 'rgba(0, 128, 0, 1)',
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