<?php
function taikhoan_all()
{
    $sql = "SELECT * FROM taikhoan";
    $taikhoan_all = pdo_query($sql);
    return $taikhoan_all;
}
function taikhoan_email($email)
{
    $sql = "SELECT * FROM taikhoan where email='$email'";
    $taikhoan_email = pdo_query_one($sql);
    return $taikhoan_email;
}
function taikhoan_update($img_new, $email_new, $tel_new, $address_new, $email_old)
{
    if (!empty($img_new)) {
        $sql = "UPDATE `taikhoan` SET `email` = '$email_new', `address` = '$address_new', `tel` = '$tel_new' , `img` = '$img_new' WHERE `taikhoan`.`email` = '$email_old';";
    } else {
        $sql = "UPDATE `taikhoan` SET `email` = '$email_new', `address` = '$address_new', `tel` = '$tel_new'   WHERE `taikhoan`.`email` = '$email_old';";
    }
    $taikhona_update = pdo_execute($sql);
    return $taikhona_update;
}
function doipass($pass_new, $email_old)
{
    $sql = "UPDATE `taikhoan` SET `pass` = '$pass_new' WHERE `taikhoan`.`email` = '$email_old';";
    $doipass = pdo_execute($sql);
    return $doipass;
}
function check_mail($email)
{
    $sql = "SELECT * FROM taikhoan where email='$email'";
    $taikhoan = pdo_query_one($sql);
    if ($taikhoan) {
        sendMailPass($email, $taikhoan['name'], $taikhoan['pass']);
        header('location: index.php?act=dangnhap&laylaipasstc');

    } else {
        header('location: index.php?act=quenpass&laylaipasstb');

    }
}
function sendMailPass($email, $username, $pass) {
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '0d0ac322a05dfe';                     //SMTP username
        $mail->Password   = 'c4e63b8661d36b';                               //SMTP password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nguyentinh1403u@example.com', 'DuAnMau');
        $mail->addAddress($email, $username);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Trang quên mật khẩu';
        $mail->Body    = 'Mau khau cua ban la: ' .$pass;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

