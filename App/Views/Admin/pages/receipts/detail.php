<?php
// Start the session
// Check if the user is logged in
if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
    // If not, display an alert message and redirect them to the login page
    // header('Location: alert');
    header('Location: ../../../Login_Regis/logout');
    exit;
} else if ($_SESSION['login']['id'] != 1) {
    // If not, redirect them to the login page
    header('Location: ../alert');
    exit;
}
?>
<?php


        

        // $query5 = "SELECT * FROM receipts ORDER BY id DESC";
        global $db;
        function fill_unit_select_box ($db) {
            $output = '';
            $query = $db->query("SELECT * FROM products");
            $query->execute();
            foreach ($query as $row) {
                $output .= '<option value="' . $row["id"]. '">'.$row["name"] . '</option>' ;
            }
            return $output;
        }

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ WEBSITE</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1c4a893c55.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./../../../resources/css/admin.css">
    <link href="./../../../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar sticky-top vh-100">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="../../../">THE COFFEE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Danh sách chức năng
                    </li>
                    <li class="sidebar-item">
                        <a href="../../dashboard/" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Thống kê
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Sản phẩm
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../product/create" class="sidebar-link">Thêm sản phẩm</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../product/ " class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Đơn hàng
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../order/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Receipt -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#receipt" data-bs-toggle="collapse" aria-expanded="false"><i class="fas fa-receipt"></i>
                            Phiếu nhập
                        </a>
                        <ul id="receipt" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../receipt/create" class="sidebar-link">Thêm phiếu nhập</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../receipt/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Người dùng
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../user/create" class="sidebar-link">Thêm người dùng</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../user/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#provider" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-truck pe-2"></i>
                            Nhà cung cấp
                        </a>
                        <ul id="provider" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../provider/create" class="sidebar-link">Thêm nhà cung cấp</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../provider/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#role" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-user-shield"></i>
                            Vai trò
                        </a>
                        <ul id="role" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../role/create" class="sidebar-link">Thêm vai trò</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../role/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#permission" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-handshake pe-2"></i>
                            Phân quyền
                        </a>
                        <ul id="permission" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../../permission/create" class="sidebar-link">Thêm phân quyền</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="../../permission/" class="sidebar-link">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <!-- 
                    <li class="sidebar-header">
                        Multi Level Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1" data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="./../../../resources/images/header-logo.png" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="../../logout" class="dropdown-item">Logout</a>
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
                            <h5 class="card-title my-3 py-2">
                                Chinh sửa người dùng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger text-center " style="display: none;" role="alert">
                            </div>

                            <div class="alert alert-success text-center" style="display: none;" role="alert">
                            </div>

                            <form method="POST" id="insert_form"> 
                                <div class="card-header">
                                    <h6 class="card-title">
                                        Danh sách sản phẩm nhập
                                    </h6>
                                </div>

                                <div class="table-repsonsive mb-3">
                                    <span id="error"></span>
                                    <table class="table table-bordered" id="item_table">
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá (đồng)</th>
                                            <!-- <th><button type="button"  name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th> -->
                                        </tr>
                                    </table>
                                    <div class="mb-3">
                                        <div class="info">
                                            <p><strong>Tên phiếu nhập:</strong> <?php echo $nameReceipt; ?></p>
                                            <p><strong>Nhà cung cấp:</strong> <?php echo $nameProvider; ?></p>
                                            <p><strong>Tổng số sản phẩm:</strong> <?php echo $receiptTotal; ?></p>
                                            <p><strong>Tổng số tiền:</strong> <?php echo $sum; ?> (đồng)</p>
                                        </div>
                                        </select>
                                        <!-- <button type="submit" name="submit"  class="btn btn-primary">Create Receipt</button>  -->
                                        <!-- id="submit_button -->  
                                    </div>   
								    <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Tạo mới phiếu nhập" /> 
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
    <script src="./../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../../../resources/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script type="text/javascript" >      
        $(document).ready(function(){
            var count = <?php echo $product_count = count($productReceipts); ?>;
            var jsArray = <?php echo $json_array = json_encode($productReceipts); ?>;
            console.log(jsArray);
            // for(var i = 0 ; i<count; i++) {
            //     console.log(jsArray[i].product_name);
            // }
            
            var hayem = 5454;
            function add_input_field(i)
            {
                console.log(jsArray[i].product_name);
                var html = '';

                html += '<tr>';

                html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" value="' + jsArray[i].product_name + '" /></td>';
                html += '<td><input type="number" name="item_quantity[]" class="form-control item_quantity" value="' + jsArray[i].quantity + '"/></td>';
                html += '<td><input type="number" name="item_price[]" class="form-control item_price" value="' + jsArray[i].product_price + '"/></td>'; 
                                       
                var remove_button = '';

                // if(count > 0)
                // {
                //     remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
                // }
                // html += '<td>'+remove_button+'</td></tr>';
                html += '</tr>';

                return html;

            }

            for(var i = 0 ; i < count; i++) {
                $('#item_table').append(add_input_field(i));
            }
            
            // var selectedId = jsArray[0].id;
        
            $('.selectpicker').selectpicker('refresh');

            $(document).on('click', '.add', function(){

                count++;

                $('#item_table').append(add_input_field(count));

                $('.selectpicker').selectpicker('refresh');

            });

            $(document).on('click', '.remove', function(){

                $(this).closest('tr').remove();

            });


            $('#insert_form').on('submit', function(event){
                event.preventDefault();
                var error = '';

                count = 1;

                $("select[name='item_name[]']").each(function(){

                    if($(this).val() == '')
                    {

                        error += "<li>Chọn tên sản phẩm được nhập tại dòng "+count+"</li>";

                    }

                    count = count + 1;

                    });

                count = 1;

                $('.item_quantity').each(function(){

                    if($(this).val() == '')
                    {

                        error += "<li>Nhập số lượng nhập tại dòng "+count+" </li>";

                    }

                    count = count + 1;

                });

                count = 1;

                $('.item_price').each(function(){

                    var price = $(this).val(); // Lấy giá trị của phần tử hiện tại

                    if(price === '') {
                        error += "<li>Nhập giá tiền tại dòng " + count + " </li>"; // Thêm lỗi nếu giá trị trống
                    } else if(parseFloat(price) <= 1000) {
                        error += "<li>Giá tiền tại dòng " + count + " phải lớn hơn hoặc bằng 1000 (đồng)</li>"; // Thêm lỗi nếu giá trị không lớn hơn 1000
                    }

                    count = count + 1; // Tăng biến đếm

                });

                var form_data = $(this).serialize();

                if(error == '')
                {
                    $.ajax({

                        url:"store",

                        method:"POST",

                        data:form_data,

                        beforeSend:function()
                        {

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
                        if(response)
                            {
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
                }else   {
                    $('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
                    
                }

            });
            
            });
        </script>                        

</body>

</html>