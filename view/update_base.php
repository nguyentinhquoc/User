<?php
include '../model/pdo.php';
$sql1="SELECT sanpham.id FROM sanpham";
$id_sp=pdo_query($sql1);
foreach ($id_sp as $key => $value) {
    $id = $value['id'];
    $sql2="SELECT SUM(soluong) AS 'Tong' FROM `bienthe` WHERE idsp = $id";
    $tong = pdo_query($sql2);
    foreach ($tong as $key => $value) {
        $tong=$value['Tong'];
        $sql3="UPDATE `sanpham` SET `soluong` = '$tong' WHERE `sanpham`.`id` = $id;";
        pdo_execute($sql3);
    }
}


?>
