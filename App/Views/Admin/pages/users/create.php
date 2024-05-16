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
                    <h3>QUẢN LÝ NGƯỜI DÙNG</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Thêm người dùng vào danh sách
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger text-center " style="display: none;" role="alert">
                            </div>
                            <div class="alert alert-success text-center" style="display: none;" role="alert">
                            </div>
                            <form id="create_user" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên tối thiểu 4 ký tự, tối đa 40 ký tự và không chứa ký tự đặc biệt " required>
                                    <span class="error" id="name_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com " required>
                                    <span class="error" id="email_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Tối thiểu 4 ký tự và tối đa 10 ký tự" required>
                                    <span class="error" id="password_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <span class="error" id="confirm_password_error" style="color: red;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="role_id" class="form-label">Chức vụ</label>
                                    <select class="form-select" id="role_id" name=" role_id" required>
                                        <option value="1">Super Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div> -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Vai trò</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Tạo mới người dùng</button>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#create_user').submit(function(e) {
                    e.preventDefault();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var confirm_password = $('#confirm_password').val();
                    var status = $('#status').val();
                    var role_id = $('#role_id').val();
                    // console.log(role_id);
                    $('.error').text('');

                    if (password != confirm_password) {
                        $('#confirm_password_error').text('Mật khẩu không trùng khớp').css('display', 'block');
                        return;
                    } else if (name === '') {
                        $('#name_error').text('Tên không được để trống').css('display', 'block');
                        return;
                    } else if (!/^[a-zA-ZÀ-ỹ\s]{4,40}$/.test(name)) {

                        $('#name_error').text('Tên không hợp lệ - Tối thiểu 4 ký tự, tối đa 40 ký tự và không chứa ký tự đặc biệt').css('display', 'block');
                        return;
                    } else if (!/^[a-zA-Z0-9]{4,10}$/.test(password)) {
                        $('#password_error').text('Mật khẩu không hợp lệ - Tối thiểu 4 ký tự, tối đa 10 ký tự và không được có khoảng trắng').css('display', 'block');
                        return;
                    } else if (email.length > 50 || !/^\S+@\S+\.\S+$/.test(email)) {
                        $('#email_error').text('Email không hợp lệ - Tối đa 50 ký tự và phải đúng định dạng email').css('display', 'block');
                        return;
                    } else {
                        // Check if email is already in use
                        $.ajax({
                                url: 'check_email',
                                type: 'POST',
                                data: {
                                    email: email
                                },
                                dataType: 'json',
                            }).done(function(response) {
                                if (response.email_exists) {
                                    $('#email_error').text('Email đã được sử dụng').css('display', 'block');
                                } else {
                                    // If email is not in use, submit the form data
                                    $.ajax({
                                        url: 'store',
                                        type: 'POST',
                                        data: {
                                            name: name.trim(),
                                            email: email.trim(),
                                            password: password.trim(),
                                            confirm_password: confirm_password.trim(),
                                            status: status,
                                            role_id: role_id,
                                        },

                                    }).done(function(response) {
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "Thêm người dùng thành công",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        // $('.alert-success').text('Thêm người dùng thành công').css('display', 'block');
                                    }).fail(function(response) {
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Thêm người dùng thất bại",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        // $('.alert-danger').text('Thêm người dùng thất bại').css('display', 'block');
                                    });
                                }
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                            });
                    }
                });
            });
        </script>
        </body>

        </html>