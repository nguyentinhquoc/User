<?php

session_start();
include("../global.php");
include("../../model/pdo.php");
include("../../model/sanpham.php");
$price_start = $_POST["price_start"];
$price_end = $_POST["price_end"];
$page = $_POST['page'];
$danhmuc = (int)$_POST['danhmuc'];
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
if (isset($_GET['timkiem'])) {
    $search = $_GET['timkiem'];
}
?>
<div class="swiper-container brand-slider">

    <h5 style="color: red; margin-left:30px ;">Từ khóa tìm kiếm : <?= $search ?></h5>
    <div class="swiper-wrapper_list">
        <?php
        $sanpham_list = sanpham_list($price_start, $price_end, $search, $danhmuc, $page);
        $count_sanpham_list = cout_sanpham_list($price_start, $price_end, $search, $danhmuc);
        $dem = $count_sanpham_list['dem'];
        ?><?php
            foreach ($sanpham_list as $key) { ?>
        <div class="swiper-slide swiper-slide_list" style="height: 230px;">
            <a class="brand-item brand-item-list" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>">
                <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" style="border-radius: 10px;">
            </a>
            <p class="price_sp price_sp_list"><?= number_format($key['price'], 0, ',', '.');  ?>
                <del style="color: #ccc9c2;"><?= number_format($key['price'] + ($key['price'] * ($key['sale'] / 100)), 0, ',', '.');  ?></del>
            </p>
            <p class="name_sp name_sp_list"><?= $key['name'] ?></p>
        </div>
        </a>
    <?php }
    ?>


    </div>
    <div class="page">
        <?php
        if ($dem % 20 == 0) {
            $page = $dem / 20;
        } elseif ($dem % 20 != 0) {
            $page = $dem / 20 + 1;
        }
        ?>
        <?php for ($i = 1; $i < $page; $i++) { ?>
            <a href="index.php?act=sanpham_list&page=<?= $i ?>&danhmuc=<?= $danhmuc ?>&timkiem=<?= $search ?>"><?= $i ?></a>
        <?php } ?>

    </div>
</div>