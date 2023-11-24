<div class="giohang">

   
    <?php
    if (isset($_GET['cart_remove'])) {
        $id = $_GET['cart_remove'];
        cart_remove($id);
    }
    ?>
    <form action="index.php?act=dathang" method="post">
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
                        <th scope="row"><?= $key + 1; ?></th>
                        <td><input type="checkbox" class="checkbox" name="idphanloaidh[]" value="<?= $value['id'] ?>"></td>
                        <td><img src="<?= $img_path . "sanpham/" . $value['img'] ?>" alt="" width="100px"></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= "Màu:" . $value['color'] . "<br>" . "Size:" . $value['size'] ?></td>
                        <td><?= $value['soluong'] ?></td>
                        <td><?= number_format($value['tongtien'], 0, ',', '.');  ?></td>
                        <td><a onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=giohang&cart_remove=<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></a></i></td>
                        </td>
                </tr>
            <?php
                    }
            ?>
            <script>
                var checkBoxAll = document.getElementById('checkboxAll');
                var checkBox = document.getElementsByClassName('checkbox');
                checkBoxAll.addEventListener('click', function() {
                    for (var i = 0; i < checkBox.length; i++) {
                        checkBox[i].checked = checkBoxAll.checked;
                    }
                });
            </script>
            </tbody>
        </table>
        <div class="vocher">
            <i class="fa fa-ticket" aria-hidden="true"></i>
            <p>PANDA SHOP Vocher </p>
            <select id="vocher" name="vocher">
                <option value="">Không áp mã</option>
                <?php $user = $_SESSION['email_dn'];

                $vocher_where_user = vocher_where_user($user);
                foreach ($vocher_where_user as $key => $value) { ?>
                    <option value="<?= $value['sale']?>"><?= 'Giảm giá: ' . $value['sale'] ?></option>
                <?php }

                ?>

            </select>


        </div>
        <button>Đặt hàng </button>
    </form>
</div>