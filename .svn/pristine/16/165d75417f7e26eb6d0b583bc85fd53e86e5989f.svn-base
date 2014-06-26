<?php
//返回$error = 0 初始化
//返回$error = 1 未接受到$_POST
//返回$error = 2 未输入用户名或密码
//返回$error = 3	用户名密码不匹配
//返回$error = 4 用户名不存在或用户名在数据库中不止1个
require_once('./functions/conn.php');
require_once('./functions/checkLogin.php');
require_once('./functions/db_query.php');
session_start();
$test = con();
$error = 0;
$table = "users";
header("Content-Type:text/xml;charset=utf-8");
if(empty($_POST))
{
	echo "<error>接收登录信息出错。</error>";
}
elseif($_POST['log_uname']==''||$_POST['log_upwd']=='')
{
	echo "<error>用户名或密码为空。</error>";
}
else
{
//	echo "33";
	
	$logName = $_POST['log_uname'];
	$logpwd = $_POST['log_upwd'];
//	echo "<root><uname>黄小草</uname><sex>$logpwd</sex></root>";
	$query_column = "upwd";
//	$query = "select $query_column from users where uname=\"$logName\"";
	$query_station = "uname = \"$logName\"";
	$query = db_query($query_column, $query_station, $table);
	$result = mysql_query($query);
	$result_count = mysql_num_rows($result);
//	echo "</br>";
//	echo $result_count;
	if($result_count==1)
	{
		$query_pwd=mysql_result($result,0);
		if($query_pwd==$_POST['log_upwd'])
		{
			$_SESSION['uname']=$logName;
			$_SESSION['log']=true;
			$query_column = "*";
			$query = db_query($query_column, $query_station, $table);
			$temp_result = mysql_query($query);
			$user_inf = mysql_fetch_assoc($temp_result);
			$xml = "<root>";
			for($i=0;$i<count($user_inf);$i++)
			{
				$xml_name = key($user_inf);
				$xml_value = current($user_inf);
				if($xml_name!="upwd")
				{
					$xml .= "<$xml_name>".$xml_value."</$xml_name>";
					$_SESSION["$xml_name"] = $xml_value;
				}
				next($user_inf);
			}
			$xml .= "</root>";
			echo $xml;
/*			$url = "localhost/cqushop/1/登陆注册/HTMLPage1.htm" ;//dest_url
			$header[] = "Content-type: text/xml";//定义content-type为xml
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			$response = curl_exec($ch);
			if(curl_errno($ch))
			{
				print curl_error($ch);
			}
			curl_close($ch);*/
		}
		else
		{
			echo "密码不正确";
		}
	}
	else
	{
		echo "用户不存在";
	}
}
?>
