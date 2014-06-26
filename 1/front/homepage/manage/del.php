<?php
require("./global_manage.php");
if($_POST){
//获取传递来的id及查询条件
$id = $_POST['file_id'];
$a = "";
$sql = "delete from goods";
if(count($id)>1){	//当选择多个商品时
while(list($name,$value)=each($id)){			//遍历数组
$a.="$value".",";
}
$a= substr($a,0,-1);
//使用in关键字删除所有被选择商品
$sql .= " where id in(".$a.")";
}
//只删除一件商品
else
$sql .= " where id = ".$id[0];
$DB->query($sql);
?>
<script language="javascript">alert("商品删除成功！");</script>
<?php
//将原来的查询条件返回
$url = "./manage.php";
redirect_once($url);
}
?>
<meta
	http-equiv="Content-Type" content="text/html;charset=gb2312">
