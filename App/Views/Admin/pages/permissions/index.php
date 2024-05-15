<?php

?>
<?php
require_once('./App/Views/Admin/layouts/header.php');
?>
<div class="main">
    <nav class="navbar navbar-expand px-3 border-bottom">
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
            <h3>QUẢN LÝ QUYỀN</h3>
        </div>
        <div class="container-fluid">
            <!-- Table Element -->
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Danh sách quyền
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên quyền">
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
                                <th scope="col">ID</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $db;
                            if (isset($_GET['search'])) {
                                $filterValues = $_GET['search'];
                                $query = $db->query("SELECT * FROM permissions WHERE CONCAT( name ) LIKE '%$filterValues%'");
                                $query->execute();
                                $permissions = $query->fetchAll();
                                if ($query->rowCount() > 0) {
                                    foreach ($permissions as $permission) {
                            ?>

                                        <tr>
                                            <th scope="row"><?php echo $permission['id']; ?></th>
                                            <td><?php echo $permission['name']; ?></td>
                                            <td><?php echo $permission['description']; ?></td>
                                            <td>
                                                <a href="edit/<?php echo $permission['id']; ?>" class="btn btn-primary">Sửa</a>
                                                <a onclick="return confirm('Bạn có muốn xóa vai trò này không ?')" href="delete/<?php echo $permission['id']; ?>" class="btn btn-danger">Xóa</a>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">KHÔNG TÌM THẤY QUYỀN</td>
                                    </tr>
                                <?php
                                }
                            } else {
                                $query = $db->query("SELECT * FROM permissions");
                                $query->execute();
                                $permissions = $query->fetchAll();
                                foreach ($permissions as $permission) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $permission['id']; ?></th>
                                        <td><?php echo $permission['name']; ?></td>
                                        <td><?php echo $permission['description']; ?></td>
                                        <td>

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