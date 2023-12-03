<?php
include("../../model/pdo.php");
$sao = $_POST['sao'];
$iduser = $_POST['iduser'];
$danhgia = "";
$id = $_POST['idbt'];

?>

<form action="" method="post">
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Nhập đánh giá</label>
        <div class="sao">
            <input type="hidden" name="sao" value="<?= $sao ?>">
            <?php
            for ($i = 1; $i <= $sao; $i++) { ?>
                <i onclick="danhgia(<?= $id ?>,<?= $i ?>,<?= $iduser ?>)" class="fa fa-star" aria-hidden="true" style="color: #f6931f;"></i>
            <?php }
            for ($i = $sao + 1; $i <= 5; $i++) {  ?>
                <i onclick="danhgia(<?= $id ?>,<?= $i ?>,<?= $iduser ?>)" class="fa fa-star-o" aria-hidden="true"></i>
            <?php } ?>

        </div>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="danhgia"></textarea>
        <input type="submit" style="width: 100%; height: 40px" name="submit_danhgia" value="Gửi đánh giá">
    </div>
</form>