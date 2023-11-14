<?php
session_start();
include("../model/pdo.php");
include("global.php");
include("../model/danhgia.php");
include("../model/binhluan.php");
include("../model/taikhoan.php");
include("../model/validate.php");
include("../model/sanpham.php");
include("../model/danhmuc.php");
include("header.php");
if (!isset($_GET["act"])) {
    include("home.php");
} else {
    $act = $_GET["act"];
    switch ($act) {
        case "dangky":
            include("dangky.php");
                break;
        case "dangnhap":
            include("dangnhap.php");
            break;
            case "dangxuat":
                unset( $_SESSION['id_acc']);
            header('location: index.php?dangxuattc');
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
        default:
            include("404.php");
            break;
    }
}
include("footer.php");
