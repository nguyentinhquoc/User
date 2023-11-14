<main class="container_sanpham_list">
    <div class="box_left">
        <div class="h1_loc"><i class="fa fa-filter" aria-hidden="true"> Bộ lọc sản phẩm</i>
        </div>
        <div class="loc_gia">
            <p class="h2_loc">Chọn giá</p>
            <p>
                <label for="amount">Price range:</label>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            </p>
            <div id="slider-range"></div>
        </div>
        <div class="loc_danhmuc">
            <p class="h2_loc">Chọn Loại giày</p>
            <?php
            $danhmuc_all = danhmuc_all();
            foreach ($danhmuc_all as $key) { ?>
                <input onchange="hien_thi_sp()" type="checkbox" class="chon_ danhmuc" id="<?= $key['name'] ?>" name="<?= $key['name'] ?>" value="<?= $key['name'] ?>">
                <label for="vehicle1"><?= $key['name'] ?></label><br>
            <?php }
            ?>

        </div>
        <div class="loc_size">
            <p class="h2_loc">Chọn size</p>
            <input type="checkbox" id="size" name="vehicle1" value="Size 39">
            <label for="vehicle1"> Size 39</label><br>
            <input type="checkbox" id="size" name="vehicle2" value="Size 40">
            <label for="vehicle2">Size 40</label><br>
            <input type="checkbox" id="size" name="vehicle3" value="Size 41">
            <label for="vehicle3">Size 40</label><br>
        </div>
        <div class="loc_chatluong">
            <p class="h2_loc">Chọn chất lượng</p>
            <input type="checkbox" id="vehicle1" name="vehicle1" value="Nike">
            <label for="vehicle1">
                <?= echo_start_true(1); ?>
                <?= echo_start_false(4); ?>
            </label><br>
            <input type="checkbox" id="vehicle2" name="vehicle2" value="Jordan">
            <label for="vehicle2"><?= echo_start_true(1); ?>
                <?= echo_start_false(4); ?> </label><br>
            <input type="checkbox" id="vehicle3" name="vehicle3" value="MLB">
            <label for="vehicle3"><?= echo_start_true(1); ?>
                <?= echo_start_false(4); ?> </label><br>
            <input type="checkbox" id="vehicle3" name="vehicle3" value="MLB">
            <label for="vehicle3"><?= echo_start_true(1); ?>
                <?= echo_start_false(4); ?> </label><br>
            <input type="checkbox" id="vehicle3" name="vehicle3" value="MLB">
            <label for="vehicle3"><?= echo_start_true(1); ?>
                <?= echo_start_false(4); ?> </label><br>
        </div>
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
                foreach ($sanpham_list as $key) { ?>
                    <div class="swiper-slide swiper-slide_list">
                        <a class="brand-item brand-item-list" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>">
                            <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" style="border-radius: 10px;">
                        </a>
                        <p class="price_sp price_sp_list"><?= $key['price'] ?></p>
                        <p class="name_sp name_sp_list"><?= $key['name'] ?></p>
                        <div class="congcu congcu_list">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                          <?php  $page = $_GET['page'];
                          ?>

                            <a href="index.php?act=sanpham_list&page=<?= $page ?>&add_love=<?= $key['id'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>

                    </div>
                    </a>
                <?php }

                if (isset($_SESSION['email_dn'])) {
                    $email = $_SESSION['email_dn'];
                    $sql = "SELECT id FROM taikhoan WHERE email='$email'";
                    $id_acc = pdo_query_one($sql);
                    $iduser=$id_acc['id'];
                    if (isset($_GET['add_love'])) {
                        $idsp = $_GET['add_love'];
                        
                        yeuthich_add($idsp, $iduser);

                    }
                }
                ?>
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

            if ($tong_sanpham['dem'] % 12 == 0) {
                $so_page = $tong_sanpham['dem'] / 12;
            } else {
                $so_page = $tong_sanpham['dem'] / 12 + 1;
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