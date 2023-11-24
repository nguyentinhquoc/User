<main class="dathang">
<div class="top">
        <h4 style="color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
            Địa chỉ nhận hàng


        </h4>
        <?php
        $email=$_SESSION['email_dn'];
        $taikhoan_email = taikhoan_email($email); ?>
        Họ và tên: <?=$taikhoan_email['name']?><br>
        Số điện thoại: <?=$taikhoan_email['tel']?><br>
        Địa chỉ nhận hàng: <?=$taikhoan_email['address']?><br>
    </div>
  <div class="center">
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 45%;" colspan="2">SẢN PHẨM</th>
          <th style="width: 10%;">Loại</th>
          <th style="width: 10%;">Đơn giá</th>
          <th style="width: 15%;">Số lượng</th>
          <th style="width: 20%;">Thành tiền</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST['idphanloaidh'])) {
          $_SESSION['idphanloaidh'] = $_POST['idphanloaidh'];
        }
        $idphanloaidh = $_SESSION['idphanloaidh'];
        $allprice = 0;
        foreach ($idphanloaidh as $key => $value) {
          $sql = "SELECT sanpham.img,sanpham.name,size.size,color.color,sanpham.price,phanloaidh.soluong,phanloaidh.tongtien  from phanloaidh JOIN bienthe ON phanloaidh.bienthe=bienthe.id JOIN sanpham ON bienthe.idsp=sanpham.id JOIN size on size.id=bienthe.idsize JOIN color on color.id=bienthe.idcolor WHERE phanloaidh.id = $value";
          $bienthe = pdo_query($sql);
          foreach ($bienthe as $keybt => $valuebt) {
            $allprice += $valuebt['tongtien'];
        ?>
            <tr>
              <td><img src="<?= $img_path . "sanpham/" . $valuebt['img'] ?>" alt="" width="100px"></td>
              <td> <?= $valuebt['name'] ?> </td>
              <td><?= $valuebt['size'] . '<br>' . $valuebt['color'] ?></td>
              <td><?= $valuebt['price'] ?></td>
              <td> <?= $valuebt['soluong'] ?> </td>
              <td><?= $valuebt['tongtien'] ?></td>
            </tr>
        <?php  }
        }
        ?>

      </tbody>
    </table>
  </div>
  <form action="" method="POST">
    <?php $vocher = 0;
    
    if (isset($_POST['vocher']) && $_POST['vocher'] != "") {
      $_SESSION['vocher'] = $_POST['vocher'];
      $vocher = $_SESSION['vocher'];
    } ?>
    <div class="thanhtoan">
      <div class="top">
        <p>PHƯƠNG THỨC THANH TOÁN:</p>
        <div class="radio_thanhtoan">
          <input type="radio" class="btn-check" name="thanhtoan" value="offline" id="option5" autocomplete="off" onclick="thanhtoan_text(2)">
          <label class="btn" for="option5">Thanh toán khi nhận hàng</label>
          <input type="radio" class="btn-check" name="thanhtoan" value="offline" id="option6" autocomplete="off" onclick="thanhtoan_text(1)">
          <label class="btn" for="option6">Thanh toán online</label>
        </div>
      </div>
      <div id="thanhtoan_text"></div>
      <?php
      $sql = "SELECT CONCAT( YEAR(CURRENT_TIMESTAMP()), LPAD(MONTH(CURRENT_TIMESTAMP()), 2, '0'), LPAD(DAY(CURRENT_TIMESTAMP()), 2, '0'), LPAD(HOUR(CURRENT_TIMESTAMP()), 2, '0'), LPAD(MINUTE(CURRENT_TIMESTAMP()), 2, '0'), LPAD(SECOND(CURRENT_TIMESTAMP()), 2, '0') ) AS mahd";
      $mahd = pdo_query_one($sql);
      $sql2 = "SELECT CURRENT_TIMESTAMP;";
      $date = pdo_query_one($sql2);
  $date_ht=$date['CURRENT_TIMESTAMP'];
  $madh_ht=$mahd['mahd'];
  $tongthanhtoan=$allprice - $vocher;

      ?>
      <script>
        function thanhtoan_text(number) {

          if (number == 1) {
            document.getElementById("thanhtoan_text").innerHTML = `
              <div class="tongtienhang"><p>Tổng tiền hàng : <?php echo $allprice ?></p></div>
    <p id="selectedValue">Giảm giá : <?php
                                      echo -$vocher;
                                      ?></p>

<input type="hidden" name="order_id" value="<?= $madh_ht ?>">
              <input type="hidden" name="order_desc" value="<?= 'Thanh toán hóa đơn: ' . $madh_ht ?>"> 
   <input type="hidden" name="amount" value="<?= $tongthanhtoan ?>">
   <input type="hidden" name="vocher" value="<?= $vocher ?>">
   <input type="hidden" name="date" value="<?= $date_ht ?>">
   <input type="hidden" name="order_type" value="<?='Giày Panda shop' ?>">


    <div class="tongtienhang"><p>Tổng thanh toán : <?= $tongthanhtoan ?></p></div>
                        <select name="bank_code">
                            <option value="">Chọn ngân hàng</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>

              <input type="submit" name="dathang" value="Thanh toán">
            `;
      
          } else if (number == 2) {
            // http://localhost:3000/DU_AN_1/user/view/index.php?options-base=on&order_id=20231123082614&order_desc=20231123082614&amount=1499950
            document.getElementById("thanhtoan_text").innerHTML = `
            <input type="hidden" name="order_id" value="<?= $madh_ht ?>">
              <input type="hidden" name="order_desc" value="<?= 'Thanh toán hóa đơn: ' . $madh_ht ?>"> 
   <input type="hidden" name="amount" value="<?= $tongthanhtoan ?>">
   <input type="hidden" name="vocher" value="<?= $vocher ?>">
   <input type="hidden" name="date" value="<?=  $date_ht ?>">
    <div class="thongtin_dathang">
    <div class="tongtienhang"><p>Tổng tiền hàng : <?php echo $allprice ?></p></div>
    <p id="selectedValue">Giảm giá : <?php echo  -$vocher; ?></p>
    <div class="tongtienhang"><p>Tổng thanh toán : <?= $tongthanhtoan ?></p></div>
    <div class="tongtienhang"><input type="submit" value="Đặt hàng" name="" id=""></div>
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
  $vnp_Returnurl = "http://localhost:3000/DU_AN_1/user/view/index.php?act=dathang&thanhtoan=Online&amount=$tongthanhtoan&vocher=$vocher&date=$date_ht&order_id=$madh_ht";
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

    //var_dump($inputData);
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
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
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
if (isset($_POST['thanhtoan'])) {
  $hinhthuc=$_POST['thanhtoan'];
  $tongtien=$_POST['amount'];
  $sale=$_POST['vocher'];
  $date=$_POST['date'];
  $madh=$_POST['order_id'];
  foreach ($idphanloaidh as $key => $value) {
    update_trangthai($madh,$value);
  }
  insert_chitietdh($hinhthuc,$sale,$date,$madh,$tongtien);
}
if (isset($_GET['thanhtoan'])) {
  $hinhthuc=$_GET['thanhtoan'];
  $tongtien=$_GET['amount'];
  $sale=$_GET['vocher'];
  $date=$_GET['date'];
  $madh=$_GET['order_id'];
  foreach ($idphanloaidh as $key => $value) {
    update_trangthai($madh,$value);
  }
  insert_chitietdh($hinhthuc,$sale,$date,$madh,$tongtien);
}
http://localhost:3000/DU_AN_1/user/view/index.php?act=dathang&vnp_Amount=400000000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14193964&vnp_CardType=ATM&vnp_OrderInfo=Thanh+to%C3%A1n+h%C3%B3a+%C4%91%C6%A1n%3A+20231123095501&vnp_PayDate=20231123095634&vnp_ResponseCode=00&vnp_TmnCode=UWG6PCZA&vnp_TransactionNo=14193964&vnp_TransactionStatus=00&vnp_TxnRef=20231123095501&vnp_SecureHash=cdd08e7c57f61068e9ff94f5b9d92e906d9b2004451dcb06198c3aab889143f22131667458811ab2dde92bf608f3140bfcc2e98235c61fa934a3bdc46930fad4
?>

</main>