<main class="yeuthich">

    <?php
    if (isset($_GET['yeuthich_remove'])) {
        $id = $_GET['yeuthich_remove'];
        yeuthich_remove($id);
    }
    if (isset($_SESSION['email_dn'])) {
        $email = $_SESSION['email_dn'];
        $sql = "SELECT id FROM taikhoan WHERE email='$email'";
        $id_acc = pdo_query_one($sql);
        $iduser = $id_acc['id'];
        if (isset($_GET['add_cart'])) {
            $idsp = $_GET['add_cart'];
            cart_add($idsp, $iduser);
        }
    }

    ?>

    <div class="container_yeuthich">
        <h4 style='width: 100%; background-color: #fad9f6; text-align: center; padding: 20px;  font-family: "Times New Roman", Times, serif; font-weight: bolder;'>Sản phẩm yêu thích</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ảnh sản phẩm </th>
                    <th scope="col">Tên sản phẩm </th>
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $email = $_SESSION['email_dn'];
                    $sanpham_yeuthich = sanpham_yeuthich($email);
                    $dem_love = 0;
                    foreach ($sanpham_yeuthich as $key => $value) {
                        ?>
                        <tr> 
                            <th scope="row"> <a href="index.php?act=sanpham_chitiet&id=<?=$value['idsp']?>"><?= $key + 1 ?> </a></th>
                            <td><a href="index.php?act=sanpham_chitiet&id=<?=$value['idsp']?>"><img src="<?= $img_path . "sanpham/" . $value['img'] ?>" alt="" width="100px"></a></td>
                            <td><a href="index.php?act=sanpham_chitiet&id=<?=$value['idsp']?>"><?= $value['name'] ?></a></td>
                            <td><a href="index.php?act=sanpham_chitiet&id=<?=$value['idsp']?>"><?= number_format($value['price'], 0, ',', '.');  ?></a></td>
                        <td><a style="margin-left: 20px;" onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=yeuthich&yeuthich_remove=<?= $value['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true" style="font-size: 30px; "></i></a>

                        </td>
                </tr>
            <?php
                    }

            ?>
            </tbody>
        </table>
    </div>
</main>