<div class="container_thongbao">
    <h3>Thông báo</h3>
    
    <div class="thongbao">
        <?php
        $demthongbao =0;
        $all_thongbao=all_thongbao();
foreach ($all_thongbao as $key => $value) { 
$demthongbao ++;
?>
        <div class="item">
            <img src="<?= $img_path . "thongbao/" . $value['img'] ?>" alt="" width="100px" height="100px">
            <div class="content">
                <h5><?=$value['header']?></h5>
                <p><?=$value['noidung']?></p>
            </div>
        </div>
        <?php } ?>

    </div>
</div>