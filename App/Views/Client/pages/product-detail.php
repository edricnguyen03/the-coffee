
 <div class="container" style="width: fit-content; height:fit-content">
    <div class="row">
        <div class="col-md-6">
            <img src="./resources/images/products/<?php echo $sanPham->thumb_image ?>" alt="" class="product-info-product-image" style="max-width: 100%;">
        </div>
        <div class="col-md-6 product-info-product-info">
            <h4 class="font-weight-bold"><?php echo $sanPham->name ?></h4>
            <p><?php echo $sanPham->description ?></p>
            <p><?php echo $sanPham->content ?></p>
            <p class="product-info-product-price text-success">Giá: <?php echo $sanPham->price ?> VND</p>
            <p class="product-info-product-attribute">Khối lượng: <?php echo $sanPham->weight ?> g</p>
            <p class="product-info-product-attribute text-bg-info">Số lượng còn lại: <?php echo $sanPham->stock ?></p>
            <p>Chúc quý khách một ngày tốt lành</p>

            <div class="input-group mb-3">
                <label for="soLuong" style="padding-top: 2%; margin-right: 2%">Số lượng: </label>
                <input type="number" class="form-control" name="soLuong" id="product-detail-quantity" placeholder="Số lượng" aria-label="Nhập số lượng" aria-describedby="button-addon2" min="1" max="10" value="1" >
                <a href="#" class="btn btn-warning" id="product-detail-btn-addtocart" data-productid = "<?php echo $sanPham->id?>" >
                    <i class="fa-solid fa-cart-arrow-down icon"></i>Thêm vào giỏ
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .product-info-product-image {
        height: 300px;
        object-fit: cover;
    }
    .product-info-product-info {
        padding: 20px;
    }
    .product-info-product-info h5 {
        color: #333;
    }
    .product-info-product-info p {
        color: #666;
    }
    .product-info-product-price {
        font-weight: bold;
        color: green;
    }
    .product-info-product-attribute {
        font-weight: bold;
    }
</style>