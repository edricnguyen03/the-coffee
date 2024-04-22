
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