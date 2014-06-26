<?php
require_once './functions/conn.php';
require_once './functions/db_query.php';
session_start();
header("Content-Type:text/xml;charset=utf-8");
$log = true;
$success = true;
if(!isset($_POST['action']))
{
	$success = false;
	exit(1);
}
elseif(!isset($_SESSION['log'])||!$_SESSION['log'])
{
	$log = false;
	$_SESSION['temp']['uname'] = 'passenger';
}
$good_id = $_POST['good_id'];
$connect = con();
$dd = 'ccc';
if($connect!='')
{
	$success = false; //数据库链接失败
	exit(1);
}
if($_POST['action']=='send')
{
	$table = 'goods';
	$query_station = "id=$good_id";
	$query_column = "*";
	$query = db_query($query_column, $query_station, $table);
	$q = mysql_query($query);
	if(mysql_num_rows($q)!=1)
	{
		$success = false;
		exit(1);
	}
	$temp = mysql_fetch_assoc($q);
	$_SESSION['temp']['good']['good_id'] = $good_id;
	$_SESSION['temp']['good']['good_price'] = $temp['price'];
	$_SESSION['temp']['good']['good_name'] = $temp['content'];
	$_SESSION['temp']['good']['good_imgsrc'] = $temp['picture'];
	$success = true;
}

elseif($_POST['action']=='get')
{
	if(!$success)
	{
		echo "<state>0</state>";
		exit(1);
	}
	else
	{
		$good_id = $_SESSION['temp']['good']['good_id'];
		$good_name = $_SESSION['temp']['good']['good_name'];
		$good_price = $_SESSION['temp']['good']['good_price'];
		$good_imgsrc = $_SESSION['temp']['good']['good_imgsrc'];
		
		$xml = "<xml><state>1</state>";
		$xml .= "<good_id>".$good_id."</good_id>";
		$xml .= "<good_name>".$good_name."</good_name>";
		$xml .= "<good_price>".$good_price."</good_price>";
		$xml .= "<good_imgsrc>".$good_imgsrc."</good_imgsrc>";
		$xml .= "</xml>";
		echo $xml;
		exit(1);
	}
}
else 
{
	
	echo "<state>0</state>";
	exit(1);
	
}

?>
	