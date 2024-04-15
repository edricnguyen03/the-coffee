<section style="background-color: #eee;">
  <!----------------------------------------Thanh tìm kiếm----------------------------------------------------->
  <div class="fluid-container sticky-top bg-light p-4 shadow-sm searchbar-container" style="z-index: 10;">
    <div class="row align-items-end justify-content-end">
      <!-------------------------------Combobox thương hiệu------------------------------->
      <div class="col-md-2">
        <div class="form-group mb-md-0 rounded w-100">
          <select class="form-control form-select" id="searchbar-dropdown-category">
            <?php
            echo '<option value="all">Thương hiệu</option>';
            foreach ($danhMucs as $danhMuc) {
              echo '<option value="' . $danhMuc->id . '">' . $danhMuc->name . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <!-------------------------------Combobox mức giá------------------------------->
      <div class="col-md-2">
        <div class="form-group mb-md-0">
          <select class="form-control form-select" id="searchbar-dropdown-price">
            <option value="all">Mức giá</option>
            <option value="1">Dưới 100.000 VND</option>
            <option value="2">100.0000 đến 500.000 VND</option>
            <option value="3">500.000 đến 1.000.000 VND</option>
            <option value="4">1.000.000 VND</option>
          </select>
        </div>
      </div>

      <!-------------------------------textbox tìm kiếm------------------------------->
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control rounded-2" id="searchInput" placeholder="Nhập nội dung tìm kiếm">
          <div class="input-group-append">
            <button type="button" id="btn-search" class="btn btn-primary w-100" style="margin-left: 10%"><i class="fas fa-search icon"></i>Tìm Kiếm</button>
          </div>
        </div>
      </div>
      <!------------------------------------------------------------------------------>

    </div>
  </div>



  <!-----------------------------Danh sách sản phẩm------------------------>
  <div class="text-center container py-2">
    <h4 class="mt-4 mb-5"><strong>Sản Phẩm</strong></h4>
    <div class="row">
      <div class="row product-list-container" id="product-list-container">
        <?php
        require_once('./App/Views/Client/pages/product-list.php');
        ?>
      </div>

      <!---------------Chi tiết sản phẩm-------------------------------------------------------------------------->
      <div class="overlay" id="overlay" style="position: fixed; display: none; top: 0; left: 0; width: 100%; height: 100%;
     overflow: hidden; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 90;">
        <!----------------Lớp này che hết trang---------------->
        <div class="product-detail bg-light" style="z-index: 99; display: none; height: auto; width: fit-content;" id="product-detail">
          <!------------------lớp này chứa nội dung chi tiết sản phâm----------------------->
        </div>
      </div>
      <!----------------------------------------------------------------------------------------------------------->

      <!----------------------------Phân trang------------------------->
      <?php
        require_once('pagination.php');
      ?>
      <!---------------------------------------------------------------->

    </div>

    <!---------------------------------------------------------Xử lý chi tiết sản phẩm---------------------------------------------------->
    <script src="/the-coffee/resources/js/product-detail.js"></script>


    <!-------------------------------------------------Xử lý phân trang----------------------------------------------------------------------->
    <script src="/the-coffee/resources/js/product-pagination.js"></script>
    



</section>