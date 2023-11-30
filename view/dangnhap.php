
        <?php include("../model/validate.php");?>
        <main class="main-content">
            <div class="login-register-area section-space-y-axis-100">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-6 pt-10 pt-lg-0">
                            <img src="<?=$img_path?>login/img2.png" alt="">
                        </div>
                        <div class="col-lg-6">
                            <form action="index.php?act=dangnhap" method="post">
                                <div class="login-form">
                                    <h4 class="login-title">ĐANG NHẬP</h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email Address" name="email_dn" style="<?= $err6 ?>">
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Mật khẩu</label>
                                            <input type="password" placeholder="Password" name="pass_dn" style="<?= $err7 ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="check-box">
                                                <a href="index.php?act=dangky">Đang ký</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pt-1 mt-md-0">
                                            <div class="forgotton-password_info">
                                                <a href="index.php?act=quenpass">Quên mật khẩu ?</a>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button class="btn btn-custom-size lg-size btn-primary" style="width: 100%;" name="submit_dn">ĐANG NHẬP</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content Area End Here -->
