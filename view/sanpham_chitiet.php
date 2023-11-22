<main class="sanpham_chitiet">
    <?php
    $idsp = $_GET["id"];
    $sanpham_chitiet = sanpham_chitiet($idsp);
    ?>
    <div class="top">
        <div class="box box_left"><img src="<?= $img_path . "sanpham/" . $sanpham_chitiet['img'] ?>" alt=""></div>
        <div class="box box_center">
            <div class="name">
                <h3><?= $sanpham_chitiet['name'] ?></h3>
                <?php $star = $sanpham_chitiet['star'] ?>
            </div>
            <div class="danhgia">Đánh giá: <?php if (!empty($sanpham_chitiet['star'])) {
                                                echo_star($star);
                                            } else {
                                                echo "Chưa có đánh giá !";
                                            } ?></div>
            <div class="ma">Mã mặt hàng: MA<?= $sanpham_chitiet['id'] ?></div>
            <div class="soluong">
                <p class="sl">Số lượng: <?= $sanpham_chitiet['soluong'] ?> </p>
                <?php
                if ($sanpham_chitiet['soluong'] > 0) {
                    echo '   <p class="tinhtrang" style="color:green;">Còn hàng</p> ';
                } else {
                    echo '   <p class="tinhtrang" style="color:red;">Hết hàng</p> ';
                }
                ?>
            </div>
            <div class="price">
                <p class="gia_sale"><?= number_format($sanpham_chitiet['price'], 0, ',', '.');  ?></p>
                <p class="gia_goc"><del><?= number_format($sanpham_chitiet['price'] + ($sanpham_chitiet['price'] * ($sanpham_chitiet['sale'] / 100)), 0, ',', '.');  ?></del></p>
            </div>
            <div class="uudai">
                <ul>
                    <h4 style="color:red;">Thông tin ưu đãi</h4>
                    <li style="color:#0B5717;">Tặng thêm một đôi tất nike</li>
                    <li style="color:#0B5717;">Tặng thêm một dây giày</li>
                    <li style="color:#0B5717;">Tặng thêm một lọ vệ sinh giày</li>
                    <li style="color:#0B5717;">DMiễn phí vận chuyển</li>
                </ul>
            </div>
            <form action="index.php?act=sanpham_chitiet" method="get">
                <?php
                $soluong = $_GET['soluong'];
                ?>
                <input type="hidden" name="id" value="<?= $idsp ?>">
                <input type="hidden" name="soluong" value="<?= $soluong ?> ">
                <input type="hidden" name="act" value="sanpham_chitiet">
                <div class="soluongmua">
                    <p style="margin-right: 20px;">Số lượng: </p>
                    <table border="3px">
                        <tr>
                            <th>
                                <span style="cursor: pointer;" onclick="changeQuantity(-1)">-</span>
                            </th>
                            <th>
                                <p style="margin: 0px;"><span id="quantityDisplay"><?= $soluong ?></span></p>

                            </th>
                            <th>
                                <span style="cursor: pointer;" onclick="changeQuantity(1)">+</span>
                            </th>
                        </tr>
                    </table>
                </div>
                <script>
                    function changeQuantity(amount) {
                        var url = new URL(window.location.href);

                        // Lấy giá trị hiện tại của soluong từ URL
                        var currentQuantity = parseInt(url.searchParams.get("soluong")) || 1;

                        // Tăng hoặc giảm giá trị soluong
                        currentQuantity += amount;

                        // Đảm bảo giá trị không âm
                        currentQuantity = Math.max(1, currentQuantity);

                        // Cập nhật giá trị soluong trong URL
                        url.searchParams.set("soluong", currentQuantity);

                        // Thay đổi URL mà không tải lại trang
                        window.history.replaceState({}, '', url);

                        // Cập nhật hiển thị số lượng trên trang
                        document.getElementById("quantityDisplay").innerText = currentQuantity;
                    }
                </script>
                <div class="mau">Màu
                    <?php
                    $all_color = all_color();
                    foreach ($all_color as $key => $value) {
                    ?>
                        <div class="custom-radio">
                            <input type="radio" id="<?= $value['color'] ?>" name="color" value="<?= $value['id'] ?>" onclick="updateUrl(<?= $value['id'] ?>)" <?php if (isset($_GET['color']) && $_GET['color'] == $value['id']) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                            <label for="<?= $value['color'] ?>"><?= $value['color'] ?></label>
                        </div>
                    <?php } ?>
                </div>


                <script>
                    function updateUrl(value) {
                        // Lấy URL hiện tại
                        var currentUrl = window.location.href;

                        // Kiểm tra nếu URL đã chứa tham số 'gender'
                        if (currentUrl.includes('color')) {
                            // Thay thế giá trị của tham số 'color' trong URL
                            var updatedUrl = currentUrl.replace(/color=[^&]+/, 'color=' + value);
                        } else {
                            // Thêm tham số 'color' vào URL
                            var updatedUrl = currentUrl + (currentUrl.includes('?') ? '&' : '?') + 'color=' + value;
                        }
                        // Chuyển hướng đến URL mới và reload lại trang
                        window.location.href = updatedUrl;
                    }
                </script>
                <?php
                if (isset($_GET['color'])) {
                    $idcolor = $_GET['color'];
                    $idsp = $_GET['id'];
                    $all_size = size_color($idcolor, $idsp);
                } else {
                    $all_size = all_size();
                }

                ?>

                <div class="size">Size
                    <?php
                    foreach ($all_size as $key => $value) {
                    ?>
                        <div class="custom-radio">
                            <input type="radio" id="<?= $value['size'] ?>" name="size" value="<?= $value['id'] ?>">
                            <label for="<?= $value['size'] ?>"><?= $value['size'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="buttom">
                    <button class="add_gio" name="add_cart_chitiet">Thêm vào giỏ hàng <i style="font-size: larger; color: #0B5717;" class="fa fa-cart-plus" aria-hidden="true"></i>
                    </button>
                    <button class="dat" name="dat_chitiet">Đặt ngay</button>
                </div>
            </form>
        </div>
        <div class="box box_right">
            <h6>Sản phẩm liên quan</h6>
            <?php
            $sanpham_lienquan = sanpham_lienquan($idsp);
            foreach ($sanpham_lienquan as $key) { ?>
                <a href="index.php?act=sanpham_chitiet&id=<?= $key['id'] ?>&soluong=1">

                    <div class="item">
                        <img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="" width="50px" height="60px">
                        <div class="tt">
                            <p class="name" style="margin-bottom: 0px;"><?= $key['name'] ?> </p>
                            <p class="price"><?= $key['price'] ?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>

        </div>
    </div>
    <?php
    $sanpham_chitiet['price'];
    if (isset($_GET['add_cart_chitiet'])) {
        if ($sanpham_chitiet['soluong'] > 0) {
            $taikhoan_email = taikhoan_email($email);
            $iduser = $taikhoan_email['id'];
            $soluong = $_GET['soluong'];
            $gia_sp = $sanpham_chitiet['price'];
            $tongtien = $gia_sp * $soluong;
            $idsp = $_GET["id"];
            $color = $_GET['color'];
            $size = $_GET['size'];
            $bienthe_check = timbienthe($idsp, $color, $size);
            $bienthe = $bienthe_check['id'];
            echo $bienthe;
            add_gio($iduser, $soluong, $tongtien, $bienthe);
        } 
    }
    ?>

    <div class="btom">
        <h3>Bình Luận</h3>
        <?php
        $hienthi_binhluan = hienthi_binhluan($idsp);
        foreach ($hienthi_binhluan as $key) { ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $key['img'] ?>" alt="" width="100px" height="100px" style="margin: 10px;">
                </div>

                <div class="content">
                    <h5><?= $key['name'] ?></h5>
                    <p><?= $key['comment'] ?></p>
                    <p class="date"><?= $key['date'] ?></p>

                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['email_dn'])) {
            $email = $_SESSION['email_dn'];
            $taikhoan_email = taikhoan_email($email);
            $iduser = $taikhoan_email['id'];

        ?>
            <div class="item">
                <div class="img"><img class="img" src="<?= $img_path . "avarta_user/" . $taikhoan_email['img'] ?>" alt="" height="100px" width="100px" style="margin: 10px;">
                </div>
                <div class="content">
                    <h5><?= $taikhoan_email['name'] ?></h5><br>
                    <form action="index.php?act=sanpham_chitiet&id=<?= $idsp ?>" method="post">
                        <input type="text" name="comment" id="" placeholder="Nhập binh luận">
                        <button name="submit_comment">Bình luận</button>
                    </form>
                    <?php
                    if (isset($_POST['submit_comment'])) {
                        $comment = $_POST['comment'];
                        upload_binhluan($idsp, $iduser, $comment);
                        header("Location: index.php?act=sanpham_chitiet&id=$idsp");
                    }
                    ?>
                </div>
            </div>
        <?php  }
        ?>


    </div>
</main>