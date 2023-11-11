<?php
session_start();
include("../model/pdo.php");
include("global.php");
include("../model/danhgia.php");
include("../model/taikhoan.php");
include("../model/validate.php");
include("../model/sanpham.php");
include("../model/bienthe.php");
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
            if (isset($_POST["submit_dn"])) {
                $email_dn = $_POST['email_dn'];
                $pass_dn = $_POST['pass_dn'];
                $taikhoan_all = taikhoan_all();
                foreach ($taikhoan_all as $key) {
                    if (isset($pass_dn) && isset($email_dn)) {
                      if($key['email'] == $email_dn && $key['pass'] == $pass_dn){
                         $_SESSION['email_dn'] ="";
                            header("Location: index.php?dangnhaptc");
                            break;
                        } if($key['email'] != $email_dn || $key['pass'] != $pass_dn){
                            header("Location: index.php?act=dangnhap&dangnhaptb");
                        }
                    }
                    }
                }
            include("dangnhap.php");
            break;
            case "dangxuat":
                unset($_SESSION['email_dn']);
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
        default:
            include("404.php");
            break;
    }
}
include("footer.php");
