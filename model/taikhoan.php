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
?>