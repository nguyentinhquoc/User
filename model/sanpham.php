
<?php
// home----------------------------------------------------------------
function sanpham_moi(){
$sql="SELECT * FROM sanpham ORDER BY id DESC LIMIT 0,10;";
$sanphammoi=pdo_query($sql);
return $sanphammoi;
}
function sanpham_banchay(){
$sql="SELECT * FROM sanpham ORDER BY luotxem DESC LIMIT 10;";
$sanphambanchay=pdo_query($sql);
return $sanphambanchay;
}
// list------------------------------
function sanpham_all_list($a){
    $c=($a-1)*12;
    $sql="SELECT * FROM sanpham ORDER BY id DESC LIMIT $c,12 ;";
    $sanpham_all=pdo_query($sql);
    return $sanpham_all;
}
function sanpham_dm_list($a,$b){
    $c=($a-1)*12;
    $sql="SELECT * FROM sanpham where iddm=$b ORDER BY id DESC LIMIT $c,12 ;";
    $sanpham_all=pdo_query($sql);
    return $sanpham_all;
}
function tong_dm_sanpham($a){
    $sql="SELECT COUNT(id) 'dem' FROM sanpham where iddm = $a";
    $sanpham_all=pdo_query_one($sql);
    return $sanpham_all;
}
function tong_all_sanpham(){
    $sql="SELECT COUNT(id) 'dem' FROM sanpham ";
    $sanpham_all=pdo_query_one($sql);
    return $sanpham_all;
}

function sanpham_chitiet($id){
    $sql="SELECT * FROM sanpham where id = $id";
    $sanpham_chitiet=pdo_query_one($sql);
    return $sanpham_chitiet;
}
function sanpham_lienquan($idsp){
    $sql="SELECT * FROM sanpham where iddm=(SELECT iddm FROM sanpham where id=$idsp)ORDER BY id DESC LIMIT 7 ";
    $sanpham_lienquan=pdo_query($sql);
    return $sanpham_lienquan;
}
function sanpham_yeuthich($email){
    $sql= "SELECT sanpham.img, sanpham.name, sanpham.price,phanloaidh.id FROM phanloaidh join sanpham on sanpham.id= phanloaidh.idsp JOIN taikhoan ON taikhoan.id=phanloaidh.iduser WHERE taikhoan.email='$email' and phanloaidh.idtrangthai=1";
    $sanpham_yeuthich = pdo_query($sql);
    return $sanpham_yeuthich;
}
function yeuthich_add($idsp,$iduser){
    $sql1= "SELECT iduser,idsp FROM phanloaidh";
    $check_trung=pdo_query($sql1);
    $check=true;
    foreach ($check_trung as $key) {
        if ($key['iduser'] == $iduser &&  $key['idsp'] == $idsp ) {
            $check=false;
        }
    }

if ($check==true) {
    $sql2= "INSERT INTO `phanloaidh` (`iduser`, `idsp`, `idtrangthai`) VALUES ('$iduser', '$idsp', '1');";
    $yeuthich_add=pdo_execute($sql2);
    return $yeuthich_add;
}
}
function yeuthich_remove($id){
    $sql="DELETE FROM `phanloaidh` WHERE `phanloaidh`.`id` = $id";
    $yeuthich_remove=pdo_execute($sql);
    return $yeuthich_remove;
}
function yeuthich_cout($id){
    $sql= "SELECT COUNT(*) as 'dem' FROM phanloaidh where  iduser=$id";
    $yeuthich_count=pdo_query_one($sql);
    return $yeuthich_count;
}
?>