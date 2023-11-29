<?php
if (isset($_SESSION['email_dn'])) {
    $email = $_SESSION['email_dn'];
    $sql = "SELECT id FROM taikhoan WHERE email='$email'";
    $id_acc = pdo_query_one($sql);
    $iduser = $id_acc['id'];

    if (isset($_GET['add_love'])) {
        $idsp = $_GET['add_love'];
        yeuthich_add($idsp, $iduser);
    }
    if (isset($_GET['add_cart'])) {
        $idsp = $_GET['add_cart'];
        cart_add($idsp, $iduser);
    }
};
$sql="SELECT MIN(price) AS gia_min, MAX(price) AS gia_max
FROM sanpham;";
$mimax=pdo_query_one($sql);
?>

<main class="container_sanpham_list">
    <div class="box_left">
        <input type="text" class="alo">
        <script>
            $(function() {
                $("#slider-range").slider({
                    range: true,
                    min: <?=$mimax['gia_min']?>,
                    max: <?=$mimax['gia_max']?>,
                    values: [<?=$mimax['gia_min']?>, <?=$mimax['gia_max']?>],
                    slide: function(event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        $.post("ajax/locgia.php", {
                            price_start: ui.values[0],
                            price_end: ui.values[1],
                            page : 1
                        }, function(data) {
                            $(".box_right").html(data);
                        });
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                    " - $" + $("#slider-range").slider("values", 1));
                $.post("ajax/locgia.php", {
                    price_start: $("#slider-range").slider("values", 0),
                    price_end: $("#slider-range").slider("values", 1)
                }, function(data) {
                    $(".box_right").html(data);
                });
            });
        </script>
        <p>
            <label for="amount">Giá từ:</label>
            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
        </p>

        <div id="slider-range"></div>
    </div>
    <div class="box_right">
        <div class="swiper-container brand-slider">
            <div class="swiper-wrapper_list">
                <?php
                $page = $_GET['page'];
                if (isset($_GET['danhmuc'])) {
                    $danhmuc = $_GET['danhmuc'];
                    $sanpham_list = sanpham_dm_list($page, $danhmuc);
                } else {
                    $sanpham_list = sanpham_all_list($page);
                }
                if (isset($_SESSION['search']) && $_SESSION['search'] != "") {
                    $check_page = 1;
                    $search = $_SESSION['search'];
                    $sanpham_list = sanpham_search_list($search);
                    unset($_SESSION['search']);
                } ?><?php
                    foreach ($sanpham_list as $key) { ?>
                <div class="swiper-slide swiper-slide_list">
                    <a class="brand-item brand-item-list" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>&soluong=1">
                        <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" style="border-radius: 10px;">
                    </a>
                    <p class="price_sp price_sp_list"><?= number_format($key['price'], 0, ',', '.');  ?>
                        <del style="color: #ccc9c2;"><?= number_format($key['price'] + ($key['price'] * ($key['sale'] / 100)), 0, ',', '.');  ?></del>
                    </p>
                    <p class="name_sp name_sp_list"><?= $key['name'] ?></p>
                    <?php $page = $_GET['page'];
                    ?>
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
        <div class="page">
            <?php
            if (isset($_GET['danhmuc'])) {
                $danhmuc = $_GET['danhmuc'];
                $tong_sanpham = tong_dm_sanpham($danhmuc);
                $link = "index.php?act=sanpham_list&danhmuc=$danhmuc";
            } else {
                $tong_sanpham = tong_all_sanpham();
                $link = "index.php?act=sanpham_list";
            }

            if ($tong_sanpham['dem'] % 20 == 0) {
                $so_page = $tong_sanpham['dem'] / 20;
            } else {
                $so_page = $tong_sanpham['dem'] / 20 + 1;
            }

            for ($i = 1; $i < $so_page; $i++) {
                $page_ht = $_GET['page'];
            ?>
                <a href=" <?= $link . "&page=$i" ?>" <?php if ($page_ht == $i) {
                                                            echo 'class="number_page_ht"';
                                                        } else {
                                                            echo 'class="number_page"';
                                                        } ?>><?= $i ?></a>
            <?php } ?>

        </div>
    </div>
</main>