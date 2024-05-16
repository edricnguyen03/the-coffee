<?php
require_once('./App/Views/Admin/layouts/header.php');



?>
<style>
.icon {
    padding: 5px;
}

.column_sort {
    text-decoration: none;
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
            <h3>QUẢN LÝ NHẬP HÀNG</h3>
        </div>
        <div class="container-fluid">
            <!-- Table Element -->
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Danh sách đơn nhập hàng
                    </h5>
                </div>
                <div class="card-body" id="receipt_table">

                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên đơn nhập hàng" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
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

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><a class="column_sort" id="id" data-order="desc" href="#">ID<i class="fas fa-caret-up icon"></i></a></th>
                                <th scope="col"><a class="column_sort" id="name" data-order="desc" href="#">Tên phiếu nhập</a></th>
                                <th scope="col"><a class="column_sort" id="provider_id" data-order="desc" href="#">Nhà cung cấp</a></th>
                                <th scope="col"><a class="column_sort" id="total" data-order="desc" href="#">Tổng số lượng</a></th>
                                <th scope="col"><a class="column_sort" id="create_at" data-order="desc" href="#">Thời gian tạo</a></th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <?php
                            global $db;
                            if (isset($_GET['search'])) {
                                $filterValues = $_GET['search'];
                                // $connect = mysqli_connect('localhost', 'root', '', 'testing');  
                                $query = "SELECT * FROM tbl_employee ORDER BY id DESC";  
                                // $result = mysqli_query($connect, $query);
                                $query = $db->query("SELECT * FROM receipts WHERE CONCAT( id , name ) LIKE '%$filterValues%'");
                                $query->execute();
                                $receipts = $query->fetchAll();
                                if ($query->rowCount() > 0) {
                                    foreach ($receipts as $receipt) {
                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $receipt['id']; ?></th>
                                            <td><?php echo $receipt['name']; ?></td>
                                            <td><?php echo $receipt['provider_id']; ?></td>
                                            <td><?php echo $receipt['total']; ?></td>
                                            <td><?php echo $receipt['create_at']; ?></td>
                                            <td>
                                            <a href="detail/<?php echo $receipt['id']; ?>" class="btn btn-primary">Hiển thị</a>
                                        </tr>
                                    <?php
                                    }
                                } else {    
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">KHÔNG TÌM THẤY NGƯỜI DÙNG</td>
                                </tr>
                                <?php
                                }
                                ?>
                        <tbody> 
                        <?php
                            } else {
                                $query = $db->query("SELECT * FROM receipts");
                                $query->execute();
                                $receipts = $query->fetchAll();
                                // $query_run = mysqli_query($conn, $query);
                                // $users = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                                foreach ($receipts as $receipt) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $receipt['id']; ?></th>
                                        <td><?php echo $receipt['name']; ?></td>
                                        <td><?php echo $receipt['provider_id']; ?></td>
                                        <td><?php echo $receipt['total']; ?></td>
                                        <td><?php echo $receipt['create_at']; ?></td>
                                        <td>
                                            <a href="detail/<?php echo $receipt['id']; ?>" class="btn btn-primary">Hiển thị</a>
                                            <!-- <a onclick="return confirm('Bạn có muốn xóa đơn nhập hàng này không ?')" href="delete/<?php //echo $receipt['id']; 
                                                                                                                                        ?>" class="btn btn-danger">Xóa</a> -->
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
    $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_id = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = '';  
           //glyphicon glyphicon-arrow-up  
           //glyphicon glyphicon-arrow-down  
           if(order == 'desc')  
           {  
                arrow = '<i class="fas fa-caret-down icon"></i>';  
           }  
           else  
           {  
                arrow = '<i class="fas fa-caret-up icon"></i>';  
           }  
           $.ajax({  
                url:"store",  
                method:"POST",  
                data:{column_id:column_id, order:order},  
                success:function(data)  
                {  
                     $('#receipt_table').html(data);  
                     $('#'+column_id+'').append(arrow);  
                }  
           })  
      });  
 });  
    
</script> 

</html>