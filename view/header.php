<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panda Shop</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Tromic car accessories bootstrap 5 template is an awesome website template for any modern car accessories shop.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= $img_path ?>logo/dark.png" />

    <!-- CSS
    ============================================ -->

    <!-- Vendor CSS (Contain Bootstrap, Icon Fonts) -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/Pe-icon-7-stroke.css" />

    <!-- Plugin CSS (Global Plugins Files) -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/ion.rangeSlider.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Style CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <div class="main-wrapper">

        <!-- Begin Main Header Area -->
        <header class="main-header-area">
            <div class="header-top border-bottom d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="header-top-left">
                                <ul class="dropdown-wrap text-matterhorn">
                                    <li>
                                        PANDA SHOP - Shop giày uy tín số 1 Fpoly
                                    </li>


                                    <li>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="header-top-right text-matterhorn">
                                Email
                                <a href="">: nguyentinh140321@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle header-sticky py-6 py-lg-0">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="header-middle-wrap position-relative">
                                <a href="index.php" class="header-logo">
                                    <img src="<?= $img_path ?>logo/dark.png" alt="Header Logo" width="100px">
                                </a>

                                <div class="main-menu d-none d-lg-block">
                                    <nav class="main-nav">
                                        <ul>

                                            <li class="drop-holder">
                                                <a href="index.php">Trang chủ
                                                </a>

                                            </li>

                                            <li class="drop-holder">
                                                <a href="index.php?act=sanpham_list&page=1&danhmuc=0">Sản phẩm
                                                    <i class="pe-7s-angle-down"></i>
                                                </a>
                                                <ul class="drop-menu">
                                                    <?php
                                                    $danhmuc_all = danhmuc_all();
                                                    foreach ($danhmuc_all as $key) { ?>
                                                        <li>
                                                            <a href="index.php?act=sanpham_list&page=1&danhmuc=<?= $key['id'] ?>"><?= $key['name'] ?></a>
                                                        </li>
                                                    <?php }
                                                    ?>

                                                </ul>
                                            </li>
                                            <li class="drop-holder">
                                                <a href="index.php?act=tintuc">Tin tức
                                                </a>

                                            </li>
                                            <li>
                                                <a href="index.php?act=lienhe">Liên hệ</a>
                                            </li>
                                            <li>
                                                <?php if (isset($_GET['search'])) {
                                                    $_SESSION['search'] = $_GET['search'];
                                                    header('Location: index.php?act=sanpham_list&page=1');
                                                } ?>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right">
                                    <ul>
                                        <?php
                                        if (isset($_SESSION['email_dn'])) {
                                            $email = $_SESSION['email_dn'];
                                            $sql = "SELECT id FROM taikhoan WHERE email='$email'";
                                            $id_acc = pdo_query_one($sql);
                                            $iduser = $id_acc['id'];
                                            $yeuthich = yeuthich_cout($iduser);
                                            $cart = cart_cout($iduser);
                                        }
                                        ?>
                                        <?php if (isset($_SESSION['email_dn'])) {
                                            $email = $_SESSION['email_dn'];
                                            $taikhoan_email = taikhoan_email($email); ?>



                                            <li class="minicart-wrap me-3 me-lg-0">
                                                <a href="index.php?act=yeuthich" class="minicart-btn">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    <span class="quantity"><?= $yeuthich['dem'] ?> </span>
                                                </a>
                                            </li>
                                            <li class="minicart-wrap me-3 me-lg-0">
                                                <a href="index.php?act=thongbao" class="minicart-btn">
                                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                    <?php
                                                    $sql = "SELECT COUNT(id) 'dem' from thongbao";
                                                    $demtb = pdo_query_one($sql);
                                                    ?>
                                                    <span class="quantity"><?= $demtb['dem'] ?></span>
                                                </a>
                                            </li>

                                            <li class="minicart-wrap me-3 me-lg-0">
                                                <a href="index.php?act=giohang" class="minicart-btn">
                                                    <i class="pe-7s-shopbag"></i>
                                                    <span class="quantity"><?= $cart['dem'] ?></span>
                                                </a>
                                            </li>
                                            <li class="dropdown d-none d-lg-block">
                                                <button class="btn btn-link dropdown-toggle ht-btn p-0" type="button" id="settingButton" data-bs-toggle="dropdown" aria-label="setting" aria-expanded="false">
                                                    <img src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" width="40px" height="40px" style="border-radius: 50%;">
                                                </button>
                                                <ul class="dropdown-menu right-side" aria-labelledby="settingButton">
                                                    <?php $email = $_SESSION['email_dn'];
                                                    $taikhoan_email = taikhoan_email($email);
                                                    if ($taikhoan_email['role'] == 2) { ?>
                                                        <li><a class="dropdown-item" href="index.php?act=quantri">Tới trang quản trị</a></li>
                                                    <?php } ?>
                                                    <li><a class="dropdown-item" href="index.php?act=myaccout&profile=1">Tài khoản của tôi</a></li>
                                                    <li><a class="dropdown-item" href="index.php?act=dangxuat">Đang xuất</a></li>
                                                </ul>
                                            </li><?php } else { ?>
                                            <li class="dropdown d-none d-lg-block">
                                                <button class="btn btn-link dropdown-toggle ht-btn p-0" type="button" id="settingButton" data-bs-toggle="dropdown" aria-label="setting" aria-expanded="false">
                                                    <i class="fa fa-user-o" aria-hidden="true"></i>

                                                </button>
                                            <li><a class="dropdown-item" href="index.php?act=dangky">Đang ký</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=dangnhap">Đang nhập</a></li>
                                            </li>
                                        <?php } ?>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>