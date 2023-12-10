<?php
include '../model/pdo.php';
$min = 1000;
$max = 4000;
$sql = "SELECT * FROM sanpham";
$idsp = pdo_query($sql);
foreach ($idsp as $key => $value) {
    $randomNumber = rand($min, $max);
    $numberupd = $randomNumber * 1000;
    $id_sp = $value['id'];
    $sql = "UPDATE `sanpham` SET `price` = '$numberupd' WHERE `sanpham`.`id` = $id_sp;";
    pdo_execute($sql);
}



?>
