<section style="background-color: #eee;">
  <div class="text-center container py-5">
    <h4 class="mt-4 mb-5"><strong>Sản Phẩm</strong></h4>
    <div class="row">
      <?php
      foreach ($data as $sanPham) {
        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card" style="width: 18rem; height: 500px">
              <img src="./resources/images/products/'.$sanPham->thumb_image.'" class="card-img-top" alt="..." style="height:50%; object-fit: cover">
              <div class="card-body overflow-hidden">
                <h5 class="card-title">'.$sanPham->name.'</h5>
                <p class="card-text">'.$sanPham->description.'</p>
                <p class="card-text text-success text-start" style=" font-weight: bold;">Giá: '.$sanPham->price.' VND</p>
                <p class="card-text text-start" style=" font-weight: bold;">Khối lượng: '.$sanPham->weight.' g</p>
              </div>
              <div class="card-button py-3">
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-circle-info icon"></i>Chi tiết</a>
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


  </div>
</section>