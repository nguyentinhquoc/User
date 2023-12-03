<?php
session_start();
include("../../model/pdo.php");
include("../global.php");
include("../../model/sanpham.php");
?>
<thead>

    <tr>
        <th scope="col">#</th>
        <th scope="col"><input type="checkbox" id="checkboxAll"> Tất cả</th>
        <th scope="col">Ảnh sản phẩm</th>
        <th scope="col">Tên sản phẩm </th>
        <th scope="col"> Phân loại</th>
        <th scope="col"> Số lượng</th>
        <th scope="col">Giá sản phẩm</th>
        <th scope="col">Thao tác
        </th>
    </tr>
</thead>
<tbody>
    <tr>
        <?php
        $email = $_SESSION['email_dn'];
        $sanpham_giohang = sanpham_giohang($email);
        foreach ($sanpham_giohang as $key => $value) {
        ?>
            <th scope="row"><?= $key + 1; ?></th>
            <td><input type="checkbox" class="checkbox" name="idphanloaidh[]" value="<?= $value['id'] ?>"></td>
            <td><img src="<?= $img_path . "sanpham/" . $value['img'] ?>" alt="" width="100px"></td>
            <td><?= $value['name'] ?></td>
            <td><?= "Màu:" . $value['color'] . "<br>" . "Size:" . $value['size'] ?></td>
            <?php
            if (isset($_POST['soluong_new']) && $value['id'] == $_POST['id']) {
                $value['soluong'] = $_POST['soluong_new'];
                $sl = $_POST['soluong_new'];
                $id = $_POST['id'];
                $sql = "UPDATE `phanloaidh` SET `soluong` = '$sl' WHERE `phanloaidh`.`id` = $id;";
                pdo_execute($sql);
            }

            ?>

<td><input type="number" value="<?= $value['soluong'] ?>" min="1" max="<?= $value['slmax'] ?>" style="width: 50px;" id="soluong_<?= $value['id'] ?>" oninput="setsoluong(<?=$value['id'] ?>,<?=$value['slmax']?>)"></td>

            <td><?= number_format($value['soluong'] * $value['price'], 0, ',', '.');  ?></td>

            <td><a onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=giohang&cart_remove=<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></a></i></td>
            </td>
    </tr>
<?php
        }
?>
</tbody>