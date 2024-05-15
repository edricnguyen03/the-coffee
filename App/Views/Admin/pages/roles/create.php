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
                    <h3>QUẢN LÝ VAI TRÒ</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Thêm vai trò vào danh sách
                            </h5>
                        </div>
                        <div class="card-body">
                            <span id="error"></span>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($success)) : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>
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
                            <form action="store" onsubmit="return validate()" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên chức vụ</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" id="description" name="description" required>
                                </div>
                                <div class="mb-3">
                                    <label for="permission" class="form-label">Quyền</label>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $permission['id']; ?>" id="permission<?php echo $permission['id']; ?>" name="permissions[]">
                                            <label class="form-check-label" for="permission<?php echo $permission['id']; ?>">
                                                <?php echo $permission['description']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Tạo mới chức vụ</button>
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
                if(name == '' || description == '') {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Không để trống các ô</div>';
                    return false;
                }
                if (!/^[a-zA-ZÀ-ỹ\s]{4,40}$/.test(name)) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Tên không hợp lệ gồm 4 đến 40 kí tự chữ</div>';
                    return false;
                }
                if (!/^[a-zA-ZÀ-ỹ\s]{4,40}$/.test(description)) {
                    document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Mô tả không hợp lệ gồm 4 đến 40 kí tự chữ</div>';
                    return false;
                }
                document.getElementById('name').value = document.getElementById('name').value.trim();
                document.getElementById('description').value = document.getElementById('description').value.trim();
                return true;
            }
        </script>
        </body>

        </html>