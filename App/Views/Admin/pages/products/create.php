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
                    <span id="error"></span>
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
                    <form action="store" method="POST" onsubmit="return validate()" enctype="multipart/form-data">
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
                                    <?php if ($category->status == 1) { ?>
                                        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                    <?php } ?>
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
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Tạo sản phẩm</button>
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

    var txtProductName = document.getElementById('name');
    var txtPrice = document.getElementById('price');
    var txtWeight = document.getElementById('weight');
    var txtContent = document.getElementById('content');
    var txtDescription = document.getElementById('description');

    function validate() {
        <?php
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        ?>
        if (txtProductName.value == '' || txtPrice.value == '' || txtWeight.value == '' || txtContent.value == '' || txtDescription.value == '') {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Không để trống các ô</div>';
            return false;
        }
        if (!/^[a-zA-ZÀ-ỹ0-9\s]{4,40}$/.test(txtProductName.value.trim())) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Tên không hợp lệ từ 4 đến 40 kí tự chữ cái và số</div>';
            return false;
        }
        //giá chỉ từ 5000 đến 10000000 
        if (txtPrice.value < 5000 || txtPrice.value > 10000000) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Giá không hợp lệ từ 5000 đến 10000000đ</div>';
            return false;
        }
        if (!/^[0-9]{1,10}$/.test(txtPrice.value)) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Giá không hợp lệ từ 1 đến 10 kí tự số</div>';
            return false;
        }
        //cân nặng chỉ từ 1 đến 20000
        if (txtWeight.value < 1 || txtWeight.value > 20000) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Cân nặng không hợp lệ từ 1 đến 20000 gam</div>';
            return false;
        }
        if (!/^[0-9]{1,10}$/.test(txtWeight.value)) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Cân nặng không hợp lệ từ 1 đến 10 kí tự số</div>';
            return false;
        }
        if (!/^[a-zA-ZÀ-ỹ0-9\s]{4,40}$/.test(txtContent.value.trim())) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Nội dung không hợp lệ từ 4 đến 40 kí tự chữ cái và số</div>';
            return false;
        }
        if (!/^[a-zA-ZÀ-ỹ0-9\s]{4,40}$/.test(txtDescription.value.trim())) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Mô tả không hợp lệ từ 4 đến 40 kí tự chữ cái và số</div>';
            return false;
        }
        if (input.value == '') {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Hình ảnh không được để trống</div>';
            return false;
        }
        //tệp đã chọn không phải hình ảnh
        if (!/\.(jpe?g|png|gif|bmp)$/i.test(input.value)) {
            document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Hình ảnh không hợp lệ</div>';
            return false;
        }
        txtProductName.value = txtProductName.value.trim();
        txtPrice.value = txtPrice.value.trim();
        txtWeight.value = txtWeight.value.trim();
        txtContent.value = txtContent.value.trim();
        txtDescription.value = txtDescription.value.trim();
        input.value = input.value.trim();

        return true;
    }
</script>
</body>

</html>