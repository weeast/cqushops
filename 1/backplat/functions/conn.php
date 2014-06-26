<?php
function con()
{
  //SAE_MYSQL_USER
  //SAE_MYSQL_PASS
  //SAE_MYSQL_DB
	$con = mysql_connect ("w.rdc.sae.sina.com.cn:3307", "10nmklklny", "m42mhm2zmh0xlmzm5kkikw2wizhi314wh1jy2xy2");
	$return = "";
	if(!$con)
	{
		$return = "<error>数据库服务器链接失败。</error>";
	}
	else
	{
		$db_selected = mysql_select_db("app_cqushop",$con);
		if(!$db_selected)
		{
			$return =  "<error>数据库链接失败。</error>";
		}
		else
		mysql_query("set names utf8");
	}
	
//	echo "ok,数据库链接成功。";
	return $return;
}
?>
