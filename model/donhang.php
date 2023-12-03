<?php
// SELECT * FROM `chitietdh` JOIN phanloaidh ON phanloaidh.madh=chitietdh.madh JOIN taikhoan ON phanloaidh.iduser=taikhoan.id WHERE taikhoan.id=17
function load_chitietdh($email,$idtrangthai){
$sql="SELECT chitietdh.madh FROM `chitietdh` JOIN phanloaidh ON phanloaidh.madh=chitietdh.madh JOIN taikhoan ON phanloaidh.iduser=taikhoan.id  WHERE taikhoan.email='$email' and phanloaidh.idtrangthai=$idtrangthai GROUP BY chitietdh.madh";
$load_chitietdh=pdo_query($sql);
return $load_chitietdh;
}
function load_chitietdh_sp($madh){
$sql="SELECT sanpham.id,sanpham.img,sanpham.name,sanpham.price,phanloaidh.soluong,size.size,color.color,chitietdh.sale,chitietdh.thanhtien,bienthe.id 'idbt',phanloaidh.id 'idpl',phanloaidh.danhgia 'danhgia' From phanloaidh JOIN bienthe on phanloaidh.bienthe=bienthe.id JOIN sanpham ON sanpham.id=bienthe.idsp JOIN chitietdh ON chitietdh.madh=phanloaidh.madh JOIN color ON color.id=bienthe.idcolor JOIN size ON size.id=bienthe.idsize WHERE phanloaidh.madh=$madh;";
$load_chitietdh_sp=pdo_query($sql);
return $load_chitietdh_sp;
}
?>