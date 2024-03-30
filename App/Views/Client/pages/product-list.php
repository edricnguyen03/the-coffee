<section style="background-color: #eee;">
  <div class="text-center container py-2">
    <h4 class="mt-4 mb-5"><strong>Sản Phẩm</strong></h4>
    <div class="row">
      <?php
      foreach ($sanPhams as $sanPham) {
        echo '<!------------san pham--------------->';
        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
            <img src="./resources/images/products/'.$sanPham->thumb_image.'" class="card-img-top h-100" alt="'.$sanPham->name.'"object-fit: cover">
            <div class="card-body">
                <h5 class="card-title">'.$sanPham->name .'</h5>
                <p class="card-text">'.$sanPham->description .'</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-success font-weight-bold">Giá: '. $sanPham->price.' VND</div>
                <div class="font-weight-bold">Khối lượng: '.$sanPham->weight .' g</div>
            </div>
            <div class="card-button py-2">
                <a href="#" class="btn btn-primary btn-product-detail" data-productid="'. $sanPham->id .'">
                    <i class="fa-solid fa-circle-info icon"></i>Chi tiết
                </a>
                <a href="#" class="btn btn-warning">
                    <i class="fa-solid fa-cart-arrow-down icon"></i>Thêm vào giỏ
                </a>
            </div>
        </div>
    </div>';
      }
      ?>
    <div class="overlay" id="overlay" style="position: fixed; display: none; top: 0; left: 0; width: 100%; height: 100%;
     overflow: hidden; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 90;">
      <!----------------Lớp này che hết trang---------------->
      <div class="product-detail bg-light" style="z-index: 99; display: none; height: auto; width: fit-content;" id="product-detail">
        <!------------------lớp này chứa nội dung chi tiết sản phâm----------------------->

      </div>

    </div>


  </div>

  <script>
    // Xác định hàm để cập nhật kích thước của product-detail
    function updateProductDetailSize() {
      var productDetail = document.getElementById("product-detail");
      productDetail.style.height = "fit-content";
      productDetail.style.width = "fit-content";
      productDetail.style.display = "flex";
      document.body.style.overflow = "hidden";
    }
    // Gán sự kiện cho nút "Chi tiết"
    document.addEventListener('DOMContentLoaded', function() {
      var detailButtons = document.querySelectorAll('.btn-product-detail');

      detailButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
          event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
          document.getElementById("overlay").style.display = "flex";
          // Lấy id sản phẩm từ thuộc tính data-productid
          var productId = this.getAttribute('data-productid');
          // Tạo một đối tượng XMLHttpRequest
          var xhttp = new XMLHttpRequest();

          // Xác định phương thức và URL của file PHP cần include
          var method = "GET";
          var url = 'product/detail/' + productId;

          // Mở kết nối với file PHP
          xhttp.open(method, url, true);

          // Xác định hành động khi kết quả trả về từ file PHP
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
              var productdetail = document.getElementById("product-detail");
              productdetail.innerHTML = xhttp.responseText;
              setTimeout(updateProductDetailSize, 50);
            }
          };



          // Gửi yêu cầu đến file PHP
          xhttp.send();
        });
      });
      var overlay = document.getElementById('overlay');
      var productDetail = document.getElementById('product-detail');

      overlay.addEventListener('click', function() {
        closeProductDetail();
      });

      productDetail.addEventListener('click', function(event) {
        // Ngăn chặn sự kiện bubbling lên trên để không tắt product-detail khi click vào bên trong nó
        event.stopPropagation();
      });
    });

    function closeProductDetail() {
      var productDetail = document.getElementById('product-detail');
      var overlay = document.getElementById('overlay');
      overlay.style.display = 'none';
      productDetail.style.display = 'none';
      document.body.style.overflow = 'auto'; // Kích hoạt lại cuộn cho phần giao diện ở dưới
    }
  </script>
</section>