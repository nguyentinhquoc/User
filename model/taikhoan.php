<?php 
function taikhoan_all(){
    $sql="SELECT * FROM taikhoan";
    $taikhoan_all=pdo_query($sql);
    return $taikhoan_all;
}
?>