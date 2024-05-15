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
            <h3>QUẢN LÝ DANH MỤC</h3>
        </div>
        <div class="container-fluid">
            <!-- Table Element -->
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Danh sách danh mục
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
                                <th scope="col">Tên Danh Mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $db;
                            if (isset($_GET['search'])) {
                                $filterValues = $_GET['search'];
                                $query = $db->query("SELECT * FROM categories WHERE CONCAT( name ) LIKE '%$filterValues%'");
                                $query->execute();
                                $categories = $query->fetchAll();
                                if ($query->rowCount() > 0) {
                                    foreach ($categories as $category) {
                            ?>

                                        <tr>
                                            <th scope="row"><?php echo $category['id']; ?></th>
                                            <td><?php echo $category['name']; ?></td>
                                            <td>
                                                <?php if ($category['status'] == '1') { ?>
                                                    <button class="btn btn-success" disabled>Active</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger" disabled>Inactive</button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="edit/<?php echo $category['id']; ?>" class="btn btn-primary">Sửa</a>
                                                <a onclick="return confirm('Bạn có muốn xóa danh mục này không ?')" href="delete/<?php echo $category['id']; ?>" class="btn btn-danger">Xóa</a>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">KHÔNG TÌM THẤY DANH MỤC</td>
                                    </tr>
                                <?php
                                }
                            } else {
                                $query = $db->query("SELECT * FROM categories");
                                $query->execute();
                                $categories = $query->fetchAll();
                                foreach ($categories as $category) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $category['id']; ?></th>
                                        <td><?php echo $category['name']; ?></td>
                                        <td>
                                            <?php if ($category['status'] == '1') { ?>
                                                <button class="btn btn-success" disabled>Active</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>Inactive</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit/<?php echo $category['id']; ?>" class="btn btn-primary">Sửa</a>
                                            <a onclick="return confirm('Bạn có muốn xóa danh mục này không ?')" href="delete/<?php echo $category['id']; ?>" class="btn btn-danger">Xóa</a>
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