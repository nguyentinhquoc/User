<div class="container_thongbao">
    <h4 style='width: 100%; background-color: #fad9f6; text-align: center; padding: 20px;  font-family: "Times New Roman", Times, serif; font-weight: bolder;'>Thông báo</h4>
    <div class="thongbao">
        <?php
        $demthongbao = 0;
        $all_thongbao = all_thongbao();
        foreach ($all_thongbao as $key => $value) {
            $demthongbao++;
        ?>
            <div class="item">
                <img src="<?= $img_path . "thongbao/" . $value['img'] ?>" alt="" width="100px" height="100px">
                <div class="content" style="margin: 10px;">
                    <h5><?= $value['header'] ?></h5>
                    <p><?= $value['noidung'] ?></p>
                </div>
            </div>
        <?php } ?>

    </div>
</div>