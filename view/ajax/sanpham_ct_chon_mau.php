<?php
include("../global.php");
include("../../model/pdo.php");
include("../../model/sanpham.php");

$idsp = $_POST["idsp"];
$idcolor = $_POST["color"];
$all_size = size_color($idcolor, $idsp);
echo "Size:";
if(empty($all_size)){
    echo '<p style="border: 1px solid; text-align: center; width: 200px; height: 45px; padding-top: 10px; margin-left: 20px; color: red;">HẾT SIZE</p>';
}
foreach ($all_size as $key => $value) {
?>
    <div class="custom-radio" id="size">
        <input type="radio" id="<?= $value['size'] ?>" name="size" value="<?= $value['id'] ?>"">
        <label for="<?= $value['size'] ?>"><?= $value['size'] ?></label>
    </div>
<?php } ?>