<?php
if (isset($_POST['submit_dk'])) {
    $pattern_tel = '/^(03[2-9]|07[0-9]|08[1-9]|09[0-9])[0-9]{7}$/';
    $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $name_dk = $_POST['name_dk'];
    $tel_dk = $_POST['tel_dk'];
    $email_dk = $_POST['email_dk'];
    $pass_dk = $_POST['pass_dk'];
    $repass_dk = $_POST['repass_dk'];
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

    if (!preg_match($pattern_tel, $tel_dk)) { // check_dk không đúng định dạng
        if (isset($tel_dk)) {
            $check_dk = false;
            $err2 = "* Số điện thoại không hợp lệ";
        }
    }
    if (!preg_match($pattern_email, $email_dk)) { // check_dk không đúng định dạng
        if (isset($tel_dk)) {
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
    }elseif(strlen($pass_dk) <= 6){
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
        $sql = "INSERT INTO `taikhoan` (`name`, `pass`, `tel`, `email`) VALUES ('$name_dk', '$pass_dk', $tel_dk, '$email_dk');";
        pdo_execute($sql);
        header("Location: index.php?act=dangnhap&dangkytc");
    }
}


