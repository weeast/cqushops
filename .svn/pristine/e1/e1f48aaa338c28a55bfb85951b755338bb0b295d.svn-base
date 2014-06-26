<?php
require("./global_manage.php");		//连接数据源
if($_POST["btn_tj"]!=""){
$id=$_POST[txt_id];
$title=$_POST[txt_title];
$price=$_POST[txt_price];
$picture=$_POST[txt_picture];
$content=$_POST[file];

$sql="insert into goods (id,title,price,picture,content) Values ('$id','$title','$price','$picture','$content')";
$DB->query($sql);
echo "<script>alert('HL提示你你的商品加入成功!!!');</script>";
$url = './manage.php';
redirect_once($url);
}
?>
