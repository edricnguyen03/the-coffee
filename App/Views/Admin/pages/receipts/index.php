<?php
require_once('./App/Views/Admin/layouts/header.php');
?>
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
                <div class="card-body">
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên hoặc email">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
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
                                <th scope="col">Name</th>
                                <th scope="col">Provider</th>
                                <th scope="col">Total</th>
                                <th scope="col">create_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $db;
                            if (isset($_GET['search'])) {
                                $filterValues = $_GET['search'];
                                $query = $db->query("SELECT * FROM receipts WHERE CONCAT( name ) LIKE '%$filterValues%'");
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
                                            <a href="edit/<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                                            <a onclick="return confirm('Bạn có muốn xóa người dùng này không ?')" href="delete/<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
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
                                            <a href="edit/<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                                            <a onclick="return confirm('Bạn có muốn xóa người dùng này không ?')" href="delete/<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
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
</body>

</html>