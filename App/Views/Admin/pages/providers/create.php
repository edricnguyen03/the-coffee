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
                    <h3>QUẢN LÝ NHÀ CUNG CẤP</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Thêm nhà cung cấp vào danh sách
                            </h5>
                        </div>
                        <div class="card-body">
                            <span id="error"></span>
                            <?php if (isset($_SESSION['error'])) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php echo $_SESSION['error']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($success)) : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>
                            <form action="store" onsubmit="return validate()" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" id="description" value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?>" name="description" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Tạo nhà cung cấp</button>
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
            function validate() {
                let name = document.getElementById('name').value.trim();
                let description = document.getElementById('description').value.trim();
                if (name == '' || description == '') {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Không để trống các ô</div>';
                    return false;
                }
                if (!/^[a-zA-ZÀ-ỹ0-9\s]{4,40}$/.test(name.trim())) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Tên không hợp lệ từ 4 đến 40 kí tự chữ cái và số</div>';
                    return false;
                }
                if (!/^[a-zA-ZÀ-ỹ0-9\s]{4,40}$/.test(description.trim())) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Mô tả không hợp lệ từ 4 đến 40 kí tự chữ cái và số</div>';
                    return false;
                }
                document.getElementById('name').value = document.getElementById('name').value.trim();
                document.getElementById('description').value = document.getElementById('description').value.trim();
                return true;
            }
        </script>
        </body>

        </html>