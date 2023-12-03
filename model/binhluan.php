<?php
function hienthi_binhluan($idsp)
{
    $sql = "SELECT taikhoan.img, taikhoan.name,binhluan.date,binhluan.comment FROM taikhoan JOIN binhluan ON binhluan.iduser=taikhoan.id where idsp=$idsp and binhluan.trangthai = 1";
    $hienthi_binhluan = pdo_query($sql);
    return $hienthi_binhluan;
}
function upload_binhluan($idsp, $iduser, $comment)
{
    if (isset($comment) && $comment != "") {
        $sql = "INSERT INTO `binhluan` (`idsp`, `iduser`, `comment`, `date`,`trangthai`) VALUES ($idsp, $iduser, '$comment', CURRENT_DATE(),1);";
        $upload_binhluan = pdo_execute($sql);
        return $upload_binhluan;
    }
}
