<?php
/*
 * 节点<error></error>返回错误。
 * 0为添加成功
 * 1为未收到$_POST
 * 2为添加到购物车失败
 * 3为_SESSION['login']未设定或未登陆
 */
require_once './functions/conn.php';
require_once './functions/checkLogin.php';
require_once './class/shopCart_class.php';

session_start();
if(!isset($_SESSION['log'])||$_SESSION['log']!=true)
	echo "请先登陆";
else
{
	$go = con();
	if(!isset($_POST))
		echo "数据传输出错";
	elseif($_POST['action']==0)//添加到购物车
	{
		/*$table = "shopCart";
		$gname = $_POST['gname'];
		$uname = $_POST['uname'];
		$gcount = $_POST['gcount'];
		$date = date('Y-m-d');
		$query_station = "good_name = \"$gname\"";
		$query_select = "*";
		$query = db_query($query_select, $query_station, $table);
		$q = mysql_query($query);
		if($q == false)
		{
			$query = "insert into $table set user_name=\"$uname\",good_name=\"$gname\",good_count=$gcount,add_date=\"$date\"";
			$q = mysql_query($query);
		}
		else
		{
			$query = "update $table set good_count=$gcount where user_name=\"$uname\" and good_name=\"$gname\"";
			$q = mysql_query($query);
		}
		if($q == false)
			echo "<error>2</error>";
		else 
			echo "<error>0</error>";*/
		$shop_cast = new Cart();
//		$_SESSION['uname'] = "大仙";
		$shop_cast->cast_name = $_SESSION['uname'];
		$good_id = $_POST['good_id'];
//		$good_id = 1;
		$good_count = $_POST['good_count'];
//		$good_count = 5;
//		$_SESSION["$shop_cast->cast_name"]["1"]['imgsrc'] = "yes";
//		$_SESSION["$shop_cast->cast_name"]["1"]['good_name'] = "ball";
//		$_SESSION["$shop_cast->cast_name"]["1"]['price'] = 20;
		if($shop_cast->addGoods($good_id,$good_count))
			echo "成功添加到购物车";
		else 
			echo "添加到购物车失败，请重试";
	}
	elseif($_POST['action']==1)//查询购物车
	{
		header("Content-Type:text/xml;charset=utf-8");
		/*$table = "shopCart";
		$uname = $_POST['uname'];
		$query_station = "user_name = \"$uname\"";
		$query_select = "*";
		$query = db_query($query_select, $query_station, $table);
		$q = mysql_query($query);
		if(!$q)
		{
			echo "<error>3</error>";
		}
		else
		{
			$num = mysql_num_rows($q);
			$xml = "<root>";
			$xml.= "<number>".$num."</number>";
			$xml.= "<goods>";
			for($i=0; $i<$num; $i++)
			{
				$goods_inf = mysql_fetch_assoc($q);
				$xml_name = key($goods_inf);
				$xml_value = current($goods_inf);
				$table = "goods";
				$query_select = "*";
				$query_station = "title = \"$xml_name\"";
				next($goods_inf);
			}
			$xml.= "</goods>";
			$xml.= "</root>";
			echo $xml;
		}*/
		$shop_cast = new Cart();
//		$_SESSION['uname'] = "大仙";
		$shop_cast->cast_name = $_SESSION['uname'];
		if(!$shop_cast->get())
			echo "<error>5</error>";
		else 
		{
			$number = $_SESSION["$shop_cast->cast_name"]['number'];
			$totalMoney = $_SESSION["$shop_cast->cast_name"]['totalMoney'];
			$xml = "<xml>";
			$xml .= "<number>".$number."</number>";
			for($i=0; $i<$number; $i++)
			{
				$good_id =$_SESSION["$shop_cast->cast_name"]['id_list'][$i];
				$good_name = $_SESSION["$shop_cast->cast_name"]["$good_id"]['good_name'];
				$good_count = $_SESSION["$shop_cast->cast_name"]["$good_id"]['good_count'];
				$imgsrc = $_SESSION["$shop_cast->cast_name"]["$good_id"]['imgsrc'];
				$price = $_SESSION["$shop_cast->cast_name"]["$good_id"]['price'];
				$good_price = $_SESSION["$shop_cast->cast_name"]["$good_id"]['good_price'];
				$temp_number = $i+1;
				$xml .= "<item".$temp_number.">";
				$xml .= "<imgsrc>".$imgsrc."</imgsrc>";
				$xml .= "<itemName>".$good_name."</itemName>";
				$xml .= "<price>".$price."</price>";
				$xml .= "<itemNumber>".$good_count."</itemNumber>";
				$xml .= "<itemTotal>".$good_price."</itemTotal>";
				$xml .= "</item".$temp_number.">";
			}
			$xml .= "<totalMoney>".$totalMoney."</totalMoney>";
			$xml .= "</xml>";
			echo $xml;
		}
	}
}
?>