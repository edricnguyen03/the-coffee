<div class="container fixed-container" style="width:fit-content; height:fit-content">
    <div class="row">
        <div class="col-md-6">
            <img src="./resources/images/products/<?php echo $sanPham->thumb_image ?>" alt="" style="height:50%; object-fit: cover">
        </div>
        <div class="col-md-6">
            <h5 class="card-title"><?php echo $sanPham->name ?></h5>
            <p class="card-text"><?php echo $sanPham->description ?></p>
            <p class="card-text"><?php echo $sanPham->content ?></p>
            <p class="card-text text-success text-start" style=" font-weight: bold;">Giá: <?php echo $sanPham->price ?> VND</p>
            <p class="card-text text-start" style=" font-weight: bold;">Khối lượng: <?php echo $sanPham->weight ?> g</p>
        </div>
    </div>
</div>