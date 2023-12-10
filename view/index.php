<?php
ob_start();
session_start();
include("../model/pdo.php");
include("global.php");
include("../model/star.php");
include("../model/binhluan.php");
include("../model/taikhoan.php");
include("../model/validate.php");
include("../model/sanpham.php");
include("../model/dathang.php");
include("../model/donhang.php");
include("../model/danhmuc.php");
include("../model/vocher.php");
include("../model/thongbao.php");
include("header.php");
if (!isset($_GET["act"])) {
    include("home.php");
} else {
    $act = $_GET["act"];
    switch ($act) {
        case "dangky":
            include("dangky.php");
            break;
        case "lienhe":
            include("lienhe.php");
            break;
        case "tintuc":
            include("tintuc.php");
            break;
        case "danhgia":
            include("danhgia.php");
            break;
        case "dangnhap":
            include("dangnhap.php");
            break;
        case "dangxuat":
            unset($_SESSION['email_dn']);
            header('location: index.php?dangxuattc');
            break;
        case "quantri":
            header('location: ../../../../Admin/View/index.php');
            break;
        case "sanpham_list":
            include("sanpham_list.php");
            break;
        case "sanpham_chitiet":
            include("sanpham_chitiet.php");
            break;
        case "giohang":
            include("giohang.php");
            break;
        case "myaccout":
            include("taikhoan.php");
            break;
        case "yeuthich":
            include("yeuthich.php");
            break;
        case "giohang":
            include("giohang.php");
            break;
        case "dathang":
            include("dathang.php");
            break;
        case "thongbao":
            include("thongbao.php");
            break;
        case "dathangtc":
            include("dathangtc.php");
            break;
        case "donhang":
            include("donhang.php");
            break;
        case "quenpass":
            include("quenpass.php");
            break;
        default:
            include("404.php");
            break;
    }
}
include("footer.php");
