<?php
foreach ($sanPhams as $sanPham) {
    echo '<!------------san pham--------------->';
    echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
            <img src="./resources/images/products/' . $sanPham->thumb_image . '" class="card-img-top h-100" alt="' . $sanPham->name . '"object-fit: cover">
            <div class="card-body" style="overflow:scroll; overflow-x: hidden;">
                <h5 class="card-title">' . $sanPham->name . '</h5>
                <p class="card-text">' . $sanPham->description . '</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-success font-weight-bold">Giá: ' . $sanPham->price . ' VND</div>
                <div class="font-weight-bold">Khối lượng: ' . $sanPham->weight . ' g</div>
            </div>
            <div class="card-button py-2">
                <a href="#" class="btn btn-primary btn-product-detail" data-productid="' . $sanPham->id . '">
                    <i class="fa-solid fa-circle-info icon"></i>Chi tiết
                </a>
                <a href="#" class="btn btn-warning btn-addToCart" data-productid = "'.$sanPham->id.'">
                    <i class="fa-solid fa-cart-arrow-down icon"></i>Thêm vào giỏ
                </a>
            </div>
        </div>
    </div>';
}
?>
