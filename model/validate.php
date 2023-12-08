<?php
if (isset($_POST['submit_dk'])) {
    $pattern_tel = '/^(03[2-9]|07[0-9]|08[1-9]|09[0-9])[0-9]{7}$/';
    $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $name_dk = $_POST['name_dk'];
    $tel_dk = $_POST['tel_dk'];
    $email_dk = $_POST['email_dk'];
    $pass_dk = $_POST['pass_dk'];
    $repass_dk = $_POST['repass_dk'];
    $address = $_POST['tinh'] . "-" . $_POST['huyen'] . "-" . $_POST['xa'];
    $check_dk = true;
    $taikhoan_all = taikhoan_all();
    foreach ($taikhoan_all as $key) {
        if (isset($key['email']) && isset($key['tel']) && isset($tel_dk) && isset($email_dk)) {
            if ($key['email'] == $email_dk) {
                $err3 = "* Email đã tồn tại";
                $check_dk = false;
            }
            if ($key['tel'] == $tel_dk) {
                $err2 = "* Số điện thoại đã tồn tại";
                $check_dk = false;
            }
        }
    }
    if ($_POST['xa'] == "") {
        $err6 = '* Vui lòng nhập địa chỉ';
        $check_dk = false;
    }
    if (!preg_match($pattern_tel, $tel_dk)) {
        if (isset($tel_dk)) {
            $check_dk = false;
            $err2 = "* Số điện thoại không hợp lệ";
        }
    }
    if (!preg_match($pattern_email, $email_dk)) { 
        if (isset($email_dk)) {
            $check_dk = false;
            $err3 = "* Email không hợp lệ";
        }
    }

    if (isset($name_dk) && $name_dk == "") {
        $err1 = "* Vui lòng nhập họ và tên";
        $check_dk = false;
    }

    if (isset($pass_dk) && $pass_dk == "") {
        $err4 = "* Vui lòng nhập mật khẩu";
        $check_dk = false;
    } elseif (strlen($pass_dk) <= 6) {
        $err4 = "* Mật khẩu phải nhiều hơn 6 ký tự";
    }
    if (isset($repass_dk) && $repass_dk == "") {
        $err5 = "* Vui lòng nhập lại mật khẩu";
        $check_dk = false;
    }
    if ($pass_dk != $repass_dk) {
        $err5 = "* Xác nhận mật khẩu sai !!!";
        $check_dk = false;
    }
    if ($check_dk == true) {

        $sql = "INSERT INTO `taikhoan` (`name`, `pass`, `tel`, `email`,`address`,`img`) VALUES ('$name_dk', '$pass_dk', $tel_dk, '$email_dk','$address','avatar.png');";
        pdo_execute($sql);
        header("Location: index.php?act=dangnhap&dangkytc");
    }
}
// ĐANG NHẬP==============================
if (isset($_POST["submit_dn"])) {
    $email_dn = $_POST['email_dn'];
    $pass_dn = $_POST['pass_dn'];
    $taikhoan_all = taikhoan_all();
    foreach ($taikhoan_all as $key) {
        if (isset($pass_dn) && isset($email_dn)) {
            if ($key['email'] == $email_dn && $key['pass'] == $pass_dn && $key['role'] == 1) {
                if ($key['trangthai'] == 1) {
                    $_SESSION['email_dn'] = $_POST['email_dn'];
                    header("Location: index.php?dangnhaptc");
                    break;
                } elseif ($key['trangthai'] == 0) {
                    header("Location: index.php?act=dangnhap&lock");
                    break;

                }
            } elseif ($key['email'] == $email_dn && $key['pass'] == $pass_dn && $key['role'] == 2) {
                if ($key['trangthai'] == 1) {
                    $_SESSION['email_dn'] = $_POST['email_dn'];
                    header("Location: ../../Admin/View/index.php");
                    break;
                } elseif ($key['trangthai'] == 0) {
                    header("Location: index.php?act=dangnhap&lock");
                    break;

                }
            } elseif ($key['email'] != $email_dn || $key['pass'] != $pass_dn) {
                header("Location: index.php?act=dangnhap&dangnhaptb");
            }
        }
    }
}
// ĐỔI THÔNG TIN=========================
if (isset($_POST['submit_doitt'])) {
    $pattern_tel = '/^(03[2-9]|07[0-9]|08[1-9]|09[0-9])[0-9]{7}$/';
    $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $check_doitt = true;
    $email_new = $_POST['email'];
    $tel_new = $_POST['tel'];
    $email = $_SESSION['email_dn'];
    $taikhoan_email = taikhoan_email($email);
    $tel_old = $taikhoan_email['tel'];
    $email_old = $taikhoan_email['email'];
    $taikhoan_all = taikhoan_all();
    foreach ($taikhoan_all as $key) {
        if ($key['tel'] ==  $tel_new &&  $tel_old != $tel_new) {
            $err_dtt_tel = "* Số điện thoại đã tồn tại";
            $check_doitt = false;
        }
        if ($key['email'] == $email_new && $email_new != $email_old) {
            $err_dtt_email = "* Email đã tồn tại";
            $check_doitt = false;
        }
    }

    if (!preg_match($pattern_tel, $tel_new)) {
        if (isset($tel_new)) {
            $err_dtt_tel = "* Số điện thoại không hợp lệ";
            $check_doitt = false;
        }
    }
    if (!preg_match($pattern_email, $email_new)) {
        if (isset($email_new)) {
            $err_dtt_email = "* Email không hợp lệ";
            $check_doitt = false;
        }
    }
    if ($check_doitt == true) {

        $file = $_FILES['avatar']['tmp_name'];
        $path = "assets/images/avarta_user/" . $_FILES['avatar']['name'];
        move_uploaded_file($file, $path);
        $img_new = $_FILES['avatar']['name'];
        $email_old = $_SESSION['email_dn'];
        $email_new = $_POST['email'];
        $tel_new = $_POST['tel'];
        $address_new = $_POST['address'];
        taikhoan_update($img_new, $email_new, $tel_new, $address_new, $email_old);
        $_SESSION['email_dn'] = $email_new;
        header('location: index.php?act=myaccout&profile=1&doitttc');
    }
}

// Đổi password==================================
if (isset($_POST['submit_doipass'])) {
    $check_doipass = true;
    $pass_old = $_POST['pass_old'];
    $pass_new = $_POST['pass_new'];
    $repass_new = $_POST['repass_new'];
    $email = $_SESSION['email_dn'];
    $taikhoan_email = taikhoan_email($email);
    $email_old = $_SESSION['email_dn'];

    if (isset($pass_old) && $pass_old == "") {
        $err_pass_old = '* Vui lòng nhập mật khẩu';
        $check_doipass = false;
    } elseif (isset($pass_old) && $pass_old != $taikhoan_email['pass']) {
        $err_pass_old = '* Vui lòng nhập đúng mật khẩu';
        $check_doipass = false;
    }
    if (strlen($pass_new) < 6) {
        $err_pass_new = '* Vui lòng nhập mật khẩu mới nhiều hơn 6 ký tự';
        $check_doipass = false;
    }
    if ($pass_new == "") {
        $err_pass_new = '* Vui lòng nhập mật khẩu mới ';
        $check_doipass = false;
    }
    if ($repass_new == "") {
        $err_repass_new = '* Vui lòng nhập mật khẩu mới ';
        $check_doipass = false;
    }
    if ($pass_new != $repass_new) {
        $err_repass_new = '* Vui lòng nhập mật khẩu trùng với mật khẩu mới';
        $check_doipass = false;
    }
    if ($check_doipass == true) {
        doipass($pass_new, $email_old);
        header('location: index.php?act=myaccout&profile=1&doipasstc');
    }
}
