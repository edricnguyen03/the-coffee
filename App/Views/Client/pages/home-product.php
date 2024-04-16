<section style="background-color: #eee;">
  <div class="text-center container py-2">
    <h4 class="mt-4 mb-5"><strong>Danh Sách Sản Phẩm</strong></h4>
    <div class="row">
      <div class="row product-list-container" id="product-list-container">
        <?php
        require_once('./App/Views/Client/pages/product-list.php');
        ?>
      </div>

      <!---------------Chi tiết sản phẩm------------------------>
      <div class="overlay" id="overlay" style="position: fixed; display: none; top: 0; left: 0; width: 100%; height: 100%;
     overflow: hidden; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 90;">
        <!----------------Lớp này che hết trang---------------->
        <div class="product-detail bg-light" style="z-index: 99; display: none; height: auto; width: fit-content;" id="product-detail">
          <!------------------lớp này chứa nội dung chi tiết sản phâm----------------------->
        </div>
      </div>
      <!-------------------------------------------------------->

      <!----------------------------Phân trang------------------------->
      <?php
        require_once('pagination.php');
      ?>
      <!---------------------------------------------------------------->

    </div>

    <!----------------------------Xử lý chi tiết sản phẩm------------------------->
    <script src="/the-coffee/resources/js/product-detail.js"></script>

    <!----------------------------Xử lý phân trang------------------------->
    <script src="/the-coffee/resources/js/home-pagination.js"></script>
</section>