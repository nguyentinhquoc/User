
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
  title: 'Tạm biệt quý khách !!!',
  showConfirmButton: false,
  timer: 1500
})
      </script>
      
    <?php 
  } ?>

