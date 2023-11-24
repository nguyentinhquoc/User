<?php
function insert_chitietdh($hinhthuc,$sale,$date,$madh,$tongtien){
    $sql1="INSERT INTO `chitietdh` (`thanhtoan`, `date`, `sale`, `thanhtien`, `madh`) VALUES ('$hinhthuc', '$date', '$sale','$tongtien', '$madh');";
    pdo_execute($sql1);
}
function update_trangthai($madh,$idphanloaidh){
    $sql="UPDATE `phanloaidh` SET `idtrangthai` = '3',madh='$madh' WHERE `phanloaidh`.`id` = $idphanloaidh;";
    pdo_execute($sql);
}
?>