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
                    <h3>QUẢN LÝ NHẬP HÀNG</h3>
                </div>
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h4 class="card-title">
                                Thêm đơn nhập hàng vào danh sách
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="create_receipt" action="store" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên tối thiểu 4 ký tự, tối đa 40 ký tự và không chứa ký tự đặc biệt " required>
                                    <span class="error" id="name_error" style="color: red;"></span>
                                </div>

                                <div class="mb-3">
                                        
                                    <label for="provider" class="form-label">Provider</label>
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
                                            foreach($names as $id => $name){
                                            $id=$id+1;
                                            echo "<option value=\"$id\">$name</option>\n";
                                        }
                                        ?>
                                    </select>
                                <!-- nhập sản phẩm -->
                                <br> <br>
                                </div>
                                    <div class="card-header">
                                    <h6 class="card-title">
                                        Sản phẩm nhập
                                    </h6>
                                </div>                              
                                <div class="mb-3">
                                        
                                        <label for="product" class="form-label">Product</label>
                                        <select class="form-select" id="product" name="product" required>
                                        <?php
                                            $names2 = array_map(function ($row) {
                                                return $row['name'];
                                            }, $nameOfProduct);
                                            
                                            echo '<pre>';
                                            print_r($names2);
                                            echo '<pre>'; ;
                                            foreach($names2 as $id => $name){
                                            $id=$id+1;
                                            echo "<option value=\"$id\">$name</option>\n";
                                        }
                                        ?>
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" name="total" placeholder="" required>
                                        <span class="error" id="name_error" style="color: red;"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="" required>
                                        <span class="error" id="name_error" style="color: red;"></span>
                                    </div>       
                                <button type="submit" name="submit" class="btn btn-primary">Create Receipt</button>
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