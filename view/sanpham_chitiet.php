<?php
if (isset($_SESSION['email_dn'])) {
    $email = $_SESSION['email_dn'];
    $sql = "SELECT id FROM taikhoan WHERE email='$email'";
    $id_acc = pdo_query_one($sql);
    $iduser = $id_acc['id'];

    if (isset($_GET['add_love'])) {
        $idsp = $_GET['add_love'];
        yeuthich_add($idsp, $iduser);
        header("Location: index.php?act=sanpham_chitiet&id=$idsp");
    }
};
?>
<main class="sanpham_chitiet">
    <?php
    $idsp = $_GET["id"];
    $sanpham_chitiet = sanpham_chitiet($idsp);
    ?>
    <div class="top">
        <div class="box box_left"><img src="<?= $img_path . "sanpham/" . $sanpham_chitiet['img'] ?>" alt=""></div>
        <div class="box box_center">
            <div class="name">
                <h3><?= $sanpham_chitiet['name'] ?></h3>
                <?php $star = $sanpham_chitiet['star'] ?>
            </div>
            <div class="danhgia">Đánh giá: <?php if (!empty($sanpham_chitiet['star'])) {
                                                echo_star($star);
                                            } else {
                                                echo "Chưa có đánh giá !";
                                            } ?></div>
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
                <p class="gia_sale"><?= number_format($sanpham_chitiet['price'], 0, ',', '.');  ?></p>
                <p class="gia_goc"><del><?= number_format($sanpham_chitiet['price'] + ($sanpham_chitiet['price'] * ($sanpham_chitiet['sale'] / 100)), 0, ',', '.');  ?></del></p>
            </div>
            <div class="uudai">
                <ul>
                    <h4 style="color:red;">Thông tin ưu đãi</h4>
                    <li style="color:#0B5717;">Tặng thêm một đôi tất nike</li>
                    <li style="color:#0B5717;">Tặng thêm một dây giày</li>
                    <li style="color:#0B5717;">Tặng thêm một lọ vệ sinh giày</li>
                    <li style="color:#0B5717;">DMiễn phí vận chuyển</li>
                </ul>
            </div>
            <form action="index.php?act=sanpham_chitiet" method="get">
                <?php
                // $soluong = $_GET['soluong'];
                ?>
                <input type="hidden" name="id" value="<?= $idsp ?>">
                <input type="hidden" name="act" value="sanpham_chitiet">

                <div class="mau">Màu:
                    <?php
                    $all_color = all_color();
                    foreach ($all_color as $key => $value) {
                    ?>
                        <div class="custom-radio" id="color">
                            <input type="radio" id="<?= $value['color'] ?>" name="color" value="<?= $value['id'] ?>" onclick="chon_bt_color(<?= $value['id'] ?>,<?= $idsp ?>)">
                            <label for="<?= $value['color'] ?>" onclick="chon_bt_color(<?= $value['id'] ?>,,<?= $idsp ?>)"><?= $value['color'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <div class="size">Size:
                    <?php
                    $all_size = all_size();
                        if(empty($all_size)){
                            echo '
                    <p style="border: 1px solid; text-align: center; width: 200px; height: 45px; padding-top: 10px; margin-left: 20px; color: red;">HẾT SIZE</p>
                    ';
                        }
                        
                    foreach ($all_size as $key => $value) {

                    ?>
                    
                        <div class="custom-radio" id="size">
                            <input type="radio" id="<?= $value['size'] ?>" name="size" value="<?= $value['id'] ?>"">
        <label for=" <?= $value['size'] ?>"><?= $value['size'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <script>
                    function chon_bt_color(color, idsp) {

                        $.post("ajax/sanpham_ct_chon_mau.php", {
                            idsp: idsp,
                            color: color,
                        }, function(data) {
                            $(".size").html(data);
                        });
                    }
                </script>
                <div class="soluongmua">
                    <p style="margin-right: 20px;">Số lượng: </p>

                    <input type="number" name="soluong" value="1" min="1" style="width: 50px; border-radius: 10px; border-color: #3498db;">

                </div>
                <a href="<?= $_SERVER['REQUEST_URI']; ?>&add_love=<?= $sanpham_chitiet['id'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                <div class="buttom">
                    <button class="add_gio" name="add_cart_chitiet">Thêm vào giỏ hàng <i style="font-size: larger; color: #0B5717;" class="fa fa-cart-plus" aria-hidden="true"></i>
                    </button>
                    <button class="dat" name="dat_chitiet">Đặt ngay</button>
                </div>
            </form>

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
    <?php
    $sanpham_chitiet['price'];
    if (isset($_GET['add_cart_chitiet']) and isset($_SESSION['email_dn'])) {
        if ($sanpham_chitiet['soluong'] > 0) {
            $taikhoan_email = taikhoan_email($email);
            $iduser = $taikhoan_email['id'];
            $gia_sp = $sanpham_chitiet['price'];
            $idsp = $_GET["id"];
            $color = $_GET['color'];
            $size = $_GET['size'];
            $sql = "SELECT soluong FROM bienthe where idcolor=$color AND idsize =$size AND idsp=$idsp";
            $soluongmax = pdo_query_one($sql);
            $soluong = $_GET['soluong'];
            if ($soluongmax['soluong'] < $soluong) {
                $soluong = $soluongmax['soluong'];
            }
            $bienthe_check = timbienthe($idsp, $color, $size);
            $bienthe = $bienthe_check['id'];
            echo $bienthe;
            add_gio($iduser, $soluong, $bienthe);
            header("Location: index.php?act=sanpham_chitiet&id=$idsp");
        }
    }
    ?>

    <div class="btom">
        <h3>Bình Luận</h3>
        <?php
        $hienthi_binhluan = hienthi_binhluan($idsp);
        foreach ($hienthi_binhluan as $key) { ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $key['img'] ?>" alt="" width="100px" height="100px" style="margin: 10px;">
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
            $iduser = $taikhoan_email['id'];

        ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" height="100px" width="100px" style="margin: 10px;">
                </div>
                <div class="content">
                    <h5><?= $taikhoan_email['name'] ?></h5><br>
                    <form action="index.php?act=sanpham_chitiet&id=<?= $idsp ?>" method="post">
                        <input style="width: 90%;" type="text" name="comment" id="" placeholder="Nhập binh luận">
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