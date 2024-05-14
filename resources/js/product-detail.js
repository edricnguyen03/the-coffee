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
  var detailButtons = document.querySelectorAll(".btn-product-detail");

  detailButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
      document.getElementById("overlay").style.display = "flex";
      // Lấy id sản phẩm từ thuộc tính data-productid
      var productId = this.getAttribute("data-productid");
      // Tạo một đối tượng XMLHttpRequest
      $.ajax({
        url: "product/detail/" + productId,
        method: "GET",
        success: function (response) {
          var productdetail = document.getElementById("product-detail");
          productdetail.innerHTML = response;
          setTimeout(updateProductDetailSize, 50);
          addEventForDetailAddToCartButton();
        },
        error: function (xhr, status, error) {
          console.log(error);
        },
      });
    });
  });

  // mở lớp phủ khi ấn chi tiết san phẩm
  var overlay = document.getElementById("overlay");
  var productDetail = document.getElementById("product-detail");

  overlay.addEventListener("click", function () {
    closeProductDetail();
  });

  productDetail.addEventListener("click", function (event) {
    // Ngăn chặn sự kiện bubbling lên trên để không tắt product-detail khi click vào bên trong nó
    event.stopPropagation();
  });
}

// Gán sự kiện cho nút "Thêm vào giỏ hàng"
function AddEventForAllAddToCartButton() {
  var addToCartButtons = document.querySelectorAll(".btn-addToCart");

  addToCartButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
      // Lấy id sản phẩm từ thuộc tính data-productid
      var productId = this.getAttribute("data-productid");
      // Tạo một đối tượng XMLHttpRequest
      var url = "Product/addToCart/" + productId;

      // Gửi yêu cầu AJAX
      $.ajax({
        url: url,
        method: "GET",
        success: function (response) {
          response = response.trim();
          switch (response) {
            case "login": {
              Swal.fire({
                icon: "error",
                title: "Bạn chưa đăng nhập",
                text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng",
              });
              break;
            }
            case "1": {
              Swal.fire({
                icon: "success",
                title: "Thành công",
                text: "Thêm sản phẩm vào giỏ hàng thành công",
              });
              break;
            }
            default: {
              Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: "Thêm vào giỏ hàng thất bại\n" + response,
              });
              break;
            }
          }
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: "Có lỗi xảy ra trong quá trình xử lý yêu cầu",
          });
        },
      });
    });
  });
}

function deleteCookie(name) {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

document.addEventListener("DOMContentLoaded", function () {
  AddEventForAllDetailButton();
  AddEventForAllAddToCartButton();
});

function closeProductDetail() {
  var productDetail = document.getElementById("product-detail");
  var overlay = document.getElementById("overlay");
  overlay.style.display = "none";
  productDetail.style.display = "none";
  document.body.style.overflow = "auto"; // Kích hoạt lại cuộn cho phần giao diện ở dưới
}

//thêm sự kiện nút thêm vào giỏ của trang chi tiết sản phẩm
function addEventForDetailAddToCartButton() {
  var addToCartButton = document.getElementById("product-detail-btn-addtocart");
  if (addToCartButton == null) return;
  addToCartButton.addEventListener("click", function (event) {
    event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
    // Lấy id sản phẩm từ thuộc tính data-productid
    var productId = this.getAttribute("data-productid");
    // Tạo một đối tượng XMLHttpRequest
    var xhttp = new XMLHttpRequest();

    var quantity = document.getElementById("product-detail-quantity").value;

    var stock = parseInt(
      document
        .getElementById("product-detail-stock")
        .getAttribute("data-productstock")
    );
    if (quantity < 1 || quantity > stock || quantity == "" || isNaN(quantity)) {
      Swal.fire({
        icon: "error",
        title: "Số lượng không hợp lệ",
        text: "Số lượng phải nằm trong khoảng từ 1 đến " + stock,
      });
      return;
    }
    // Xác định phương thức và URL của file PHP cần include
    var method = "GET";
    var url = "Product/addToCart/" + productId + "/" + quantity;

    // Gửi yêu cầu AJAX
    $.ajax({
      url: url,
      method: method,
      success: function (response) {
        response = response.trim();
        switch (response) {
          case "login": {
            Swal.fire({
              icon: "error",
              title: "Bạn chưa đăng nhập",
              text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng",
            });
            break;
          }
          case "1": {
            Swal.fire({
              icon: "success",
              title: "Thành công",
              text: "Thêm sản phẩm vào giỏ hàng thành công",
            });
            break;
          }
          default: {
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: "Thêm vào giỏ hàng thất bại\n" + response,
            });
            break;
          }
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: "Có lỗi xảy ra trong quá trình xử lý yêu cầu",
        });
      },
    });
  });

  // Xác định sự kiện khi người dùng nhập số lượng sản phẩm khác số nguyên dương
  document
    .getElementById("product-detail-quantity")
    .addEventListener("input", function (event) {
      var value = parseInt(event.target.value);
      if (isNaN(value) || value < 1) {
        event.target.value = "";
      }
    });
}
