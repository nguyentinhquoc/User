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

        <div style="display: flex;">
            <?php
            if (isset($_GET['cart_remove'])) {
                $id = $_GET['cart_remove'];
                cart_remove($id);
            }
            ?>
            <div>
                <table class="table table-striped" <?php
                                                    if (isset($_SESSION['dathang'])) {

                                                        echo ' style="width:900px;"';
                                                    }
                                                    ?> ><thead>
                    <tr>
                        <th scope="col">#</th>
                        <?php
                        if (!isset($_SESSION['dathang'])) { ?>
                            <th scope="col"><input type="checkbox" id="checkboxAll" class="form-check-input mt-0"> Tất cả</th>
                        <?php } ?>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Tên sản phẩm </th>
                        <th scope="col"> Phân loại</th>
                        <th scope="col"> Số lượng</th>
                        <th scope="col">Giá sản phẩm</th>
                        <?php
                        if (!isset($_SESSION['dathang'])) { ?>
                            <th scope="col">Thao tác</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <?php
                            if (isset($_SESSION['dathang'])) {
                                $taikhoan_email['id'];
                                $idsp_dh = $_SESSION['dathang'][0]['idsp'];
                                $soluong = $_SESSION['dathang'][0]['soluong'];
                                $color = $_SESSION['dathang'][0]['color'];
                                $size = $_SESSION['dathang'][0]['size'];
                                $sql = "SELECT sanpham.img,sanpham.name,sanpham.price,size.size,color.color FROM sanpham join bienthe ON bienthe.idsp=sanpham.id JOIN size ON bienthe.idsize=size.id JOIN color ON color.id=bienthe.idcolor where bienthe.idcolor = $color and  bienthe.idsize=$size and bienthe.idsp=$idsp_dh";
                                $sanpham = pdo_query_one($sql);
                            ?>
                                <td>1</td>
                                <td><img src="<?= $img_path . "sanpham/" . $sanpham['img'] ?>" alt="" width="100px"></td>
                                <td> <?= $sanpham['name'] ?> </td>
                                <td><?= $sanpham['size'] . '<br>' . $sanpham['color'] ?></td>
                                <td> <?= $soluong ?> </td>
                                <td><?= $sanpham['price'] ?></td>
                                <?php
                                $allprice = $soluong * $sanpham['price'];
                                ?>

                                <?php } else {
                                $email = $_SESSION['email_dn'];
                                $sanpham_giohang = sanpham_giohang($email);
                                foreach ($sanpham_giohang as $key => $value) {
                                ?>
                                    <th scope="row"><?= $key + 1;
                                                    $value['id']  ?></th>
                                    <td><input class="form-check-input mt-0 checkbox"  type="checkbox" name="idphanloaidh[]" value="<?= $value['id'] ?>"></td>
                                    <td><img src="<?= $img_path . "sanpham/" . $value['img'] ?>" alt="" width="100px"></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= "Màu:" . $value['color'] . "<br>" . "Size:" . $value['size'] ?></td>
                                    <td><input type="number" value="<?= $value['soluong'] ?>" min="1" max="<?= $value['slmax'] ?>" style="width: 50px;" id="soluong_<?= $value['id'] ?>" oninput="setsoluong(<?= $value['id'] ?>,<?= $value['slmax'] ?>)"></td>
                                    <td><?= number_format($value['soluong'] * $value['price'], 0, ',', '.') . " đ";  ?></td>
                                    <td><a onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=giohang&cart_remove=<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></a></i></td>
                                    </td>
                        </tr>
                <?php
                                }
                            }
                ?>
                    </tbody>
                </table>
            </div>
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
            <div style="width: 30%; margin-left: 10px;">
                <?php
                $email = $_SESSION['email_dn'];
                $taikhoan_email = taikhoan_email($email); ?>
                <div style="border: 1px solid; padding: 20px;">
                    <h4>Thông tin nhận hàng</h4>
                    <input type="hidden" value="" name="address">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Họ và tên:</span>
                        <?php
                        $name_gh = $taikhoan_email['name'];
                        $tel_gh = $taikhoan_email['tel'];
                        if (isset($_GET['name'])) {
                            $name_gh = $_GET['name'];
                        }
                        if (isset($_GET['tel'])) {
                            $tel_gh = $_GET['tel'];
                        }
                        ?>
                        <input type="text" name="name" value="<?= $name_gh ?>" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                    </div> <br>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"> Số điện thoại:</span>
                        <input type="tel" name="tel" value="<?= $tel_gh ?>" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                    </div> <br>
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
                    </div>
                </div><br>
            </div>
        </div>
        <div class="vocher">
            <i class="fa fa-ticket" aria-hidden="true" style="font-size: 40px; color: orange;"></i>
            <p>PANDA SHOP Voucher </p>
            <select style="width: 220px; height: 40px;" id="vocher" name="vocher" class="form-select" aria-label="Default select example">
                <option value="">Không áp mã</option>
                <?php $user = $_SESSION['email_dn'];

                $vocher_where_user = vocher_where_user($user);
                foreach ($vocher_where_user as $key => $value) { ?>
                    <option value="<?= $value['sale'] ?>"><?= 'Giảm giá: ' . number_format($value['sale'], 0, ',', '.') . "đ"; ?></option>
                <?php }
                ?>
            </select>
        </div>
        <button style="margin: 20px 0px; width: 100%;" name="submit_giohang">Đặt hàng </button>
    </form>
</div>