<?php
function hienthi_binhluan($idsp)
{
    $sql = "SELECT taikhoan.name,binhluan.date,binhluan.comment FROM taikhoan JOIN binhluan ON binhluan.iduser=taikhoan.id where idsp=$idsp";
    $hienthi_binhluan = pdo_query($sql);
    return $hienthi_binhluan;
}
function upload_binhluan($idsp, $iduser, $comment)
{
    if (isset($comment) && $comment != "") {
        $sql = "INSERT INTO `binhluan` (`idsp`, `iduser`, `comment`, `date`) VALUES ($idsp, $iduser, '$comment', CURRENT_DATE());";
        $upload_binhluan = pdo_execute($sql);
        return $upload_binhluan;
    }
}
