<?php
function vocher_where_user($user){
    $sql="SELECT vocher.id,vocher.sale
    FROM vocher
    JOIN taikhoan ON taikhoan.id = vocher.iduser
    WHERE taikhoan.email = '$user';";
    $vocher_where_user=pdo_query($sql);
    return $vocher_where_user;
}
?>
