
<?php
// home----------------------------------------------------------------
function sanpham_moi()
{
    $sql = "SELECT sanpham.id,sanpham.name,sanpham.price,sanpham.img,sanpham.luotxem,bienthe.luotban,sanpham.sale FROM sanpham JOIN bienthe ON bienthe.idsp = sanpham.id  GROUP BY sanpham.id ORDER BY sanpham.id DESC LIMIT 10";
    $sanphammoi = pdo_query($sql);
    return $sanphammoi;
}
function sanpham_banchay()
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.img, sanpham.luotxem, SUM(bienthe.luotban) AS 'luotban', sanpham.sale FROM sanpham JOIN bienthe ON bienthe.idsp = sanpham.id GROUP BY sanpham.id, sanpham.name, sanpham.price, sanpham.img, sanpham.luotxem, sanpham.sale ORDER BY luotban DESC LIMIT 10;
    ";
    $sanphambanchay = pdo_query($sql);
    return $sanphambanchay;
}
// list------------------------------
// function sapxep($b,$a){
//     $c = ($a - 1) * 20;
//     if ($b == 1) {
//         $sql = "SELECT * FROM sanpham ORDER BY name ASC LIMIT $c,20 ";
//         $sanpham_all = pdo_query($sql);
//         return $sanpham_all;
//     }
//     if ($b == 2) {
//         $sql = "SELECT * FROM sanpham ORDER BY name DESC LIMIT $c,20 ";
//         $sanpham_all = pdo_query($sql);
//         return $sanpham_all;
//     }
//     if ($b == 3) {
//         $sql = "SELECT * FROM sanpham ORDER BY price ASC LIMIT $c,20 ";
//         $sanpham_all = pdo_query($sql);
//         return $sanpham_all;
//     }
//     if ($b == 4) {
//         $sql = "SELECT * FROM sanpham ORDER BY price DESC LIMIT $c,20 ";
//         $sanpham_all = pdo_query($sql);
//         return $sanpham_all;
//     }
//     if ($b == 5) {
//         $sql = "SELECT * FROM sanpham ORDER BY star ASC LIMIT $c,20 ";
//         $sanpham_all = pdo_query($sql);
//         return $sanpham_all;
//     }
// }
function sanpham_list($gia_bd, $gia_kt, $search, $danhmuc, $page)
{
    $c = ($page - 1) * 20;
    if ($danhmuc == 0) {
        $sql = "SELECT *
    FROM sanpham
    WHERE price BETWEEN $gia_bd AND $gia_kt AND sanpham.name LIKE '%$search%' AND (iddm = 1 or iddm = 3 or iddm = 2) ORDER BY id ASC LIMIT $c,20 ;
   ";
    } elseif ($danhmuc != "") {
        $sql = "SELECT *
        FROM sanpham
        WHERE price BETWEEN $gia_bd AND $gia_kt AND sanpham.name LIKE '%$search%' AND iddm = $danhmuc ORDER BY id ASC LIMIT $c,20 ;
       ";
    }
    $sanpham_price_list = pdo_query($sql);
    return $sanpham_price_list;
}
// }
function cout_sanpham_list($gia_bd, $gia_kt, $search, $danhmuc)
{
    if ($danhmuc == "" || empty($danhmuc)) {
        $sql = "SELECT COUNT(id) 'dem'
    FROM sanpham
    WHERE price BETWEEN $gia_bd AND $gia_kt AND sanpham.name LIKE '%$search%' AND (iddm = 1 or iddm = 3 or iddm = 2) ;
   ";
    } elseif ($danhmuc != "") {
        $sql = "SELECT COUNT(id) 'dem'
        FROM sanpham
        WHERE price BETWEEN $gia_bd AND $gia_kt AND sanpham.name LIKE '%$search%' AND iddm = $danhmuc ;
       ";
    }
    $cout_sanpham_list = pdo_query_one($sql);
    return $cout_sanpham_list;
}

// function sanpham_search_list($a)
// {
//     $sql = "SELECT * FROM sanpham where name LIKE '%$a%'";
//     $sanpham_all = pdo_query($sql);
//     return $sanpham_all;
// }
function sanpham_all_list($a)
{
    $c = ($a - 1) * 20;
    $sql = "SELECT * FROM sanpham ORDER BY id ASC LIMIT $c,20 ;";
    $sanpham_all = pdo_query($sql);
    return $sanpham_all;
}
function sanpham_dm_list($a, $b, $d, $e)
{
    $c = ($a - 1) * 20;
    $sql = "SELECT * FROM sanpham WHERE price BETWEEN $d AND $e and iddm=$b ORDER BY id DESC LIMIT $c,20;";
    $sanpham_all = pdo_query($sql);
    return $sanpham_all;
}
function tong_dm_sanpham($a)
{
    $sql = "SELECT COUNT(id) 'dem' FROM sanpham where iddm = $a";
    $sanpham_all = pdo_query_one($sql);
    return $sanpham_all;
}
function tong_all_sanpham()
{
    $sql = "SELECT COUNT(id) 'dem' FROM sanpham ";
    $sanpham_all = pdo_query_one($sql);
    return $sanpham_all;
}

function sanpham_chitiet($id)
{
    $sql = "SELECT * FROM sanpham where id = $id";
    $sanpham_chitiet = pdo_query_one($sql);
    return $sanpham_chitiet;
}
function sanpham_lienquan($idsp)
{
    $sql = "SELECT * FROM sanpham where iddm=(SELECT iddm FROM sanpham where id=$idsp)ORDER BY id DESC LIMIT 7 ";
    $sanpham_lienquan = pdo_query($sql);
    return $sanpham_lienquan;
}
function sanpham_yeuthich($email)
{
    $sql = "SELECT sanpham.id 'idsp', sanpham.img, sanpham.name, sanpham.price,phanloaidh.id,bienthe.idsp,taikhoan.email FROM phanloaidh join bienthe on bienthe.id= phanloaidh.bienthe JOIN taikhoan ON taikhoan.id=phanloaidh.iduser JOIN sanpham ON sanpham.id=bienthe.idsp WHERE taikhoan.email='$email' AND phanloaidh.idtrangthai=1";
    $sanpham_yeuthich = pdo_query($sql);
    return $sanpham_yeuthich;
}
function yeuthich_add($idsp, $iduser)
{
    $sql1 = "SELECT taikhoan.id,idsp FROM phanloaidh JOIN bienthe on phanloaidh.bienthe=bienthe.id JOIN taikhoan ON phanloaidh.iduser=taikhoan.id where phanloaidh.idtrangthai=1";
    $check_trung = pdo_query($sql1);
    $check = true;
    foreach ($check_trung as $key) {
        if ($key['id'] == $iduser &&  $key['idsp'] == $idsp) {
            $check = false;
        }
    }

    if ($check == true) {
        $sql2 = "SELECT id FROM `bienthe` WHERE bienthe.idsp=$idsp LIMIT 1";
        $id_bienthe = pdo_query_one($sql2);
        $id_bienthex = $id_bienthe['id'];
        $sql3 = "INSERT INTO `phanloaidh` (`iduser`, `bienthe`, `idtrangthai`) VALUES ('$iduser', '$id_bienthex', '1');";
        $yeuthich_add = pdo_execute($sql3);
        return $yeuthich_add;
    }
}
function yeuthich_remove($id)
{
    $sql = "DELETE FROM `phanloaidh` WHERE `phanloaidh`.`id` = $id";
    $yeuthich_remove = pdo_execute($sql);
    return $yeuthich_remove;
}
function yeuthich_cout($id)
{
    $sql = "SELECT COUNT(*) as 'dem' FROM phanloaidh where  iduser=$id and idtrangthai=1";
    $yeuthich_count = pdo_query_one($sql);
    return $yeuthich_count;
}

function sanpham_giohang($email)
{
    $sql = "SELECT bienthe.soluong 'slmax',sanpham.img,color.color,size.size,sanpham.name,sanpham.price,phanloaidh.soluong,phanloaidh.id,bienthe.idsp,taikhoan.email FROM phanloaidh join bienthe on bienthe.id= phanloaidh.bienthe JOIN taikhoan ON taikhoan.id=phanloaidh.iduser JOIN sanpham ON sanpham.id=bienthe.idsp JOIN size ON size.id=bienthe.idsize JOIN color ON color.id=bienthe.idcolor WHERE taikhoan.email='$email' AND phanloaidh.idtrangthai=2;";
    $sanpham_giohang = pdo_query($sql);
    return $sanpham_giohang;
}
function cart_add($idsp, $iduser)
{
    $sql1 = "SELECT taikhoan.id,idsp FROM phanloaidh JOIN bienthe on phanloaidh.bienthe=bienthe.id JOIN taikhoan ON phanloaidh.iduser=taikhoan.id where phanloaidh.idtrangthai=2";
    $check_trung = pdo_query($sql1);
    $check = true;
    foreach ($check_trung as $key) {
        if ($key['id'] == $iduser &&  $key['idsp'] == $idsp) {
            $check = false;
        }
    }
    if ($check == true) {
        $sql2 = "SELECT id FROM `bienthe` WHERE bienthe.idsp=$idsp LIMIT 1";
        $id_bienthe = pdo_query_one($sql2);
        $id_bienthex = $id_bienthe['id'];
        $sql3 = "INSERT INTO `phanloaidh` (`iduser`, `bienthe`, `idtrangthai`) VALUES ('$iduser', '$id_bienthex', '2');";
        $cart_add = pdo_execute($sql3);
        return $cart_add;
    }
}
function cart_remove($id)
{
    $sql = "DELETE FROM `phanloaidh` WHERE `phanloaidh`.`id` = $id";
    $yeuthich_remove = pdo_execute($sql);
    return $yeuthich_remove;
}
function cart_cout($id)
{
    $sql = "SELECT COUNT(*) as 'dem' FROM phanloaidh where  iduser=$id and idtrangthai=2";
    $yeuthich_count = pdo_query_one($sql);
    return $yeuthich_count;
}

function all_size()
{
    $sql = "SELECT * FROM size";
    $all_size = pdo_query($sql);
    return $all_size;
}
function size_color($idcolor, $idsp)
{
    $sql = "SELECT * FROM bienthe join size on bienthe.idsize=size.id where idcolor = $idcolor and idsp = $idsp and soluong>0";
    $size_color = pdo_query($sql);
    return $size_color;
}
function all_color()
{
    $sql = "SELECT * FROM color";
    $all_color = pdo_query($sql);
    return $all_color;
}
function add_gio($iduser, $soluong, $bienthe)
{
    $sql1 = "SELECT * FROM phanloaidh";
    $check_trung = pdo_query($sql1);
    $check = true;
    foreach ($check_trung as $value) {
        if ($value['iduser'] == $iduser && $value['bienthe'] == $bienthe && $value['idtrangthai'] == 2) {
            $soluongnew = $soluong + $value['soluong'];
            $idpl = $value['id'];
            $sql2 = "UPDATE `phanloaidh` SET `soluong` = '$soluongnew' WHERE `phanloaidh`.`id` = $idpl;";
            $add_gio = pdo_execute($sql2);
            $check = false;
        }
    }
    if ($check == true) {
        $sql2 = "INSERT INTO `phanloaidh` (`iduser`, `soluong`, `idtrangthai`, `bienthe`) VALUES ('$iduser', '$soluong', '2',  $bienthe);";
        $add_gio = pdo_execute($sql2);
        return $add_gio;
    }
}
function timbienthe($id_sp, $color, $size)
{
    $sql = "SELECT `id` FROM `bienthe` WHERE idcolor=$color AND idsize=$size AND idsp=$id_sp;";
    $timbienthe = pdo_query_one($sql);
    return $timbienthe;
}
function dathang($id_bienthe)
{
}
?>