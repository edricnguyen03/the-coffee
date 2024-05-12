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
            <h3>QUẢN LÝ SẢN PHẨM</h3>
        </div>
        <div class="container-fluid">
            <!-- Table Element -->
            <div class="card border-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Danh sách sản phẩm
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form action="search" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên sản phẩm">
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
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <th scope="row"><?php echo $product->id; ?></th>
                                    <td><?php echo $product->name; ?></td>
                                    <td> <img src="../../resources/images/products/<?php echo $product->thumb_image; ?>" width="100"></td>
                                    <td><?php echo $product->price; ?></td>
                                    <td><?php echo $product->weight; ?></td>
                                    <td><?php foreach ($categories as $category) {
                                            if ($category->id == $product->category_id) {
                                                echo $category->name;
                                            }
                                        } ?></td>
                                    <td>
                                        <?php if ($product->status == '1') { ?>
                                            <button class="btn btn-success">Active</button>
                                        <?php } else { ?>
                                            <button class="btn btn-danger">Inactive</button>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $product->stock; ?></td>
                                    <td>
                                        <a href="edit/<?php echo $product->id; ?>" class="btn btn-primary">Edit</a>
                                        <a onclick="return confirm('Bạn có muốn xóa nhà cung cấp này không ?')" href="delete/<?php echo $product->id; ?>" class="btn btn-danger">Delete</a>

                                </tr>
                            <?php endforeach; ?>
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