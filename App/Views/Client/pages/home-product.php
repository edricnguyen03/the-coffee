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
      <div class="row justify-content-center" style="align-items: center; background-color: rgb(238 238 238);">
        <div class="col-auto">
          <ul class="pagination" style=" margin:0px; padding:5px;">
            <li class="page-item">
              <!--Điền link zo php-->
              <a class="page-link" id="previous-button" aria-label="Previous" style="display: flex; align-items: center; justify-content:center;">
                <i class="fa-solid fa-angle-left" id="previous-icon" style="color: #fb8e18;"></i>
              </a>
            </li>
            <li class="page-item">
              <!--chổ này điền số trang vào bằng js-->
              <div class="page-number" style=" padding-top: 10%">1</div>
            </li>
            <li class="page-item">
              <!--Điền link zo php-->
              <a class="page-link" id="next-button" aria-label="Next" style="display: flex; align-items: center; justify-content:center;">
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
                addEventForDetailAddToCartButton();
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

      // Gán sự kiện cho nút "Thêm vào giỏ hàng"
      function AddEventForAllAddToCartButton() {
        var addToCartButtons = document.querySelectorAll('.btn-addToCart');

        addToCartButtons.forEach(function(button) {
          button.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
            // Lấy id sản phẩm từ thuộc tính data-productid
            var productId = this.getAttribute('data-productid');
            // Tạo một đối tượng XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Xác định phương thức và URL của file PHP cần include
            var method = "GET";
            var url = 'Product/addToCart/' + productId;

            // Mở kết nối với file PHP
            xhttp.open(method, url, true);

            // Xác định hành động khi kết quả trả về từ file PHP
            xhttp.onreadystatechange = function() {
              if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
                var response = xhttp.responseText;
                switch (response) {
                  case "login": {
                    Swal.fire({
                      icon: 'error',
                      title: 'Bạn chưa đăng nhập',
                      text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng"
                    });
                    break;
                  }
                  case '1': {
                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: "Thêm sản phẩm vào giỏ hàng thành công"
                    });
                    break;
                  }
                  default: {
                    Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: "Thêm vào giỏ hàng thất bại\n" + response
                    });
                    break;
                  }
                }
              }
            };
            // Gửi yêu cầu đến file PHP
            xhttp.send();
          });
        });
      }


      document.addEventListener('DOMContentLoaded', function() {
        AddEventForAllDetailButton();
        AddEventForAllAddToCartButton();
      });

      function closeProductDetail() {
        var productDetail = document.getElementById('product-detail');
        var overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
        productDetail.style.display = 'none';
        document.body.style.overflow = 'auto'; // Kích hoạt lại cuộn cho phần giao diện ở dưới
      }

      function addEventForDetailAddToCartButton() {
        var addToCartButton = document.getElementById('product-detail-btn-addtocart');
        if (addToCartButton == null) return;
        addToCartButton.addEventListener('click', function(event) {
          event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
          // Lấy id sản phẩm từ thuộc tính data-productid
          var productId = this.getAttribute('data-productid');
          // Tạo một đối tượng XMLHttpRequest
          var xhttp = new XMLHttpRequest();

          var quantity = document.getElementById('product-detail-quantity').value;

          if (quantity < 0 || quantity > 10 || quantity == "" || isNaN(quantity)) {
            Swal.fire({
              icon: 'error',
              title: 'Số lượng không hợp lệ',
              text: "Số lượng phải nằm trong khoảng từ 1 đến 10"
            });
            return;
          }
          // Xác định phương thức và URL của file PHP cần include
          var method = "GET";
          var url = 'Product/addToCart/' + productId + "/" + quantity;

          // Mở kết nối với file PHP
          xhttp.open(method, url, true);

          // Xác định hành động khi kết quả trả về từ file PHP
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
              var response = xhttp.responseText;
              switch (response) {
                case "login": {
                  Swal.fire({
                    icon: 'error',
                    title: 'Bạn chưa đăng nhập',
                    text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng"
                  });
                  break;
                }
                case '1': {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Thêm sản phẩm vào giỏ hàng thành công"
                  });
                  break;
                }
                default: {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Thêm vào giỏ hàng thất bại\n" + response
                  });
                  break;
                }
              }
            }
          };
          // Gửi yêu cầu đến file PHP
          xhttp.send();
        });
      }
    </script>

    <!----------------------------Xử lý phân trang------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // load các sản phẩm của trang vào
        //$('#previous-icon').css('color', '#ccc'); // lúc mới vào trang đầu
        $('#previous-button').css('visibility', 'hidden');



        function loadContent(url) {
          $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
              document.getElementById('product-list-container').classList.add('changing');

              setTimeout(function() {
                $('.product-list-container').html(response);
                AddEventForAllDetailButton();
                AddEventForAllAddToCartButton();
                // Loại bỏ class 'changing' sau khi hoàn thành việc thay đổi
                document.getElementById('product-list-container').classList.remove('changing');
              }, 300);
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
              if ($numberOfPages < 2) {
                $('#previous-button').css('visibility', 'hidden');
                $('#next-button').css('visibility', 'hidden');
              }
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
            //$('#next-icon').css('color', '#fb8e18');
            $('#next-button').css('visibility', 'visible');

          } else {
            //$('#previous-icon').css('color', '#ccc'); // tắt cái nút prev nếu số trang là 1 
            $('#previous-button').css('visibility', 'hidden');
          }
          if (currentPage - 1 == 1) {
            //$('#previous-icon').css('color', '#ccc');
            $('#previous-button').css('visibility', 'hidden');
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
            $('#previous-button').css('visibility', 'visible');
            //$('#previous-icon').css('color', '#fb8e18');
          } else {
            //$('#next-icon').css('color', '#ccc');
            $('#next-button').css('visibility', 'hidden');
          }
          if (currentPage + 1 == $numberOfPages) {
            //$('#next-icon').css('color', '#ccc');
            $('#next-button').css('visibility', 'hidden');

          }
        });
        $('.page-number').on('change', function() {
          // Code xử lý khi giá trị của '.page-number' thay đổi
          var currentPage = parseInt($('.page-number').text());
          if (currentPage == 1) {
            // $('#previous-icon').css('color', '#ccc');
            // $('#next-icon').css('color', '#fb8e18');
            $('#next-button').css('visibility', 'visible');
            $('#previous-button').css('visibility', 'hidden');
          } else {
            //$('#previous-icon').css('color', '#fb8e18');
            $('#previous-button').css('visibility', 'visible');
          }
          if (currentPage == $numberOfPages) {
            //$('#next-icon').css('color', '#ccc');
            $('#next-button').css('visibility', 'hidden');
          } else {
            //$('#next-icon').css('color', '#fb8e18');
            $('#next-button').css('visibility', 'visible');
          }
          if ($numberOfPages == 1) {
            $('#next-button').css('visibility', 'hidden');
            $('#previous-button').css('visibility', 'hidden');
          }
        });

        // Khi thay đổi giá trị của '.page-number', trigger sự kiện 'change'
        $('.page-number').on('input', function() {
          $(this).trigger('change');
        });


      });
    </script>
</section>