<?php
session_start();
include("../global.php");
include("../../model/pdo.php");
include("../../model/sanpham.php");
 $price_start = $_POST["price_start"];
 $price_end = $_POST["price_end"];
// $page = $_POST['page'];
?>
<div class="swiper-container brand-slider">
    <div class="swiper-wrapper_list">
        <?php
        $sanpham_list = sanpham_price_list($price_start, $price_end);
?><?php
                    foreach ($sanpham_list as $key) { ?>
        <div class="swiper-slide swiper-slide_list">
            <a class="brand-item brand-item-list" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>&soluong=1">
                <img src="<?=$img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" style="border-radius: 10px;">
            </a>
            <p class="price_sp price_sp_list"><?= number_format($key['price'], 0, ',', '.');  ?>
                <del style="color: #ccc9c2;"><?= number_format($key['price'] + ($key['price'] * ($key['sale'] / 100)), 0, ',', '.');  ?></del>
            </p>
            <p class="name_sp name_sp_list"><?= $key['name'] ?></p>
            <div class="congcu congcu_list">

                <a href="<?= $_SERVER['REQUEST_URI']; ?>&add_love=<?= $key['id'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                <a href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>&soluong=1"> <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
            </div>

        </div>
        </a>
    <?php } ?>


    </div>
</div>