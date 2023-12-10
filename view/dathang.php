<?php
$pattern_tel = '/^(03[2-9]|07[0-9]|08[1-9]|09[0-9])[0-9]{7}$/';
if (!preg_match($pattern_tel, $_POST['tel'])) {
  if (isset($_POST['tel'])) {
    $errtel = 0;
  }
}
if (empty($_POST['tinh']) || empty($_POST['huyen']) || empty($_POST['xa']) || empty($_POST['name']) || empty($_POST['tel'])) {
  $name = $_POST['name'];
  $tel = $_POST['tel'];
  header("Location: index.php?act=giohang&thieutt&name=$name&tel=$tel");
}
if (isset($errtel)) {
  header("Location: index.php?act=giohang&saisdt&name=$name&tel=$tel");
}
?>
<main class="dathang">
  <div class="top">
    <h4 style="color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
      Địa chỉ nhận hàng
    </h4>
    <?php
    $email = $_SESSION['email_dn'];
    $taikhoan_email = taikhoan_email($email);
    $address = $_POST['tinh'] . "-" . $_POST['huyen'] . "-" . $_POST['xa'];
    ?>

    Họ và tên: <?= $_POST['name'] ?><br>
    Số điện thoại: <?= $_POST['tel'] ?><br>
    Địa chỉ nhận hàng: <?= $address  ?><br>
  </div>

  <div class="center">
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 45%;" colspan="2">SẢN PHẨM

          </th>
          <th style="width: 10%;">Loại</th>
          <th style="width: 10%;">Đơn giá</th>
          <th style="width: 15%;">Số lượng</th>
          <th style="width: 20%;">Thành tiền</th>
        </tr>
      </thead>
      <tbody>
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
          <td><img src="<?= $img_path . "sanpham/" . $sanpham['img'] ?>" alt="" width="100px"></td>
          <td> <?= $sanpham['name'] ?> </td>
          <td><?= $sanpham['size'] . '<br>' . $sanpham['color'] ?></td>
          <td><?= $sanpham['price'] ?></td>
          <td> <?= $soluong ?> </td>
          <td><?= $soluong * $sanpham['price'] ?></td>

          <?php
          $allprice = $soluong * $sanpham['price'];
          ?>

          <?php } else {

          if (isset($_POST['idphanloaidh'])) {
            $_SESSION['idphanloaidh'] = $_POST['idphanloaidh'];
          }
          $idphanloaidh = $_SESSION['idphanloaidh'];
          $allprice = 0;
          foreach ($idphanloaidh as $key => $value) {
            $sql = "SELECT sanpham.img,sanpham.name,size.size,color.color,sanpham.price,phanloaidh.soluong  from phanloaidh JOIN bienthe ON phanloaidh.bienthe=bienthe.id JOIN sanpham ON bienthe.idsp=sanpham.id JOIN size on size.id=bienthe.idsize JOIN color on color.id=bienthe.idcolor WHERE phanloaidh.id = $value";
            $bienthe = pdo_query($sql);
            foreach ($bienthe as $keybt => $valuebt) {
              $allprice += $valuebt['soluong'] * $valuebt['price'];
          ?>
              <tr>
                <td><img src="<?= $img_path . "sanpham/" . $valuebt['img'] ?>" alt="" width="100px"></td>
                <td> <?= $valuebt['name'] ?> </td>
                <td><?= $valuebt['size'] . '<br>' . $valuebt['color'] ?></td>
                <td><?= $valuebt['price'] ?></td>
                <td> <?= $valuebt['soluong'] ?> </td>
                <td><?= $valuebt['soluong'] * $valuebt['price'] ?></td>
              </tr>
        <?php  }
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <form action="" method="POST">

    <input type="hidden" name="name" value="<?= $_POST['name'] ?>">
    <input type="hidden" name="tel" value="<?= $_POST['tel'] ?>">
    <input type="hidden" name="address" value="<?= $address ?>">

    <?php $vocher = 0;

    if (isset($_POST['vocher']) && $_POST['vocher'] != "") {
      $_SESSION['vocher'] = $_POST['vocher'];
      $vocher = $_SESSION['vocher'];
    } ?>
    <div class="thanhtoan">
      <div class="top">
        <p>PHƯƠNG THỨC THANH TOÁN:</p>
        <div class="radio_thanhtoan">
          <input type="radio" class="btn-check" name="thanhtoan" value="0" id="option5" autocomplete="off" onclick="thanhtoan_text(2)">
          <label class="btn" for="option5">Thanh toán khi nhận hàng</label>
          <input type="radio" class="btn-check" name="thanhtoan" value="1" id="option6" autocomplete="off" onclick="thanhtoan_text(1)">
          <label class="btn" for="option6">Thanh toán online</label>
        </div>
      </div>
      <div id="thanhtoan_text"></div>
      <?php
      $sql = "SELECT CONCAT( YEAR(CURRENT_TIMESTAMP()), LPAD(MONTH(CURRENT_TIMESTAMP()), 2, '0'), LPAD(DAY(CURRENT_TIMESTAMP()), 2, '0'), LPAD(HOUR(CURRENT_TIMESTAMP()), 2, '0'), LPAD(MINUTE(CURRENT_TIMESTAMP()), 2, '0'), LPAD(SECOND(CURRENT_TIMESTAMP()), 2, '0') ) AS mahd";
      $mahd = pdo_query_one($sql);
      $sql2 = "SELECT CURRENT_TIMESTAMP;";
      $date = pdo_query_one($sql2);
      $date_ht = $date['CURRENT_TIMESTAMP'];
      $madh_ht = $mahd['mahd'];
      $tongthanhtoan = $allprice - $vocher;
      if ($vocher > $allprice) {
        $tongthanhtoan = 0;
      }
      ?>
      <script>
        function thanhtoan_text(number) {
          if (number == 1) {
            document.getElementById("thanhtoan_text").innerHTML = `
              <div class="tongtienhang"><p>Tổng tiền hàng :<?= number_format($allprice, 0, ',', '.') . "đ"; ?></p></div>
    <p id="selectedValue">Giảm giá :  <?= "-" . number_format($vocher, 0, ',', '.') . "đ"; ?></p>
<input type="hidden" name="order_id" value="<?= $madh_ht ?>">
              <input type="hidden" name="order_desc" value="<?= 'Thanh toán hóa đơn: ' . $madh_ht ?>"> 
   <input type="hidden" name="amount" value="<?= $tongthanhtoan ?>">
   <input type="hidden" name="vocher" value="<?= $vocher ?>">

   <input type="hidden" name="date" value="<?= $date_ht ?>">
   <input type="hidden" name="order_type" value="<?= 'Giày Panda shop' ?>">
    <div class="tongtienhang"><p>Tổng thanh toán : <?= number_format($tongthanhtoan, 0, ',', '.') . "đ"; ?></p></div>
              <input type="submit" name="dathang" value="Thanh toán"  style="width:100%; height: 50px; color: white; background-color: red; font-weight: bolder;">
            `;
          } else if (number == 2) {
            document.getElementById("thanhtoan_text").innerHTML = `
            <input type="hidden" name="order_id" value="<?= $madh_ht ?>">
              <input type="hidden" name="order_desc" value="<?= 'Thanh toán hóa đơn: ' . $madh_ht ?>"> 
   <input type="hidden" name="amount" value="<?= $tongthanhtoan ?>">
   <input type="hidden" name="vocher" value="<?= $vocher ?>">
   <input type="hidden" name="date" value="<?= $date_ht ?>">
    <div class="thongtin_dathang">
    <div class="tongtienhang"><p>Tổng tiền hàng : <?= number_format($allprice, 0, ',', '.') . "đ"; ?></p></div>
    <p id="selectedValue">Giảm giá : <?= "-" . number_format($vocher, 0, ',', '.') . "đ"; ?></p>
    <div class="tongtienhang"><p>Tổng thanh toán : <?= number_format($tongthanhtoan, 0, ',', '.') . "đ"; ?></p></div>
    <div class="tongtienhang"><input  style="width:100%; height: 50px; color: white; background-color: red; font-weight: bolder;" type="submit" value="Đặt hàng" name="" id=""></div>
  </div>


            `;
          }
        }
      </script>

    </div>
  </form>

  <?php
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
  $name = $_POST['name'];
  $tel = $_POST['tel'];
  $address = $_POST['address'];
  $vnp_Returnurl = "http://localhost/DU_AN_1/User/view/index.php?act=dathang&thanhtoan=1&amount=$tongthanhtoan&vocher=$vocher&date=$date_ht&order_id=$madh_ht&name=$name&tel=$tel&address=$address";
  $vnp_TmnCode = "UWG6PCZA";
  $vnp_HashSecret = "LUNHEZKVDQOHGREXBRTBHVXQTATQKQOO";
  if (isset($_POST['dathang'])) {
    $vnp_TxnRef =  $_POST['order_id']; //Mã hóa đơn
    $vnp_OrderInfo = $_POST['order_desc']; //Nội dung
    $vnp_OrderType = $_POST['order_type']; //Loại hàng
    $vnp_Amount = $_POST['amount'] * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = $_POST['bank_code'];
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
      $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
  }

  $returnData = array(
    'code' => '00', 'message' => 'success', 'data' => $vnp_Url
  );
  if (isset($_POST['dathang'])) {
    header('Location: ' . $vnp_Url);
    die();
  } else {
  }
  ?>
  <?php
  if (isset($_POST['thanhtoan']) || isset($_GET['thanhtoan'])) {

    if (isset($_POST["thanhtoan"])) {
      $hoten = $_POST['name'];
      $sdt = $_POST['tel'];
      $diachi = $_POST['address'];
      $hinhthuc = $_POST['thanhtoan'];
      $tongtien = $_POST['amount'];
      $sale = $_POST['vocher'];
      $date = $_POST['date'];
      $madh = $_POST['order_id'];
    }
    if (isset($_GET["thanhtoan"])) {
      $hoten = $_GET['name'];
      $sdt = $_GET['tel'];
      $diachi = $_GET['address'];
      $hinhthuc = $_GET['thanhtoan'];
      $tongtien = $_GET['amount'];
      $sale = $_GET['vocher'];
      $date = $_GET['date'];
      $madh = $_GET['order_id'];
    }

    if (isset($_SESSION['dathang'])) {
      $id_user = $taikhoan_email['id'];
      $idsp_dh = $_SESSION['dathang'][0]['idsp'];
      $soluong = $_SESSION['dathang'][0]['soluong'];
      $color = $_SESSION['dathang'][0]['color'];
      $size = $_SESSION['dathang'][0]['size'];
      $sql = "SELECT id FROM `bienthe` WHERE bienthe.idcolor =$color and bienthe.idsize=$size AND bienthe.idsp=$idsp_dh";
      $lay_bienthe = pdo_query_one($sql);
      $bienthe = $lay_bienthe['id'];
      $sql1 = "INSERT INTO `phanloaidh` (`iduser`, `soluong`, `idtrangthai`,`madh`, `bienthe`, `danhgia`) VALUES ('$id_user', '$soluong', '3','$madh', ' $bienthe', '0');";
      pdo_execute($sql1);
    } else {
      foreach ($idphanloaidh as $key => $value) {
        update_trangthai($madh, $value);
      }
    }
    echo $hinhthuc . '<br>' . $sale . '<br>' . $date . '<br>' . $madh . '<br>' . $tongtien . '<br>' . $hoten . '<br>' . $sdt . '<br>' . $diachi;
    insert_chitietdh($hinhthuc, $sale, $date, $madh, $tongtien, $hoten, $sdt, $diachi);
    $id_user = $taikhoan_email['id'];
    if ($vocher != 0) {
      $sql = "DELETE FROM vocher WHERE `vocher`.`iduser` = $id_user";

      pdo_execute($sql);
    }

    header("Location: index.php?act=myaccout&profile=3&dathangtc");
    unset($_SESSION['dathang']);
  }
  ?>
  <?php
  ?>
</main>