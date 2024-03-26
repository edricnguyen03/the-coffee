<section style="background-color: #eee;">
  <div class="text-center container py-5">
    <h4 class="mt-4 mb-5"><strong>Sản Phẩm</strong></h4>
    <div class="row">
      <?php
      foreach ($sanPhams as $sanPham) {
        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card" style="width: 18rem; height: 500px">
              <img src="./resources/images/products/' . $sanPham->thumb_image . '" class="card-img-top" alt="..." style="height:50%; object-fit: cover">
              <div class="card-body overflow-hidden">
                <h5 class="card-title">' . $sanPham->name . '</h5>
                <p class="card-text">' . $sanPham->description . '</p>
                <p class="card-text text-success text-start" style=" font-weight: bold;">Giá: ' . $sanPham->price . ' VND</p>
                <p class="card-text text-start" style=" font-weight: bold;">Khối lượng: ' . $sanPham->weight . ' g</p>
              </div>
              <div class="card-button py-3">
                <a href="#" class="btn btn-primary btn-product-detail" data-productid="' . $sanPham->id . '"><i class="fa-solid fa-circle-info icon"></i>Chi tiết</a>
                <a href="#" class="btn" style="background-color: #fb8e18;"><i class="fa-solid fa-cart-arrow-down icon"></i>Thêm vào giỏ</a>
              </div>
            </div>
          </div>';
      }
      ?>
    </div>

    <div class="row justify-content-center">
      <div class="col-auto">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <i class="fa-solid fa-angle-left" style="color: #fb8e18;"></i>
            </a>
          </li>
          <li class="page-item">
            <div class="page-number py-1">1</div>
          </li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <i class="fa-solid fa-angle-right" style="color: #fb8e18;"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="overlay " id="overlay" style="position: fixed; display: none;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 98;"></div>

    <div class="product-detail bg-white" style=" position: fixed;
      z-index: 99;
      width:fit-content;
      height: fit-content;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      
      display: none;
      overflow:hidden;
  " id="product-detail">

    </div>
  </div>

  <script>
    // Gán sự kiện cho nút "Chi tiết"
    document.addEventListener('DOMContentLoaded', function() {
      var detailButtons = document.querySelectorAll('.btn-product-detail');

      detailButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
          event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
          document.getElementById("overlay").style.display = "block";
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
              document.getElementById("product-detail").innerHTML = xhttp.responseText;
              document.getElementById("product-detail").style.display = "block";
              document.body.style.overflow = "hidden";
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