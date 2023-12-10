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
if (isset($_GET['delete_love'])) {
    echo $delete_love = $_GET['delete_love'];
    echo $iduser;
    echo  $sql12 = "DELETE phanloaidh FROM phanloaidh JOIN bienthe ON bienthe.id = phanloaidh.bienthe WHERE phanloaidh.iduser = $iduser AND bienthe.idsp = $delete_love AND phanloaidh.idtrangthai = 1;";
    pdo_execute($sql12);
    header("Location: index.php?act=sanpham_chitiet&id=$delete_love ");
}
?>
<main class="sanpham_chitiet">
    <?php
    $idsp = $_GET["id"];
    $update_luotxem = "UPDATE `sanpham` SET `luotxem` = `luotxem`+1 WHERE `sanpham`.`id` = $idsp;";
    pdo_execute($update_luotxem);


    $sanpham_chitiet = sanpham_chitiet($idsp);
    ?>
    <div class="top">
        <div class="box box_left"><img src="<?= $img_path . "sanpham/" . $sanpham_chitiet['img'] ?>" alt=""></div>
        <div class="box box_center">
            <div class="name">
                <h3><?= $sanpham_chitiet['name'] ?>

                    <?php
                    if (isset($_SESSION['email_dn'])) {
                        $sql = "SELECT phanloaidh.id FROM phanloaidh JOIN bienthe ON bienthe.id=phanloaidh.bienthe JOIN sanpham ON sanpham.id=bienthe.idsp WHERE sanpham.id= $idsp and phanloaidh.iduser=$iduser and phanloaidh.idtrangthai=1";
                        $check_love = pdo_query_one($sql);
                    }
                    if (empty($check_love)) { ?>
                        <a href="<?= $_SERVER['REQUEST_URI']; ?>&add_love=<?= $sanpham_chitiet['id'] ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                    <?php  } else { ?>
                        <a href="<?= $_SERVER['REQUEST_URI']; ?>&delete_love=<?= $sanpham_chitiet['id'] ?>"><i style="color: red;" class="fa fa-heart" aria-hidden="true"></i>
                            </i></a>

                    <?php
                    }
                    ?>

                </h3>
                <?php
                $sql_danhgia = "SELECT AVG(danhgia.danhgia) 'chatluong' FROM `danhgia` JOIN bienthe ON danhgia.idbienthe=bienthe.id JOIN sanpham ON sanpham.id=bienthe.idsp where sanpham.id =  $idsp ";
                $sql_danhgia = pdo_query_one($sql_danhgia);
                $star = $sql_danhgia['chatluong'];
                ?>
            </div>
            <div class="danhgia">Đánh giá: <?php if (!empty($sql_danhgia['chatluong'])) {
                                                echo_star($star);
                                            } else {
                                                echo "Chưa có đánh giá !";
                                            } ?></div>
            <div class="ma">Mã mặt hàng:<?= $sanpham_chitiet['masp'] ?></div>
            <div class="soluong">
                <?php
                $sqlsoluong = "SELECT SUM(bienthe.soluong) AS 'soluong' FROM `bienthe` WHERE idsp=$idsp";
                $loadsl = pdo_query_one($sqlsoluong);
                ?>
                <p class="sl">Số lượng: <?= $loadsl['soluong'] ?> </p>
                <?php
                if ($loadsl['soluong'] > 0) {
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
                    <li style="color:#0B5717;">Miễn phí vận chuyển</li>
                </ul>
            </div>
            <form action="index.php?act=sanpham_chitiet&id=<?= $idsp ?>" method="post">
                <?php
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
                            <label for="<?= $value['color'] ?>" onclick="chon_bt_color(<?= $value['id'] ?>,<?= $idsp ?>)"><?= $value['color'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <div class="size">Size:
                    <?php
                    $all_size = all_size();
                    if (empty($all_size)) {
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
    if (!isset($_SESSION['email_dn']) && (isset($_POST['add_cart_chitiet']) || isset($_GET['add_love']) || isset($_POST['dat_chitiet']))) {
        header("Location: index.php?act=dangnhap&chuadn");
    }

    if (isset($_POST['add_cart_chitiet']) && isset($_POST['color']) && isset($_POST['size']) && isset($_SESSION['email_dn'])) {
        if ($loadsl['soluong'] > 0) {
            $idsp = $_POST["id"];
            $taikhoan_email = taikhoan_email($email);
            $iduser = $taikhoan_email['id'];
            $gia_sp = $sanpham_chitiet['price'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $sql = "SELECT soluong FROM bienthe where idcolor=$color AND idsize =$size AND idsp=$idsp";
            $soluongmax = pdo_query_one($sql);
            $soluong = $_POST['soluong'];
            if ($soluongmax['soluong'] < $soluong) {
                $soluong = $soluongmax['soluong'];
            }
            $bienthe_check = timbienthe($idsp, $color, $size);
            $bienthe = $bienthe_check['id'];
            add_gio($iduser, $soluong, $bienthe);
            header("Location: index.php?act=sanpham_chitiet&id=$idsp&addgiotc");
        }
    } elseif (isset($_POST['add_cart_chitiet']) && isset($_SESSION['email_dn']) && (!isset($_POST['color']) || !isset($_POST['size']))) {
        $idsp = $_POST["id"];
        header("Location: index.php?act=sanpham_chitiet&id=$idsp&addgiotb");
    }
    ?>
    <?php
    if (isset($_POST['dat_chitiet']) && isset($_POST['color']) && isset($_POST['size']) && isset($_SESSION['email_dn'])) {
        if ($loadsl['soluong'] > 0) {
            $idsp = $_POST["id"];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $sql = "SELECT soluong FROM bienthe where idcolor=$color AND idsize =$size AND idsp=$idsp";
            $soluongmax = pdo_query_one($sql);
            $soluong = $_POST['soluong'];
            if ($soluongmax['soluong'] < $soluong) {
                $soluong = $soluongmax['soluong'];
            }
            $_SESSION['dathang'][] = [
                'idsp' => $idsp,
                'color' => $color,
                'size' => $size,
                'soluong' => $soluong
            ];
            header("Location: index.php?act=giohang");
        }
    } elseif (isset($_POST['add_cart_chitiet']) && isset($_SESSION['email_dn']) && (!isset($_POST['color']) || !isset($_POST['size']))) {
        $idsp = $_POST["id"];
        header("Location: index.php?act=sanpham_chitiet&id=$idsp&addgiotb");
    }
    ?>
    <div style="margin: 50px 0px 10px 100px;">
        <button style="boder: 0px; background-color: #72cbf7; color: white ; padding:10px 50px;" id="button1" onclick="showText('binhluan')">Bình luận</button>
        <button style="boder: 0px; background-color: #f0b071; color: white ; padding:10px 50px;" id="button2" onclick="showText('danhgia')">Đánh giá</button>
    </div>
    <div id="binhluan">
        <div class="btom" style="margin-top: 0px;">
            <h3>Bình Luận</h3>
            <div style="  height: 400px; 
            overflow-y: scroll; ">
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
                                header("Location: index.php?act=sanpham_chitiet&id=$idsp&bltc");
                            }
                            ?>
                        </div>
                    </div>
                <?php  }
                ?>
                <?php
                $hienthi_binhluan = hienthi_binhluan($idsp);
                if (empty($hienthi_binhluan)) {
                    echo '
                <u style="color: #3498db; font-size: 40px; font-weight: bolder;" href="">Không có bình luận</u>
                   ';
                }
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
            </div>
        </div>
    </div>
    <div id="danhgia" style="display: none;">
        <div class="btom" style="margin-top: 0px;">
            <h3>Đánh giá</h3>
            <div style="  height: 400px; 
            overflow-y: scroll; ">
                <?php
                $hienthi_danhgia = pdo_query("SELECT taikhoan.name,taikhoan.img,danhgia.binhluan,danhgia.danhgia FROM `danhgia` JOIN taikhoan ON danhgia.iduser=taikhoan.id JOIN bienthe ON bienthe.id=danhgia.idbienthe JOIN sanpham ON bienthe.idsp=sanpham.id where sanpham.id=$idsp; ");
                if (empty($hienthi_danhgia)) {
                    echo '
                <u style="color: #3498db; font-size: 40px; font-weight: bolder;" href="">Không có đánh giá cho sản phẩm này</u>
                   ';
                }
                foreach ($hienthi_danhgia as $key) { ?>
                    <div class="item">
                        <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $key['img'] ?>" alt="" width="100px" height="100px" style="margin: 10px;">
                        </div>
                        <div class="content">
                            <h5><?= $key['name'] ?> <?php echo_star($key['danhgia']) ?> </h5>
                            <p><?= $key['binhluan'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function showText(elementId) {
            // Ẩn tất cả các văn bản
            document.getElementById('binhluan').style.display = 'none';
            document.getElementById('danhgia').style.display = 'none';

            // Hiển thị văn bản tương ứng với nút được click
            document.getElementById(elementId).style.display = 'block';
        }
    </script>


</main>