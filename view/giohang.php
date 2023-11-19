<div class="giohang">
    
  <div class="top">
    <h4 style="color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
      Địa chỉ nhận hàng
    </h4>
    Họ và tên: Nguyễn Quốc Tình<br>
    Số điện thoại: 0366904133<br>
    Địa chỉ nhận hàng: Yên LÂm-Yên Mô-Ninh Bình<br>
  </div>
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
                    <td><input type="checkbox" class="checkbox" name="id_bienthe[]" value="<?=$value['id']?>"></td>
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
    
<select id="vocher" name="vocher" onchange="showSelectedValue()">
    <option value="option1">Không áp mã</option>
    <option value="option2">Vocher 1</option>
    <option value="option3">Vocher 2</option>
</select>

  </div>
    <button>Đặt hàng</button>
    </form>
</div>