<section style="background-color: #eee;">
  <div class="text-center container py-2">
    <h4 class="mt-4 mb-5"><strong>Danh Sách Sản Phẩm</strong></h4>
    <div class="row">
      <div class="row product-list-container">
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
      <div class="row justify-content-center" style="align-items: center; background-color: rgb(238 238 238);">
        <div class="col-auto">
          <ul class="pagination" style=" margin:0px; padding:5px;">
            <li class="page-item">
              <!--Điền link zo php-->
              <a class="page-link" href="#" aria-label="Previous" style="display: flex; align-items: center; justify-content:center;">
                <i class="fa-solid fa-angle-left" id="previous-icon" style="color: #fb8e18;"></i>
              </a>
            </li>
            <li class="page-item">
              <!--chổ này điền số trang vào bằng js-->
              <div class="page-number" style=" padding-top: 10%">1</div>
            </li>
            <li class="page-item">
              <!--Điền link zo php-->
              <a class="page-link" href="#" aria-label="Next" style="display: flex; align-items: center; justify-content:center;">
                <i class="fa-solid fa-angle-right" id="next-icon" style="color: #fb8e18;"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!---------------------------------------------------------------->

    </div>

    <!----------------------------Xử lý chi tiết sản phẩm------------------------->
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
      function AddEventForAllDetailButton() {
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

        // mở lớp phủ khi ấn chi tiết san phẩm
        var overlay = document.getElementById('overlay');
        var productDetail = document.getElementById('product-detail');

        overlay.addEventListener('click', function() {
          closeProductDetail();
        });

        productDetail.addEventListener('click', function(event) {
          // Ngăn chặn sự kiện bubbling lên trên để không tắt product-detail khi click vào bên trong nó
          event.stopPropagation();
        });
      }
      document.addEventListener('DOMContentLoaded', function() {
          AddEventForAllDetailButton();
      });

      function closeProductDetail() {
        var productDetail = document.getElementById('product-detail');
        var overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
        productDetail.style.display = 'none';
        document.body.style.overflow = 'auto'; // Kích hoạt lại cuộn cho phần giao diện ở dưới
      }
    </script>


    <!----------------------------Xử lý phân trang------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // load các sản phẩm của trang vào
        $('#previous-icon').css('color', '#ccc');
        function loadContent(url) {
          $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
              $('.product-list-container').html(response);
              AddEventForAllDetailButton();
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        }

        // lấy số lượng trang tối đa
        var $numberOfPages = 1;

        function getNumberOfPage() {
          $.ajax({
            url: '/the-coffee/Home/getNumberOfPages',
            type: 'GET',
            success: function(response) {
              $numberOfPages = response;
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        }
        getNumberOfPage();

        // Xử lý khi nhấn nút Prev
        $('a[aria-label="Previous"]').click(function(e) {
          e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
          var currentPage = parseInt($('.page-number').text());
          if (currentPage > 1) {
            var prevPage = currentPage - 1;
            var url = '/the-coffee/Home/page/' + prevPage;
            loadContent(url);
            $('.page-number').text(prevPage);
            $('#next-icon').css('color', '#fb8e18');
          } else {
            $('#previous-icon').css('color', '#ccc'); // tắt cái nút prev nếu số trang là 1 
          }
          if(currentPage - 1 == 1){
            $('#previous-icon').css('color', '#ccc');
          }
        });

        // Xử lý khi nhấn nút Next
        $('a[aria-label="Next"]').click(function(e) {
          e.preventDefault();
          var currentPage = parseInt($('.page-number').text());
          if (currentPage < $numberOfPages) {
            var nextPage = currentPage + 1;
            var url = '/the-coffee/Home/page/' + nextPage;
            loadContent(url);
            $('.page-number').text(nextPage);
            $('#previous-icon').css('color', '#fb8e18');
          } else {
            $('#next-icon').css('color', '#ccc');
          }
          if(currentPage + 1 == $numberOfPages){
            $('#next-icon').css('color', '#ccc');
          }
        });


      });
    </script>
</section>