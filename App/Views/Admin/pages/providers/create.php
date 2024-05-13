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
                            <form action="store" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" id="description" name="description" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Tạo mới nhà cung cấp</button>
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
        </body>

        </html>