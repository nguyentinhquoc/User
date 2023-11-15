<main class="sanpham_chitiet">
    <?php
    $idsp = $_GET["id"];
    $sanpham_chitiet = sanpham_chitiet($idsp);
    ?>
    <div class="top">
        <div class="box box_left"><img src="<?= $img_path . "sanpham/" . $sanpham_chitiet['img'] ?>" alt=""></div>
        <div class="box box_center">
            <div class="name">
                <h3><?=$sanpham_chitiet['name'] ?></h3>
                <?php $star=$sanpham_chitiet['star'] ?>
            </div>
            <div class="danhgia">Đánh giá: <?php if (!empty($sanpham_chitiet['star'])) {
               echo_star($star);
            } else{ echo "Chưa có đánh giá !"; }?></div>
            <div class="ma">Mã mặt hàng: MA<?= $sanpham_chitiet['id'] ?></div>
            <div class="soluong">
                <p class="sl">Số lượng: <?= $sanpham_chitiet['soluong'] ?> </p>
                <?php
                if ($sanpham_chitiet['soluong'] > 0) {
                    echo '   <p class="tinhtrang" style="color:green;">Còn hàng</p> ';
                } else {
                    echo '   <p class="tinhtrang" style="color:red;">Hết hàng</p> ';
                }
                ?>
            </div>
            <div class="price">
                <p class="gia_sale"><?= $sanpham_chitiet['price'] ?></p>
                <p class="gia_goc"><del><?= $sanpham_chitiet['price'] ?></del></p>
            </div>
            <div class="uudai">
                <ul>
                    <h4 style="color:red;">Thông tin ưu đãi</h4>
                    <li style="color:#0B5717;">Tặng thêm một đôi tất nike</li>
                    <li style="color:#0B5717;">Tặng thêm một dây giày</li>
                    <li style="color:#0B5717;">Tặng thêm một lọ vệ sinh giày</li>
                    <li style="color:#0B5717;">Miễn phí vận chuyển</li>
                </ul>
            </div>
            <div class="mau">Màu </div>
            <div class="size">Size</div>
            <div class="soluongmua">Số lượng:</div>
            <div class="buttom">
                <button class="add_gio">Thêm vào giỏ hàng <i style="font-size: larger; color: #0B5717;" class="fa fa-cart-plus" aria-hidden="true"></i>
                </button>
                <button class="dat">Đặt ngay</button>
            </div>
        </div>
        <div class="box box_right">

            <h6>Sản phẩm liên quan</h6>
            <?php
            $sanpham_lienquan = sanpham_lienquan($idsp);
            foreach ($sanpham_lienquan as $key) { ?>
                    <a href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>">

                <div class="item">
                    <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="" width="50px" height="60px">
                    <div class="tt">
                        <p class="name" style="margin-bottom: 0px;"><?= $key['name'] ?> </p>
                        <p class="price"><?= $key['price'] ?></p>
                    </div>
                </div>
                </a>
            <?php } ?>

        </div>
    </div>
    <div class="btom">
        <h3>Bình Luận</h3>
        <?php
        $hienthi_binhluan = hienthi_binhluan($idsp);
        foreach ($hienthi_binhluan as $key) { ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $key['img'] ?>" alt="" width="100px" height="100px" style="margin: 10px;" >
                </div>

                <div class="content">
                    <h5><?= $key['name'] ?></h5>
                    <p><?= $key['comment'] ?></p>
                    <p class="date"><?= $key['date'] ?></p>

                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['email_dn'])) {
            $email = $_SESSION['email_dn'];
            $taikhoan_email = taikhoan_email($email);
            $iduser = $taikhoan_email['id']

        ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" height="100px" width="100px" style="margin: 10px;">
                </div>
                <div class="content">
                    <h5><?= $taikhoan_email['name'] ?></h5><br>
                    <form action="index.php?act=sanpham_chitiet&id=<?= $idsp ?>" method="post">
                        <input type="text" name="comment" id="" placeholder="Nhập binh luận">
                        <button name="submit_comment">Bình luận</button>
                    </form>
                    <?php
                    if (isset($_POST['submit_comment'])) {
                        $comment = $_POST['comment'];
                        upload_binhluan($idsp, $iduser, $comment);
                        header("Location: index.php?act=sanpham_chitiet&id=$idsp");
                    }
                    ?>
                </div>
            </div>
        <?php  }
        ?>

    </div>
</main>