var $numberOfPages = 1;
// lấy số lượng trang tối đa
function getNumberOfPage() {
  var idDanhMuc = $("#searchbar-dropdown-category").val();
  var minMucGia, maxMucGia;
  switch ($("#searchbar-dropdown-price").val()) {
    case "1":
      minMucGia = 0;
      maxMucGia = 99999;
      break;
    case "2":
      minMucGia = 100000;
      maxMucGia = 499999;
      break;
    case "3":
      minMucGia = 500000;
      maxMucGia = 999999;
      break;
    case "4":
      minMucGia = 1000000;
      maxMucGia = -1;
      break;
    default:
      minMucGia = 0;
      maxMucGia = -1;
  }
  var noiDung = $("#searchInput").val();

  $.ajax({
    url: "/the-coffee/Product/getNumberOfPages",
    type: "POST",
    data: {
      idDanhMuc: idDanhMuc,
      minMucGia: minMucGia,
      maxMucGia: maxMucGia,
      noiDung: noiDung,
    },
    success: function (response) {
      $numberOfPages = parseInt(response);
      if ($numberOfPages < 2) {
        $("#next-button").css("visibility", "hidden");
        $("#previous-button").css("visibility", "hidden");
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}

$(document).ready(function () {
  //$('#previous-icon').css('color', '#ccc');
  $("#previous-button").css("visibility", "hidden");
  getNumberOfPage();

  // Xử lý khi nhấn nút Prev
  $('a[aria-label="Previous"]').click(function (e) {
    e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
    var currentPage = parseInt($(".page-number").text());
    if (currentPage > 1) {
      var prevPage = currentPage - 1;
      var url = "/the-coffee/Product/filter";
      filter_Data(prevPage);
      $(".page-number").text(prevPage);
      //$('#next-icon').css('color', '#fb8e18');
      $("#next-button").css("visibility", "visible");
    } else {
      //$('#previous-icon').css('color', '#ccc'); // tắt cái nút prev nếu số trang là 1
      $("#previous-button").css("visibility", "hidden");
    }
    if (currentPage - 1 == 1) {
      //$('#previous-icon').css('color', '#ccc');
      $("#previous-button").css("visibility", "hidden");
    }
    if (currentPage + 1 == $numberOfPages) {
      //$('#next-icon').css('color', '#ccc');
      $("#next-button").css("visibility", "hidden");
    }
  });

  // Xử lý khi nhấn nút Next
  $('a[aria-label="Next"]').click(function (e) {
    e.preventDefault();
    var currentPage = parseInt($(".page-number").text());
    if (currentPage < $numberOfPages) {
      var nextPage = currentPage + 1;
      var url = "/the-coffee/Home/page/" + nextPage;
      filter_Data(nextPage);
      $(".page-number").text(nextPage);
      $("#previous-button").css("visibility", "visible");
      //$('#previous-icon').css('color', '#fb8e18');
    } else {
      //$('#next-icon').css('color', '#ccc');
      $("#next-button").css("visibility", "hidden");
    }
    if (currentPage + 1 == $numberOfPages) {
      //$('#next-icon').css('color', '#ccc');
      $("#next-button").css("visibility", "hidden");
    }
  });

  //xử lý khi thay đổi ô trang
  $(".page-number").on("change", function () {
    getNumberOfPage();
    // Code xử lý khi giá trị của '.page-number' thay đổi
    var currentPage = parseInt($(".page-number").text());
    console.log($numberOfPages + " " + currentPage);
    if (currentPage == 1 && $numberOfPages > 1) {
      //$('#previous-icon').css('color', '#ccc');
      //$('#next-icon').css('color', '#fb8e18');
      $("#next-button").css("visibility", "visible");
      $("#previous-button").css("visibility", "hidden");
    }
    // if ($numberOfPages == 1) {
    //   $('#next-button').css('visibility', 'hidden');
    //   $('#previous-button').css('visibility', 'hidden');
    // }
    // else {
    //   //$('#previous-icon').css('color', '#fb8e18');
    //   $('#previous-button').css('visibility', 'visible');
    // }
    if (currentPage == $numberOfPages) {
      $("#next-button").css("visibility", "hidden");
      // $('#next-icon').css('color', '#ccc');
      // $('#previous-icon').css('color', '#fb8e18');
    } else {
      //$('#next-icon').css('color', '#fb8e18');
      $("#next-button").css("visibility", "visible");
    }
  });

  // Khi thay đổi giá trị của '.page-number', trigger sự kiện 'change'
  $(".page-number").on("input", function () {
    $(this).trigger("change");
  });
});

//-------------------------------------------Xử lý lọc dữ liệu----------------------------------------------
$("#btn-search").click(function (e) {
  filter_Data();
  $(".page-number").trigger("change");
});

//thêm sự kiện cho nút tìm kiếm khi ấn nút enter
$("#searchInput").keypress(function (event) {
  if (event.key === "Enter") {
    event.preventDefault(); // Prevent the default form submission
    filter_Data();
    $(".page-number").trigger("change");
  }
});

function filter_Data(page = 1) {
  var idDanhMuc = $("#searchbar-dropdown-category").val();
  var minMucGia, maxMucGia;

  switch ($("#searchbar-dropdown-price").val()) {
    case "1":
      minMucGia = 0;
      maxMucGia = 99999;
      break;
    case "2":
      minMucGia = 100000;
      maxMucGia = 499999;
      break;
    case "3":
      minMucGia = 500000;
      maxMucGia = 999999;
      break;
    case "4":
      minMucGia = 1000000;
      maxMucGia = -1;
      break;
    default:
      minMucGia = 0;
      maxMucGia = -1;
  }

  var noiDung = $("#searchInput").val();

  $.ajax({
    url: "/the-coffee/Product/filter",
    method: "POST",
    data: {
      idDanhMuc: idDanhMuc,
      minMucGia: minMucGia,
      maxMucGia: maxMucGia,
      noiDung: noiDung,
      page: page,
    },
    success: function (response) {
      document
        .getElementById("product-list-container")
        .classList.add("changing");

      setTimeout(function () {
        $(".product-list-container").html(response);
        AddEventForAllDetailButton();
        AddEventForAllAddToCartButton();
        $(".page-number").text(page); // đặt lại ô số trang
        $(".page-number").trigger("change");
        // Loại bỏ class 'changing' sau khi hoàn thành việc thay đổi
        document
          .getElementById("product-list-container")
          .classList.remove("changing");
      }, 300);
    },
  });
}
