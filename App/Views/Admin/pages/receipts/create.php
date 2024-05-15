        <?php
        require_once('./App/Views/Admin/layouts/header.php');
        global $db;

        // $query5 = "SELECT * FROM receipts ORDER BY id DESC";


        function fill_unit_select_box($db)
        {
            $output = '';
            $query = $db->query("SELECT * FROM products");
            $query->execute();
            foreach ($query as $row) {
                $output .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
            return $output;
        }

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
                    <h3>QUẢN LÝ NHẬP HÀNG</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h4 class="card-title alert alert-warning text-center">
                                Lưu ý, hãy nhập và điền đơn nhập hàng thật kĩ vì bạn chỉ được phép xem đơn sau khi tạo!
                            </h4>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">
                                Thêm đơn nhập hàng vào danh sách
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger text-center " style="display: none;" role="alert">
                            </div>
                            <div class="alert alert-success text-center" style="display: none;" role="alert">
                            </div>
                            <form method="POST" id="insert_form"> <!-- action="store" -->
                                <div class="card-header">
                                    <h6 class="card-title">
                                        Danh sách Sản phẩm nhập
                                    </h6>
                                </div>
                                <div class="table-repsonsive mb-3">
                                    <span id="error"></span>
                                    <table class="table table-bordered" id="item_table">
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá (đồng)</th>
                                            <th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                                        </tr>
                                    </table>

                                    <!-- </form> -->
                                    <br> <br>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name1" name="name" placeholder="" required>
                                        <span class="error" id="name_error" style="color: red;"></span>
                                    </div>

                                    <div class="mb-3">

                                        <label for="provider" class="form-label">Nhà cung cấp</label>
                                        <select class="form-select" id="provider" name="provider" required>
                                            <?php
                                            // echo '<pre>';
                                            // print_r($names);
                                            // echo '<pre>'; 
                                            $names = array_map(function ($row) {
                                                return $row['name'];
                                            }, $nameOfProvider);

                                            // echo '<pre>';
                                            // print_r($names);
                                            // echo '<pre>'; 
                                            foreach ($names as $id => $name) {
                                                $id = $id + 1;
                                                echo "<option value=\"$id\">$name</option>\n";
                                            }
                                            ?>
                                        </select>


                                        <br> <br>
                                        <!-- <button type="submit" name="submit"  class="btn btn-primary">Create Receipt</button>  -->
                                        <!-- id="submit_button -->
                                    </div>
                                    <!-- nhập sản phẩm -->
                                    <div>
                                        <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Tạo mới phiếu nhập" />
                                    </div>

                                    <!-- <form method="post" id="insert_form"> -->


                                </div>

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        </body>

        <!-- phần code jquery -->
        <script type="text/javascript">
            // document.addEventListener('DOMContentLoaded', function() {
            //     let name = document.getElementById('name1');

            //     name.addEventListener('focusout', function() {
            //         let value = name.value;
            //         validate(value);
            //         // console.log(value);
            //     });
            //     // document.getElementById('submit').addEventListener('click', function() {
            //     //     if (validate()) {
            //     //         document.querySelector('form').submit();
            //     //     }
            //     // });

            // });
            // function validate(data) {
            //         name = data.trim();
            //         // let name = document.getElementById('name').value.trim();
            //         // let description = document.getElementById('description').value.trim();
            //         if(name == '' || description == '') {
            //             document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Không để trống các ô</div>';
            //             return false;
            //         }
            //         if (!/^[a-zA-ZÀ-ỹ\s]{4,40}$/.test(name)) {
            //             document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Tên không hợp lệ</div>';
            //             return false;
            //         }
            //         if (!/^[a-zA-ZÀ-ỹ\s]{4,40}$/.test(description)) {
            //             document.getElementById('error').innerHTML = '<div class="alert alert-danger text-center" role="alert"> Mô tả không hợp lệ</div>';
            //             return false;
            //         }
            //         return true;
            //     }  

            $(document).ready(function() {

                var count = 0;

                function add_input_field(count) {

                    var html = '';

                    html += '<tr>';

                    html += '<td><select name="item_name[]" type="text" class="form-control selectpicker item_name" data-live-search="true"><option value="">Select Name</option><?php echo fill_unit_select_box($db); ?> </select></td>';
                    html += '<td><input type="number" name="item_quantity[]" class="form-control item_quantity" /></td>';
                    html += '<td><input type="number" name="item_price[]" class="form-control item_price" /></td>';


                    var remove_button = '';

                    if (count > 0) {
                        remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
                    }

                    html += '<td>' + remove_button + '</td></tr>';

                    return html;

                }

                $('#item_table').append(add_input_field(0));

                $('.selectpicker').selectpicker('refresh');

                $(document).on('click', '.add', function() {

                    count++;

                    $('#item_table').append(add_input_field(count));

                    $('.selectpicker').selectpicker('refresh');

                });

                $(document).on('click', '.remove', function() {

                    $(this).closest('tr').remove();

                });


                $('#insert_form').on('submit', function(event) {
                    event.preventDefault();
                    var error = '';

                    count = 1;

                    $("select[name='item_name[]']").each(function() {

                        if ($(this).val() == '') {

                            error += "<li>Chọn tên sản phẩm được nhập tại dòng " + count + "</li>";

                        }

                        count = count + 1;

                    });

                    count = 1;

                    $('.item_quantity').each(function() {

                        if ($(this).val() == '') {

                            error += "<li>Nhập số lượng nhập tại dòng " + count + " </li>";

                        }
                        if ($(this).val() < 0 || $(this).val() > 1000) {
                            error += "<li>Số lượng phải lớn hơn 0 và nhỏ hơn 1000 ở dòng " + count + " </li>";
                        }

                        count = count + 1;

                    });

                    count = 1;

                    $('.item_price').each(function() {

                        var price = $(this).val(); // Lấy giá trị của phần tử hiện tại
                        if (price === '') {
                            error += "<li>Nhập giá tiền tại dòng " + count + " </li>"; // Thêm lỗi nếu giá trị trống
                        } else if (parseFloat(price) <= 1000) {
                            error += "<li>Giá tiền tại dòng " + count + " phải lớn hơn hoặc bằng 1000 (đồng)</li>"; // Thêm lỗi nếu giá trị không lớn hơn 1000
                        }
                        count = count + 1; // Tăng biến đếm

                    });

                    if (document.getElementById('name1').value.trim() === '') {

                        error += "<li>Nhập tên phiếu nhập</li>";
                    } else {
                        document.getElementById('name1').value = document.getElementById('name1').value.trim();
                    }

                    var form_data = $(this).serialize();

                    if (error == '') {
                        $.ajax({

                            url: "store",

                            method: "POST",

                            data: form_data,

                            beforeSend: function() {

                                $('#submit_button').attr('disabled', 'disabled');

                            },

                            // success:function(data)
                            // {

                            // if(data == 'ok')
                            // {
                            //     // $_SESSION['success'] = 'Thêm đơn nhập hàng thành công';
                            //     // header('Location: /the-coffee/admin/receipt/index');
                            //     // exit();
                            //     $('#item_table').find('tr:gt(0)').remove();

                            //     $('#error').html('<div class="alert alert-success">Item Details Saved</div>');

                            //     $('#item_table').append(add_input_field(0));

                            //     $('.selectpicker').selectpicker('refresh');

                            //     $('#submit_button').attr('disabled', false);
                            // }

                            // }
                        }).done(function(response) {
                            if (response) {
                                // $('.alert-success').text('Thêm phiếu nhập thành công').css('display', 'block');

                                $('#name').val('');

                                $('#name_error').text('');

                                $('#item_table').find('tr:gt(0)').remove();

                                $('#error').html('<div  style="text-align: center;" class="alert alert-success">Thêm phiếu nhập thành công</div>');

                                $('#item_table').append(add_input_field(0));

                                $('.selectpicker').selectpicker('refresh');

                                $('#submit_button').attr('disabled', false);
                            }
                        }).fail(function(response) {
                            $('.alert-danger').text('Thêm phiếu nhập thất bại').css('display', 'block');
                        });
                    } else {
                        $('#error').html('<div class="alert alert-danger"><ul>' + error + '</ul></div>');

                    }

                });

            });
        </script>

        </html>