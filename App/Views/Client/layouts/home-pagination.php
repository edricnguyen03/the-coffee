    <!------------------------------------pagination----------------------------------------->
    <section>
        <div class="row justify-content-center" style="align-items: center; background-color: rgb(238 238 238);">
            <div class="col-auto">
                <ul class="pagination" style=" margin:0px; padding:5px;">
                    <li class="page-item">
                        <!--Điền link zo php-->
                        <a class="page-link" href="#" aria-label="Previous" style="display: flex; align-items: center; justify-content:center;">
                            <i class="fa-solid fa-angle-left" style="color: #fb8e18;"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <!--chổ này điền số trang vào bằng php-->
                        <div class="page-number" style="padding-left: 32%; padding-top: 10%"><?php $page ?></div>
                    </li>
                    <li class="page-item">
                        <!--Điền link zo php-->
                        <a class="page-link" href="#" aria-label="Next" style="display: flex; align-items: center; justify-content:center;">
                            <i class="fa-solid fa-angle-right" style="color: #fb8e18;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadContent(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Thay đổi số trang
                        $('.page-number').text(response.pageNumber);
                        // Thay đổi nội dung hoặc thực hiện các thao tác khác
                        // Ở đây response.pageNumber là số trang mới cần hiển thị
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Xử lý khi nhấn nút Prev
            $('a[aria-label="Previous"]').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
                var currentPage = parseInt($('.page-number').text());
                if (currentPage > 1) {
                    var prevPage = currentPage - 1;
                    var url = '/the-coffee/Home/index/' + prevPage;
                    loadContent(url);
                }
            });

            // Xử lý khi nhấn nút Next
            $('a[aria-label="Next"]').click(function(e) {
                e.preventDefault();
                var currentPage = parseInt($('.page-number').text());
                var nextPage = currentPage + 1;
                var url = '/the-coffee/Home/index/' + nextPage;
                loadContent(url);
            });

            
        });
    </script>