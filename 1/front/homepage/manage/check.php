<?php
require("./global_manage.php");		//��������Դ
if($_POST["btn_tj"]!=""){
$id=$_POST[txt_id];
$title=$_POST[txt_title];
$price=$_POST[txt_price];
$picture=$_POST[txt_picture];
$content=$_POST[file];

$sql="insert into goods (id,title,price,picture,content) Values ('$id','$title','$price','$picture','$content')";
$DB->query($sql);
echo "<script>alert('HL��ʾ�������Ʒ����ɹ�!!!');</script>";
$url = './manage.php';
redirect_once($url);
}
?>
