<?php 
function taikhoan_all(){
    $sql="SELECT * FROM taikhoan";
    $taikhoan_all=pdo_query($sql);
    return $taikhoan_all;
}
function taikhoan_email($email){
    $sql="SELECT * FROM taikhoan where email='$email'";
    $taikhoan_email=pdo_query_one($sql);
    return $taikhoan_email;
}
function taikhoan_update($img_new,$email_new,$tel_new,$address_new,$email_old){
    if (!empty($img_new)) {
        $sql="UPDATE `taikhoan` SET `email` = '$email_new', `address` = '$address_new', `tel` = '$tel_new' , `img` = '$img_new' WHERE `taikhoan`.`email` = '$email_old';";
    }else{
        $sql="UPDATE `taikhoan` SET `email` = '$email_new', `address` = '$address_new', `tel` = '$tel_new'   WHERE `taikhoan`.`email` = '$email_old';";
    }
$taikhona_update=pdo_execute($sql);
return $taikhona_update;
}
function doipass($pass_new,$email_old){
    $sql="UPDATE `taikhoan` SET `pass` = '$pass_new' WHERE `taikhoan`.`email` = '$email_old';";
    $doipass=pdo_execute($sql);
    return $doipass;
}
?>
