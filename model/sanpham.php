
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
?>