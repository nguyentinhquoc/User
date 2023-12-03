<!-- Begin Slider Area -->

<div class="slider-area">

    <!-- Main Slider -->
    <div class="swiper-container main-slider swiper-arrow with-bg_white">
        <div class="swiper-wrapper">
                <?php
$sql="SELECT * FROM banner";
$banner=pdo_query($sql);
                foreach ($banner as $value) { ?>
            <div class="swiper-slide animation-style-01">
                <div class="slide-inner bg-height" data-bg-image="<?= $img_path ?>slider/<?=$value['img']?>">
                    <div class="container">
                        <div class="slide-content text-white">
                            <h3 class="sub-title"><?=$value['h1']?></h3>
                            <h2 class="title mb-3"><?=$value['h2']?></h2>
                            <p class="short-desc different-width mb-10"><?=$value['h3']?></p>
                            <div class="button-wrap">
                                <a class="btn btn-custom-size lg-size btn-primary" href="index.php?act=sanpham_list&page=1">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     <?php   } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination with-bg d-md-none"></div>

        <!-- Custom Arrows -->
        <div class="custom-arrow-wrap d-none d-md-block">
            <div class="custom-button-prev"></div>
            <div class="custom-button-next"></div>
        </div>
    </div>

</div>
<!-- Slider Area End Here -->

<div class="background-img">
    <div class="inner-bg">
        <img src="<?= $img_path ?>background-img/inner-bg/1-1-496x566.png" alt="Inner Background">
    </div>
    <div class="banner-area section-space-top-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 pt-6 pt-md-0">
                    <div class="banner-item img-hover-effect">
                        <div class="banner-img img-zoom-effect">
                            <img class="img-full" src="<?= $img_path ?>banner/1-1-400x250.jpg" alt="Banner Image" height="609px">
                            <div class="inner-content text-white">
                                <h2 class="title mb-5" style="background-color: #949191; width: 70px;">Nike</h2>
                                <h3 class="offer" style="background-color: rgba(115, 111, 111, 0.8);">Nơi nâng tầm phong cách và hiệu suất, mỗi đôi giày là hành trình của sự đổi mới và đẳng cấp.</h3>
                                <div class="button-wrap">
                                    <a class="btn btn-custom-size btn-primary" href="index.php?act=sanpham_list&page=1&danhmuc=1">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 pt-6 pt-md-0">
                    <div class="banner-item img-hover-effect">
                        <div class="banner-img img-zoom-effect">
                            <img class="img-full" src="<?= $img_path ?>banner/1-2-400x250.jpg" alt="Banner Image" height="609px">
                            <div class="inner-content text-white">
                                <h2 class="title mb-5" style="background-color: #949191; width: 70px;">MLB</h2>
                                <h3 class="offer" style="background-color: rgba(115, 111, 111, 0.8);"> Phong cách hòa quyện trong từng đường nét, biến mỗi đôi giày thành biểu tượng của đam mê.</h3>

                                <div class="button-wrap">
                                    <a class="btn btn-custom-size btn-primary" href="index.php?act=sanpham_list&page=1&danhmuc=3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-6 pt-lg-0">
                    <div class="banner-item img-hover-effect">
                        <div class="banner-img img-zoom-effect">
                            <img class="img-full" src="<?= $img_path ?>banner/1-3-400x250.jpg" alt="Banner Image" height="609px">
                            <div class="inner-content text-white">
                                <h2 class="title mb-5" style="background-color: #949191; width: 130px;">Jordan</h2>
                                <h3 class="offer" style="background-color: rgba(115, 111, 111, 0.8);">Nơi tinh hoa thể thao và phong cách kết hợp, mỗi đôi giày là biểu tượng của sự độc đáo, sức mạnh</h3>
                                <div class="button-wrap">
                                    <a class="btn btn-custom-size btn-primary" href="index.php?act=sanpham_list&page=1&danhmuc=2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Shipping Area -->
    <div class="shipping-area section-space-y-axis-100">
        <div class="container">
            <div class="shipping-bg" data-bg-image="<?= $img_path ?>shipping/bg/1-1-1280x202.jpg">
                <div class="row shipping-wrap py-5 py-xl-0">
                    <div class="col-lg-4">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="<?= $img_path ?>shipping/icon/plane.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">Hỗ trợ trực tuyến</h2>
                                <p class="short-desc mb-0">Đảm bảo hộ trợ trực tuyến cho khách hàng 24/24 khi gọi vào hotline</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-4 pt-lg-0">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="<?= $img_path ?>shipping/icon/earphones.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">Miến phí vận chuyển</h2>
                                <p class="short-desc mb-0">Miễn phí cho đơn hàng có giá trị lớn hơn 1.000.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-4 pt-lg-0">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="<?= $img_path ?>shipping/icon/shield.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">An toàn bảo mật</h2>
                                <p class="short-desc mb-0">Đảm bảo chất lượng sản phẩm, bảo mật thông tin tuyệt đối</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shipping Area End Here -->

</div>

<!-- Begin Product Area -->
<div class="brand-area section-space-y-axis-100 white-smoke-bg">
    <div class="container">
        <h2>SẢN PHẨM MỚI NHẤT</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper-container brand-slider">
                    <div class="swiper-wrapper">
                        <?php $sanphammoi = sanpham_moi();
                        foreach ($sanphammoi as $key) { ?>
                            <a href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>"></a>
                            <div class="swiper-slide">
                                <a class="brand-item" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>">
                                    <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" height="300px" width="200px" style="border-radius: 10px;">
                                </a>
                                <p class="price_sp"><?= number_format($key['price'], 0, ',', '.');  ?>
                                    <del style="color: #ccc9c2;"><?= number_format($key['price'] + ($key['price'] * ($key['sale'] / 100)), 0, ',', '.');  ?></del>
                                </p>
                                <p class="name_sp"><?= $key['name'] ?></p>
                                
                                <p class="dabansp">Đã bán :1222</p>
                                <div class="congcu">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            </a>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Area End Here -->

<!-- Begin Banner Area -->
<div class="banner-area section-border-y-axis ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-md-center order-2 order-md-1 pt-5 pt-md-0">
                <div class="banner-content text-center">
                    <div class="inner-img mb-2">
                        <img src="<?= $img_path ?>banner/inner-img/1-1-201x57.png" alt="Banner Image">
                    </div>
                    <h3 class="title text-charcoal">Ngày hội mua sắm</h3>
                    <h4 class="sub-title text-primary mb-6">Hot Deal ! Sale Up To 40% Off </h4>
                    <div class="countdown-wrap pb-8">
                        <div countdown="" data-date="December 15 2023 10:10:10">
                            Chỉ còn: <span data-days>00</span> ngày
                            <span data-hours>00</span> giờ
                            <span data-minutes>00</span> phút
                            <span data-seconds>00</span> giây
                        </div>
                    </div>
                    <div class="button-wrap pb-8 pb-md-0">
                        <a class="btn btn-custom-size lg-size btn-primary" href="index.php?act=sanpham_list&page=1">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <div class="banner-img">
                    <img src="<?= $img_path ?>banner/2-1-407x529.png" alt="Banner Image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area End Here -->
<div class="brand-area section-space-y-axis-100 white-smoke-bg">
    <div class="container">
        <h2>SẢN PHẨM BÁN CHẠY</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper-container brand-slider">
                    <div class="swiper-wrapper">
                        <?php $sanphambanchay = sanpham_banchay();
                        foreach ($sanphambanchay as $key) { ?>
                            <a href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>"></a>
                            <div class="swiper-slide">
                                <a class="brand-item" href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>">
                                    <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="Brand Image" height="300px" width="200px" style="border-radius: 10px;">
                                </a>
                                <p class="price_sp"><?= number_format($key['price'], 0, ',', '.');  ?>
                                    <del style="color: #ccc9c2;"><?= number_format($key['price'] + ($key['price'] * ($key['sale'] / 100)), 0, ',', '.');  ?></del>

                                </p>
                                <p class="name_sp"><?= $key['name'] ?></p>
                                <p class="dabansp">Đã bán :1222</p>
                                <div class="congcu">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            </a>
                        <?php }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="newsletter-area section-border-y-axis">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="newsletter-img">
                    <img src="<?= $img_path ?>newsletter/1-1-491x529.png" alt="Newsletter Image">
                </div>
            </div>
            <div class="col-md-6 align-self-md-center pb-10 pb-md-0">
                <div class="newsletter-content">
                    <h2 class="newsletter-title mb-4">Cùng nhau mua sắm.</h2>
                    <h3 class="newsletter-sub-title text-primary mb-8">Giúp nhau săn sale !!!</h3>
                    <form action="index.php" method="post"  style="display: flex;"> 
                        <input style="width: 400px; border:0; background-color: #dfdfdf;" type="email"name="marketing_email" placeholder="Nhập email người giới thiệu">
                        <div class="button-wrap">
                            <button class="btn btn-custom-size btn-primary" " name="marketing_submit">Subscribe</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['marketing_submit']) && isset($_SESSION['email_dn'])) {
                        $mail_marketing = $_POST['marketing_email'];
                        $email_dn=($_SESSION['email_dn']);                

                        $sql = "SELECT * FROM taikhoan where email='$mail_marketing'";
                        $check = pdo_query_one($sql);
                        $sql2 = "SELECT * FROM taikhoan where email='$email_dn'";
                        $check_mr = pdo_query_one($sql2);
                        if (!$check) {?>
                        <p style="color: red;"><?="Email giới thiệu không hợp lệ."?></p>

                        <?php }
                        
                        elseif($check==true and $check_mr['marketing'] != 1) {
                            $email_dn=($_SESSION['email_dn']);                
                            $sql="SELECT DATE(DATE_ADD(NOW(), INTERVAL 15 DAY)) AS 'date' ;";
                            $day_15 = pdo_query_one($sql);
                            $date_15=$day_15['date'];
                            $id_dn=taikhoan_email($email_dn);
                            $iddn=$id_dn['id'];
                            $id_marketing=taikhoan_email($mail_marketing);
                            $idmarketing=$id_marketing['id'];
                            $sql1="UPDATE `taikhoan` SET `marketing` = '1' WHERE `taikhoan`.`email` = '$email_dn';";
                            $sql2="INSERT INTO `vocher` (`sale`, `iduser`, `date`) VALUES ('50000', '$iddn', '$date_15');";
                            $sql3="INSERT INTO `vocher` (`sale`, `iduser`, `date`) VALUES ('100000', ' $idmarketing', '$date_15');";
                            pdo_execute($sql1);
                            pdo_execute($sql2);
                            pdo_execute($sql3);
                        }
                    }
                    ?>
                    <!-- Mailchimp Alerts -->
                    <div class="mailchimp-alerts text-centre pt-5">
                        <div class="mailchimp-submitting"></div>
                        <div class="mailchimp-success"></div>
                        <div class="mailchimp-error"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Area End Here -->


<!-- Begin Brand Area -->
<div class="brand-area section-space-y-axis-100 white-smoke-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper-container brand-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide img_f_home ">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-1.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-2.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-3.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-4.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-5.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-6.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                        <div class="swiper-slide img_f_home">
                            <a class="brand-item-f" href="#">
                                <img src="<?= $img_path ?>brand/1-7.png" alt="Brand Image" width="150px" height="200px" style="border-radius: 20px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Area End Here -->