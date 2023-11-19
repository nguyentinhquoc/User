<main class="dathang">

  <div class="top">
    <h4 style="color: red;"><i class="fa fa-map-marker" aria-hidden="true"></i>
      Địa chỉ nhận hàng
    </h4>
    Họ và tên: Nguyễn Quốc Tình<br>
    Số điện thoại: 0366904133<br>
    Địa chỉ nhận hàng: Yên LÂm-Yên Mô-Ninh Bình<br>
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
        <tr>
          <td><img src="assets/images/sanpham/nike (4).jpeg" alt="" width="100px"></td>
          <td> Nike Waffle Racer </td>
          <td>Xanh,XL</td>
          <td>2000000</td>
          <td>2</td>
          <td>4000000</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="vocher">
    <i class="fa fa-ticket" aria-hidden="true"></i>
    <p>PANDA SHOP Vocher </p>
    <input style="margin-left: 900px;" type="text" placeholder="Nhập mã vocher">
    <input type="submit" name="vocher" id="">
  </div>
  <div class="thanhtoan">
    <div class="top">
      <p>PHƯƠNG THỨC THANH TOÁN:</p>
      <div class="radio_thanhtoan">
        <input type="radio" class="btn-check" name="options-base" id="option5" autocomplete="off" onclick="thanhtoan_text(2)" >
        <label class="btn" for="option5">Thanh toán khi nhận hàng</label>
        <input type="radio" class="btn-check" name="options-base" id="option6" autocomplete="off" onclick="thanhtoan_text(1)">
        <label class="btn" for="option6">Thanh toán online</label>
      </div>
    </div>
    <div id="thanhtoan_text"></div>
    <script>
      function thanhtoan_text(number) {
     
        if (number == 1) {
          document.getElementById("thanhtoan_text").innerHTML = `
              <form action="" method="POST">
              <div class="tongtienhang"><p>Tổng tiền hàng : </p></div>
    <div class="tongtienhang"><p>Giảm giá : </p></div>
    <div class="tongtienhang"><p>Tổng thanh toán : </p></div>
              <input type="hidden" name="order_id" value="madonsshang">
              <input type="hidden" name="order_desc" value="noiddsung">
              <input type="hidden" name="order_type" value="tenhdsang">
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

              <input type="hidden" name="amount" value="1548795">
              <input type="submit" name="redirect" value="Thanh toán">
              </form>
            `;
        } else if (number == 2) {
          document.getElementById("thanhtoan_text").innerHTML = `
          <div class="thongtin_dathang">
    <div class="tongtienhang"><p>Tổng tiền hàng : </p></div>
    <div class="tongtienhang"><p>Giảm giá : </p></div>
    <div class="tongtienhang"><p>Tổng thanh toán : </p></div>
    <div class="tongtienhang"><input type="submit" value="Đặt hàng" name="" id=""></div>
  </div>
            `;
        }
      }
    </script>
  </div>

  <?php
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
  $vnp_Returnurl = "http://localhost:3000/DU_AN_1/user/view/index.php?dathangtc";
  $vnp_TmnCode = "UWG6PCZA";
  $vnp_HashSecret = "LUNHEZKVDQOHGREXBRTBHVXQTATQKQOO";
  if (isset($_POST['redirect'])) {
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
  if (isset($_POST['redirect'])) {
    header('Location: ' . $vnp_Url);
    die();
  } else {
  }
  ?>
  






</main>