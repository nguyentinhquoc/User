    <?php
    $id = $_GET['idbt'];
    $idpl = $_GET['idpl'];
    $sql = "SELECT * FROM sanpham join bienthe on sanpham.id=bienthe.idsp join size on bienthe.idsize=size.id join color on color.id=bienthe.idcolor where bienthe.id = '$id'";
    $danhgia = "";
    $load_danhgia = pdo_query_one($sql);
    $email = $_SESSION['email_dn'];
    $id_user = taikhoan_email($email);
    $iduser = $id_user['id'];
    if (isset($_POST['submit_danhgia'])) {
    $sao = $_POST['sao'];
        $danhgia = $_POST['danhgia'];
        $sql = "INSERT INTO `danhgia` (`iduser`, `binhluan`, `idbienthe`, `danhgia`) VALUES ('$iduser ', '$danhgia', '$id', '$sao');";
        pdo_execute($sql);
        $sql2 = "UPDATE `phanloaidh` SET `danhgia` = '1' WHERE `phanloaidh`.`id` = $idpl;";
        pdo_execute($sql2);
        header("Location: index.php?act=myaccout&profile=3&trangthai=5");
    }

    ?>

    <table class="table" style="margin-top: 100px;">
        <thead>
            <tr>
                <th scope="col"># </th>
                <th scope="col">Ảnh sản phẩm</th>
                <th scope="col">Tên sản phảm</th>
                <th scope="col">Loại</th>
                <th scope="col">Giá</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td>
                    <img src="<?= $img_path . 'sanpham/' . $load_danhgia['img'] ?>" alt="" width="100px">
                </td>
                <td><?= $load_danhgia['name'] ?></td>
                <td><?= 'Size:' . $load_danhgia['size'] . '<br>' . 'Màu:' . $load_danhgia['color'] ?></td>
                <td><?= $load_danhgia['price'] ?></td>
            </tr>
        </tbody>
    </table>
    <div class="form">
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Nhập đánh giá</label>
                <div class="sao">
                    <input type="hidden" name="sao" value="5">
                    <?php
                    for ($i = 1; $i <= 5; $i++) { ?>
                        <i onclick="danhgia(<?= $id ?>,<?= $i ?>,<?= $iduser?>)" class="fa fa-star" aria-hidden="true" style="color: #f6931f;"></i>
                    <?php }
                    ?>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="danhgia"></textarea>
                <input type="submit" style="width: 100%; height: 40px" name="submit_danhgia" value="Gửi đánh giá">
            </div>
        </form>
    </div>

    <script>
        function danhgia(idbt, sao, iduser) {
            $.post("ajax/danhgia.php", {
                sao: sao,
                iduser: iduser,

                idbt: idbt,
            }, function(data) {
                $(".form").html(data);
            });
        }
    </script>