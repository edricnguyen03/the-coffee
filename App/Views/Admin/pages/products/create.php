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
                        Thêm sản phẩm vào danh sách
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="store" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input class="form-control" type="file" name="uploadfile" id="file-input" value="" />
                            <label for="image" class="form-label">Hình ảnh xem trước: </label>
                            <img src="../../resources/images/products/placeholder.png" id="img-preview" style="width: 250px; height: auto; margin: 10px 20px;">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Loại sản phẩm</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Cân nặng</label>
                            <input type="number" class="form-control" id="weight" name="weight" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <input type="text" class="form-control" id="content" name="content" required>
                        </div>
                        <div class=" mb-3">
                            <label for="description" class="form-label">Miêu tả</label>
                            <input type="text" class="form-control" id=" description" name="description" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Tạo sản phẩm</button>
                    </form>
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
    const input = document.getElementById('file-input');
    const image = document.getElementById('img-preview');

    input.addEventListener('change', (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            image.src = src;
        }
    });
</script>
</body>

</html>