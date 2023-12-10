
<?php 
if (isset($_GET['dangkytc'])) {?>
   <script>
Swal.fire({
  icon: "success",
  title: "Đang ký thành công",
  showConfirmButton: false,
  timer: 1500
});
      </script>
    <?php } ?>
<?php 
if (isset($_GET['dangnhaptc'])) {?>
   <script>
Swal.fire({
  icon: "success",
  title: "Đang nhập thành công",
  showConfirmButton: false,
  timer: 1500
});
      </script>
    <?php } ?>
<?php 
if (isset($_GET['dangnhaptb'])) {?>
 <script>
Swal.fire({
  title: "Đang nhập thất bại",
  text: "Vui lòng kiểm tra lại email và mật khẩu",
  icon: "error"
});
      </script>
    <?php } ?>
    <?php
if (isset($_GET['lock'])) {?>
 <script>
Swal.fire({
  title: "Đang nhập thất bại",
  text: "Tài khoản đã bị khóa !!!",
  icon: "error"
});
      </script>
    <?php } ?>

    <!-- ---------------------------------------------------------------- -->
    <!-- DANG NHAP=======================================================================---------------------------------------------------------------- -->
    <!-- ---------------------------------------------------------------- -->

    <!-- đang Xuất=======================================================================---------------------------------------------------------------- -->
    <?php
if (isset($_GET['dangxuattc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Đang xuất thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
  <!-- Đổi mật khẩu -->
    <?php
if (isset($_GET['doipasstc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Đổi mật khẩu thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
  <!-- Đổi thông tin -->
    <?php
if (isset($_GET['doitttc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Đổi thông tin thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<!--  Quên pass================ -->
<?php
if (isset($_GET['laylaipasstc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Mật khẩu đã được gửi về email của bạn !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['laylaipasstb'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Email không đúng !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['huydonhangtc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Đơn hàng đã được hủy thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['bltc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Bình luận thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['addgiotc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Sản phẩm đã được thêm vào giỏ hàng !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['addgiotb'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Thêm vào giỏ hàng thất bại vui lòng kiểm tra lại màu và size !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['thieutt'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Vui lòng nhập đủ thông tin đặt hàng !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['saisdt'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Vui lòng nhập đúng số điện thoại !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['chuadn'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Vui lòng đang nhập để thực hiện chức năng !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['guilhtc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Gửi liên hệ thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>
<?php
if (isset($_GET['dathangtc'])) {
  
  ?>
 <script>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Đặt hàng thành công !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>