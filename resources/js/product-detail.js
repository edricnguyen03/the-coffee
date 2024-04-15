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
      var xhttp = new XMLHttpRequest();

      // Xác định phương thức và URL của file PHP cần include
      var method = "GET";
      var url = "product/detail/" + productId;

      // Mở kết nối với file PHP
      xhttp.open(method, url, true);

      // Xác định hành động khi kết quả trả về từ file PHP
      xhttp.onreadystatechange = function () {
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
      var xhttp = new XMLHttpRequest();

      // Xác định phương thức và URL của file PHP cần include
      var method = "GET";
      var url = "Product/addToCart/" + productId;

      // Mở kết nối với file PHP
      xhttp.open(method, url, true);

      // Xác định hành động khi kết quả trả về từ file PHP
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
          var response = xhttp.responseText;
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
                title: "Success",
                text: "Thêm sản phẩm vào giỏ hàng thành công",
              });
              break;
            }
            default: {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Thêm vào giỏ hàng thất bại\n" + response,
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

    if (quantity < 0 || quantity > 10 || quantity == "" || isNaN(quantity)) {
      Swal.fire({
        icon: "error",
        title: "Số lượng không hợp lệ",
        text: "Số lượng phải nằm trong khoảng từ 1 đến 10",
      });
      return;
    }
    // Xác định phương thức và URL của file PHP cần include
    var method = "GET";
    var url = "Product/addToCart/" + productId + "/" + quantity;

    // Mở kết nối với file PHP
    xhttp.open(method, url, true);

    // Xác định hành động khi kết quả trả về từ file PHP
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
        var response = xhttp.responseText;
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
              title: "Success",
              text: "Thêm sản phẩm vào giỏ hàng thành công",
            });
            break;
          }
          default: {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Thêm vào giỏ hàng thất bại\n" + response,
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
