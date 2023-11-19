<!-- Begin Main Content Area -->
<?php include("../model/validate.php");
?>

<main class="main-content">
    <div class="login-register-area section-space-y-axis-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= $img_path ?>login/img1.png" alt="">
                </div>
                <div class="col-lg-6 pt-10 pt-lg-0">
                    <form action="index.php?act=dangky" method="post">
                        <div class="login-form">
                            <h4 class="login-title">ĐANG KÝ</h4>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="label_dk">Họ và tên</label>
                                    <input class="input_dk" type="text" name="name_dk" placeholder="Họ và tên">
                                    <span class="err_form"><?php if (isset($err1)) {
                                                                echo $err1;
                                                            } ?></span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="label_dk">Số điện thoại</label>
                                    <input class="input_dk" type="tel" name="tel_dk" placeholder="Số điện thoại">
                                    <span class="err_form"><?php if (isset($err2)) {
                                                                echo $err2;
                                                            } ?></span>
                                </div>
                                <div class="col-md-12">
                                    <label class="label_dk">Email</label>
                                    <input class="input_dk" type="email" name="email_dk" placeholder=" Email">
                                    <span class="err_form"><?php if (isset($err3)) {
                                                                echo $err3;
                                                            } ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="label_dk">Mật khẩu</label>
                                    <input class="input_dk" type="password" name="pass_dk" placeholder="Mật khẩu">
                                    <span class="err_form"><?php if (isset($err4)) {
                                                                echo $err4;
                                                            } ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="label_dk">Nhập lại mật khẩu</label>
                                    <input class="input_dk" type="password" name="repass_dk" placeholder="Nhập lại mật khẩu">
                                    <span class="err_form"><?php if (isset($err5)) {
                                                                echo $err5;
                                                            } ?></span>
                                </div>
                                <div class="adress">
                                    <select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm" name="tinh">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>

                                    <select class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm" name="huyen">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>

                                    <select class="form-select form-select-sm" id="ward" aria-label=".form-select-sm" name="xa">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                </div>
                                <span class="err_form"><?php if (isset($err6)) {
                                                                echo $err6;
                                                            } ?></span>

                                <div class="col-12">
                                    <button class="btn btn-custom-size lg-size btn-primary btn_dk" name="submit_dk" style="width: 100%;">ĐANG KÝ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
