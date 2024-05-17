<?php

?>
<?php
require_once('./App/Views/Admin/layouts/header.php');
?>

<style>
    .icon {
        padding: 5px;
    }

    .column_sort, .column_dif {
        text-decoration: none;
        color: white;
    }

    .column_dif:hover {
        cursor: no-drop;
    }
</style>

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
                        Danh sách nhà cung cấp
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
                <div class="card-body" id="receipt_table">
                    <div class="mb-3">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên nhà cung cấp" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><a class="column_sort" id="id" data-order="desc" href="#">ID<i class="fas fa-caret-up icon"></i></a></th>
                                <th scope="col"><a class="column_sort" id="name" data-order="desc" href="#">Tên nhà cung cấp</a></th>
                                <th scope="col"><a class="column_sort" id="description" data-order="desc" href="#">Mô tả</a></th>
                                <th scope="col"><a class="column_sort" id="status" data-order="desc" href="#">Trạng thái</a></th>
                                <th scope="col"><a class="column_dif">Hành động</a></th>
                            </tr>
                        </thead>
                        <?php
                        global $db;
                        if (isset($_GET['search'])) {
                            $filterValues = $_GET['search'];
                            $query = $db->query("SELECT * FROM providers WHERE CONCAT( name) LIKE '%$filterValues%'");
                            $query->execute();
                            $providers = $query->fetchAll();
                            if ($query->rowCount() > 0) {
                                foreach ($providers as $provider) {
                        ?>

                                    <tr>
                                        <th scope="row"><?php echo $provider['id']; ?></th>
                                        <td><?php echo $provider['name']; ?></td>
                                        <td><?php echo $provider['description']; ?></td>
                                        <td>
                                            <?php if ($provider['status'] == '1') { ?>
                                                <button class="btn btn-success" disabled>Active</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>Inactive</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit/<?php echo $provider['id']; ?>" class="btn btn-primary">Sửa</a>
                                            <a onclick="confirmDelete(event, <?php echo $provider['id']; ?>)" href="delete/<?php echo $provider['id']; ?>" class="btn btn-danger">Xóa</a>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">KHÔNG TÌM THẤY NHÀ CUNG CẤP</td>
                                </tr>
                            <?php
                            }

                            ?>
                            <tbody>
                                <?php
                            } else {
                                $query = $db->query("SELECT * FROM providers");
                                $query->execute();
                                $providers = $query->fetchAll();
                                foreach ($providers as $provider) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $provider['id']; ?></th>
                                        <td><?php echo $provider['name']; ?></td>
                                        <td><?php echo $provider['description']; ?></td>
                                        <td>
                                            <?php if ($provider['status'] == '1') { ?>
                                                <button class="btn btn-success" disabled>Active</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>Inactive</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit/<?php echo $provider['id']; ?>" class="btn btn-primary">Sửa</a>
                                            <a onclick="confirmDelete(event, <?php echo $provider['id']; ?>)" href="delete/<?php echo $provider['id']; ?>" class="btn btn-danger">Xóa</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(event, providerId) {
        event.preventDefault();

        Swal.fire({
            title: "Bạn có muốn xóa nhà cung cấp này?",
            text: "Bạn sẽ không thể khôi phục lại nhà cung cấp này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete/" + providerId;
            }
        });
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</body>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.column_sort', function() {
            var column_id = $(this).attr("id");
            var order = $(this).data("order");
            var arrow = '';
            //glyphicon glyphicon-arrow-up  
            //glyphicon glyphicon-arrow-down  
            if (order == 'desc') {
                arrow = '<i class="fas fa-caret-down icon"></i>';
            } else {
                arrow = '<i class="fas fa-caret-up icon"></i>';
            }
            $.ajax({
                url: "store",
                method: "POST",
                data: {
                    column_id: column_id,
                    order: order
                },
                success: function(data) {
                    $('#receipt_table').html(data);
                    $('#' + column_id + '').append(arrow);
                }
            })
        });
    });
</script>

</html>