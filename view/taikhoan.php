<main class="myacc">
    <div class="box_left">
        <?php
        $email = $_SESSION['email_dn'];
        $taikhoan_email = taikhoan_email($email);
        ?>
        <div class="img"><img src="<?= $img_path."avarta_user/".$taikhoan_email['img'] ?>" alt="" width="100px" height="100px" style=" border-radius: 50px;"></div>
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
                        Thông báo</li>
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
                    <p>Địa chỉ:<?= $taikhoan_email['address'] ?></p>
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
            <div class="avatar"><img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="100px" height="100px" style=" border-radius: 50px;"><input type="file" name="avatar">
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
                <label for="">Địa chỉ:</label><br><input type="text" value="<?= $taikhoan_email['address'] ?>" name="address">
                <p></p>
                <button class="submit" name="submit_doitt">Xác nhận đổi thông tin</button>
        </form>
    </div>
<?php
                break;
            case '2': ?>
    <div class="doi_pass">
        <form action="" method="post">

            <label for="">Nhập mật khẩu:</label> <br> <input  type="password" name="pass_old">
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
    <h4>Thông bao</h4>
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
        } ?>



</div>
</main>