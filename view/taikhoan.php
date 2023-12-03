<main class="myacc">
    <div class="box_left">
        <?php
        $email = $_SESSION['email_dn'];
        $taikhoan_email = taikhoan_email($email);
        ?>
        <div class="img"><img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="100px" height="100px" style=" border-radius: 50px;"></div>
        <div class="list">
            <ul>
                <a href="index.php?act=myaccout&profile=1">
                    <li> <i class="fa fa-user-o" aria-hidden="true"></i>
                        Hồ sơ</li>
                </a>
                <a href="index.php?act=myaccout&profile=2">
                    <li><i class="fa fa-key" aria-hidden="true"></i>Đổi mật khẩu</li>
                </a>
                <a href="index.php?act=myaccout&profile=3">
                    <li><i class="fa fa-bell-o" aria-hidden="true"></i>
                        Đơn hàng</li>
                </a>
                <a href="index.php?act=myaccout&profile=4">
                    <li><i class="fa fa-ticket" aria-hidden="true"></i>Vocher</li>
                </a>
            </ul>
        </div>
    </div>
    <div class="box_right">
        <?php if (isset($_GET['profile'])) {
            $profile = $_GET['profile'];
        } else {
            header('location: index.php?act=404');
        }
        switch ($profile) {
            case '1': ?>
                <?php

                ?>

                <div class="profile">
                    <div class="avatar"><img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="100px" height="100px" style=" border-radius: 50px; ;">
                    </div>
                    <p>Họ tên: <?= $taikhoan_email['name'] ?></p>
                    <p>Email: <?= $taikhoan_email['email'] ?></p>
                    <p>Số điện thoại: <?= $taikhoan_email['tel'] ?></p>
                    <p>Địa chỉ: <?= $taikhoan_email['address'] ?></p>
                </div>
                <a class="link_edit" href="index.php?act=myaccout&profile=edit">Chỉnh sửa hồ sơ</a>
    </div>
<?php
                break;
            case 'edit': ?>
    <div class="edit">
        <?php

        ?>
        <form action="index.php?act=myaccout&profile=edit" enctype="multipart/form-data" method="post">
            <div class="avatar">
                <img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="100px" height="100px" style=" border-radius: 50px;">
                <input type="file" name="avatar">
                <br> <label for="">Họ và tên:</label> <br>
                <p style="border: 1px solid;  border-radius: 10px;width: 280px; padding: 5px;"><?= $taikhoan_email['name'] ?></p>
                <p></p>
                <label for=""> Email:</label><br> <input type="email" value="<?= $taikhoan_email['email'] ?>" name="email">
                <p style="color: red;"><?php
                                        if (isset($err_dtt_email)) {
                                            echo $err_dtt_email;
                                        } ?></p>
                <label for="">Số điện thoại:</label><br><input type="tel" value="<?= $taikhoan_email['tel'] ?>" name="tel">
                <p style="color: red;"><?php
                                        if (isset($err_dtt_tel)) {
                                            echo $err_dtt_tel;
                                        } ?></p>
                <label for="">Địa chỉ:</label> <br>
                <p style="border: 1px solid;  border-radius: 10px;width: 280px; padding: 5px;"><?= $taikhoan_email['address'] ?></p>
                <p></p>
                <p></p>
                <button class="submit" name="submit_doitt">Xác nhận đổi thông tin</button>
        </form>
    </div>
<?php
                break;
            case '2': ?>
    <div class="doi_pass">
        <form action="" method="post">

            <label for="">Nhập mật khẩu:</label> <br> <input type="password" name="pass_old">
            <p style="color: red;"><?php
                                    if (isset($err_pass_old)) {
                                        echo $err_pass_old;
                                    } ?></p>
            <label for=""> Nhập mật khẩu mới:</label><br> <input type="password" name="pass_new">
            <p style="color: red;"><?php
                                    if (isset($err_pass_new)) {
                                        echo $err_pass_new;
                                    } ?></p>
            <label for="">Nhập lại mật khẩu mới:</label><br><input type="password" name="repass_new">
            <p style="color: red;"><?php
                                    if (isset($err_repass_new)) {
                                        echo $err_repass_new;
                                    } ?></p>
            <button class="submit" name="submit_doipass">Đổi mật khẩu</button>
        </form>
    </div>
<?php
                break;
            case '3': ?>
    <h4>Đơn mua</h4>
    <div class="menu">
        <a href="index.php?act=myaccout&profile=3&trangthai=3">Chờ xác nhận</a>
        <a href="index.php?act=myaccout&profile=3&trangthai=4">Đang giao hàng</a>
        <a href="index.php?act=myaccout&profile=3&trangthai=5">Đã nhận hàng</a>
    </div>

    <div class="donhang">
        <?php
                if (isset($_GET['trangthai'])) {
                    $idtrangthai = $_GET['trangthai'];
                } else {
                    $idtrangthai = 3;
                }
                $load_chitietdh = load_chitietdh($email, $idtrangthai);
                foreach ($load_chitietdh as $key2 => $value1) {
                    $tongtiehoadon = 0;
                    $madonhang = $value1['madh']; ?>
            <div class="donhangct">
                <div class="top">
                    <p style="color:red;">Mã đơn hàng: <?= $madonhang ?> </p>
                    <p style="color:green;">Trạng thái: <?php
                                                        switch ($idtrangthai) {
                                                            case 3:
                                                                echo "Chờ xác nhận";
                                                                break;

                                                            case 4:
                                                                echo "Đang giao hàng";
                                                                break;

                                                            case 5:
                                                                echo "Chờ xác nhận";
                                                                break;
                                                        }
                                                        ?></p>
                </div>
                <?php $load_chitietdh_sp = load_chitietdh_sp($madonhang);
                    foreach ($load_chitietdh_sp as $key1 => $value2) { ?>

                    <div class="item">
                        <img src="<?= $img_path . 'sanpham/' . $value2['img'] ?>" alt="" width="100px">
                        <div class="content" style="width: 80%;">
                            <h4><?= $value2['name'] ?></h4>
                            <p>Biến thể sản phẩm : <?= 'Size' . $value2['size'] . ',' . $value2['color'] ?></p>
                            <p>Số lượng: <?= $value2['soluong'] ?></p>
                        </div>
                        <div class="gia"><?= number_format($value2['price'] * $value2['soluong'], 0, ',', '.') . 'đ' ?></div>
                    </div>
                        <?php
                            if ($idtrangthai == 5 && $value2['danhgia'] == 0) {
                        ?>
                            <a style="border-radius: 10px; color: white; padding: 10px 20px; background-color: red; margin-left: 550px;" href="index.php?act=danhgia&idbt=<?=$value2['idbt']?>&idpl=<?=$value2['idpl']?>">Đánh giá</a>
    
                        <?php } ?>


                <?php $tongtiehoadon += $value2['price'] * $value2['soluong'];
                    }
                ?>
                <hr>
                <table>
                    <tr>
                        <td>Tổng tiền hàng :</td>
                        <td style="width: 10%;"><?= number_format($tongtiehoadon, 0, ',', '.'); ?>đ</td>

                    </tr>
                    <tr>
                        <td>Vocher :</td>
                        <td><?= number_format(-$value2['sale'], 0, ',', '.'); ?>đ</td>
                    </tr>
                    <tr>
                        <td>Thành tiền :</td>
                        <td style="color:red; font-size: larger; font-weight: bolder;"><?= number_format($value2['thanhtien'], 0, ',', '.'); ?>đ</td>

                    </tr>
                </table>
            </div>
            <?php
                    if ($idtrangthai == 3) {
            ?>
                <a style="border-radius: 10px; color: white; padding: 10px 20px; background-color: blueviolet;" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này ?')" href="index.php?act=myaccout&profile=3&trangthai=3&huydonhang=<?= $madonhang ?>">Hủy đơn hàng</a>
        <?php

                    }
                }
        ?>
        <?php
                if (isset($_GET['huydonhang'])) {
                    $huydonhang = $_GET['huydonhang'];
                    $sql1 = "DELETE FROM phanloaidh WHERE `phanloaidh`.`madh` = $huydonhang";
                    $sql2 = "DELETE FROM chitietdh WHERE `chitietdh`.`madh` = $huydonhang";
                    pdo_execute($sql1);
                    pdo_execute($sql2);
                    header('Location: index.php?act=myaccout&profile=3&trangthai=3&huydonhangtc');
                }
        ?>
    </div>
<?php
                break;
            case '4': ?>
    <h4>Vocher</h4>
    <div class="thongbao">
        <div class="item">
            <img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="100px" height="100px">
            <div class="content">
                <h5>heder</h5>
                <p>Nội dung</p>
            </div>
        </div>
    </div>
<?php
                break;
            case '5': ?>
    <h4>Vocher</h4>
    <div class="chat">
        <div class="item">
            <div class="admin">
                <p class="chat">ADMIN</p>
                <p>21-11-2023</p>
            </div>
            <div class="user">
                <p class="chat">USERssssssssssssssssssssssssssssssssssssss</p>
                <p>21-11-2023</p>
            </div>
        </div>
    </div>
    </div>
<?php
                break;
        } ?>



</div>
</main>