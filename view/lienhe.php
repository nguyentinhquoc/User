<main>
<h4 style='width: 100%; background-color: #fad9f6; text-align: center; padding: 20px;  font-family: "Times New Roman", Times, serif; font-weight: bolder;'>Liên hệ</h4>

    <?php
    if (isset($_POST['submit'])) {
        $pattern_tel = '/^(03[2-9]|07[0-9]|08[1-9]|09[0-9])[0-9]{7}$/';
        $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $tel_lh = $_POST['tel'];
        $email_lh = $_POST['email'];
        $noidung_lh = $_POST['noidung'];
        $fullName_lh = $_POST['name'];
        $check_lh = true;
        if (!preg_match($pattern_tel, $tel_lh)) {
            if (isset($tel_lh)) {
                $check_lh = false;
                $errlh2 = "* Số điện thoại không hợp lệ";
            }
        }
        if (!preg_match($pattern_email, $email_lh)) {
            if (isset($email_lh)) {
                $check_lh = false;
                $errlh1 = "* Email không hợp lệ";
            }
        }
        if ($check_lh == true) {
            $sql = "INSERT INTO `lienhe` (`id`, `noidung`, `fullname`, `email`, `tel`) VALUES (NULL, '$noidung_lh', '$fullName_lh ', '$email_lh', ' $tel_lh');";
            pdo_execute($sql);
            header("Location: index.php?guilhtc");
        }
    }
    ?>
    <div style="display: flex; ">
        <div style="width: 30%; margin-right: 100px;">
            <div>
                <i class="fa fa-map-pin" aria-hidden="true" style="color: green; margin: 10px;"></i>
                FPT Polytehcnic <br>
                <i class="fa fa-envelope-o" aria-hidden="true" style="color: red; margin: 10px;"></i>
                nguyentinh140321@gmail.com <br>
                <i class="fa fa-phone" aria-hidden="true" style="color: green; margin: 10px;"></i>
                0862201004
            </div>
            <form method="post" action="">
                <label>Họ tên</label> <br>
                <input type="text" class="form-control" name="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <label>Email</label> <br>
                <input type="email" class="form-control" name="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <?php
                if (isset($errlh1)) { ?>
                    <p style="color: red;"><?= $errlh1 ?></p>

                <?php }
                ?>
                <label>Số điện thoại</label> <br>
                <input type="tel" class="form-control" name="tel" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <?php
                if (isset($errlh2)) { ?>
                    <p style="color: red;"><?= $errlh2 ?></p>
                <?php }
                ?>
                <label>Nội dung</label> <br>
                <textarea class="form-control" aria-label="With textarea" name="noidung"></textarea>
                <input type="submit" name="submit" value="Gửi liên hệ" style="color: white; background-color: red; margin: 20px; padding: 5px 20px;">
            </form>
        </div>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119163.63738286112!2d105.59481929726563!3d21.038140300000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1sen!2s!4v1702197885983!5m2!1sen!2s" width="800px" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</main>