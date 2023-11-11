<?php
function danhmuc_all(){
$sql="SELECT * FROM danhmuc";
$danhmuc_all=pdo_query($sql);
return $danhmuc_all;
}
?>