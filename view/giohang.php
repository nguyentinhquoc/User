<?php
if (isset($_GET['trupl'])) {
    $id = $_GET['trupl'];
    $sql = "UPDATE `phanloaidh` SET `soluong` = soluong-1 WHERE `phanloaidh`.`id` = $id";
    pdo_execute($sql);
}
if (isset($_GET['congpl'])) {
    $id = $_GET['congpl'];
    $sql = "UPDATE `phanloaidh` SET `soluong` = soluong+1 WHERE `phanloaidh`.`id` = $id";
    pdo_execute($sql);
}
?>
<div class="giohang">
    <h3> Giỏ hàng </h3>
    <form action="index.php?act=dathang" method="post">
        <?php
        $email = $_SESSION['email_dn'];
        $taikhoan_email = taikhoan_email($email); ?>
        <form action="" method="POST">
            <input type="hidden" value="" name="address">
            Họ và tên: <input type="text" name="name" value="<?= $taikhoan_email['name'] ?>"><br>
            Số điện thoại:<input type="tel" name="tel" value="<?= $taikhoan_email['tel'] ?>"> <br>
            Địa chỉ nhận hàng: <div class="adress">
                <select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm" name="tinh">
                    <option value="" selected>Chọn tỉnh thành</option>
                </select>
                <select class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm" name="huyen">
                    <option value="" selected>Chọn quận huyện</option>
                </select>
                <select class="form-select form-select-sm" id="ward" aria-label=".form-select-sm" name="xa">
                    <option value="" selected>Chọn phường xã</option>
                </select>
            </div><br>

            <?php
            if (isset($_GET['cart_remove'])) {
                $id = $_GET['cart_remove'];
                cart_remove($id);
            }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><input type="checkbox" id="checkboxAll"> Tất cả</th>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Tên sản phẩm </th>
                        <th scope="col"> Phân loại</th>
                        <th scope="col"> Số lượng</th>
                        <th scope="col">Giá sản phẩm</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $email = $_SESSION['email_dn'];
                        $sanpham_giohang = sanpham_giohang($email);
                        foreach ($sanpham_giohang as $key => $value) {
                        ?>
                            <th scope="row"><?= $key + 1;
                                            $value['id']  ?></th>
                            <td><input type="checkbox" class="checkbox" name="idphanloaidh[]" value="<?= $value['id'] ?>"></td>
                            <td><img src="<?= $img_path . "sanpham/" . $value['img'] ?>" alt="" width="100px"></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= "Màu:" . $value['color'] . "<br>" . "Size:" . $value['size'] ?></td>
                            <td><input type="number" value="<?= $value['soluong'] ?>" min="1" max="<?= $value['slmax'] ?>" style="width: 50px;" id="soluong_<?= $value['id'] ?>" oninput="setsoluong(<?= $value['id'] ?>,<?= $value['slmax'] ?>)"></td>
                            <td><?= number_format($value['soluong'] * $value['price'], 0, ',', '.');  ?></td>
                            <td><a onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=giohang&cart_remove=<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></a></i></td>
                            </td>
                    </tr>
                <?php
                        }
                ?>
                </tbody>
            </table>

            <script>
                function setsoluong(id, slmax) {
                    let soluong_new = $('#soluong_' + id).val();
                    if (soluong_new > slmax) {
                        $('#soluong_' + id).val(slmax)
                    }
                    if (soluong_new <= 0) {
                        soluong_new = 1;
                    }
                    $.post("ajax/sl_giohang.php", {
                        id: id,
                        slmax: slmax,
                        soluong_new: soluong_new
                    }, function(data) {
                        $(".table").html(data);
                    });
                }
                var checkBoxAll = document.getElementById('checkboxAll');
                var checkBox = document.getElementsByClassName('checkbox');
                checkBoxAll.addEventListener('click', function() {
                    for (var i = 0; i < checkBox.length; i++) {
                        checkBox[i].checked = checkBoxAll.checked;
                    }
                });
            </script>
            <div class="vocher">
                <i class="fa fa-ticket" aria-hidden="true" style="font-size: 40px; color: orange;"></i>
                <p>PANDA SHOP Vocher </p>
                <select id="vocher" name="vocher">
                    <option value="">Không áp mã</option>
                    <?php $user = $_SESSION['email_dn'];

                    $vocher_where_user = vocher_where_user($user);
                    foreach ($vocher_where_user as $key => $value) { ?>
                        <option value="<?= $value['sale'] ?>"><?= 'Giảm giá: ' . $value['sale'] ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <button name="submit_giohang">Đặt hàng </button>
        </form>
</div>