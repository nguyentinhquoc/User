<main class="main-content">
    <div class="login-register-area section-space-y-axis-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-10 pt-lg-0">
                    <img src="<?= $img_path ?>login/img2.png" alt="">
                </div>
                <div class="col-lg-6">
                    <form action="index.php?act=quenpass" method="post">
                        <div class="login-form">
                            <h4 class="login-title">QUÊN MẬT KHẨU</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email Address" name="quenpass_email" style="<?= $err6 ?>">
                                </div>
                                <div class="col-md-4 pt-1 mt-md-0">
                                    <div class="forgotton-password_info">
                                        <a href="index.php?act=dangnhap">Đang nhập</a>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-custom-size lg-size btn-primary" style="width: 100%;" name="quenpas">LẤY LẠI MẬT KHẨU</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['quenpas'])) {
                    $email = $_POST['quenpass_email'];
                    check_mail($email);
                }
                ?>
            </div>
        </div>
    </div>
</main>
<!-- Main Content Area End Here -->