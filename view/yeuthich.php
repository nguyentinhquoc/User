<main class="yeuthich">

<?php 
if (isset($_GET['yeuthich_remove'])) {
$id=$_GET['yeuthich_remove'];
yeuthich_remove($id);
}
?>

    <div class="container_yeuthich">
        <h4>Sản phẩm yêu thích</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Xóa</th>
                    <th scope="col">Ảnh sản phẩm</th>
                    <th scope="col">Tên sản phẩm </th>
                    <th scope="col">Giá sản phẩm</th>

                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                            $email = $_SESSION['email_dn'];
                    $sanpham_yeuthich = sanpham_yeuthich($email);
                    $dem = 0;
                    foreach ($sanpham_yeuthich as $key) {
                        $dem++;
                    ?>
                        <th scope="row"><?= $dem ?></th>
                        <td><a onclick="return(confirm('Bạn có chắc chắn muốn xóa ?'))" href="index.php?act=yeuthich&yeuthich_remove=<?= $key['id']?>"><i class="fa fa-trash-o" aria-hidden="true"></a></i></td>
                        <td><img src="<?= $img_path . "sanpham/" . $key['img'] ?>" alt="" width="100px"></td>
                        <td><?= $key['name'] ?></td>
                        <td><?= $key['price'] ?></td>
                        <td><i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </td>
                </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</main>