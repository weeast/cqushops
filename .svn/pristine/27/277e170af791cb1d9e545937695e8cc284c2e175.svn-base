<?php 
//是否全为字母与数字
function check_al_num($string)
{
  if(!preg_match("/(^[0-9a-zA-Z]{8,16}$)/",$string))
	{
//		$show =  "您的 $alarm 不正确。";
//		echo "<script>alert(\"$show\");</script>";
		return false;
	}
	else
		return true;
}
//判断ID_card是否合法（前17位为数字，最后一位为数字或者X）
function check_num($string)
{
  if(!preg_match("/^(([0-9]{17})([0-9xX]{1}))$/",$string))
	{
		return false;
	}
	else
		return true;
}
function check_phoneNum($phoneNum)
{
  if(!preg_match("/^([0-9]+)$/",$phoneNum))
	{
		return false;
	}
	else
		return true;
}
//email地址是否合法
function check_email($string)
{
  if(!preg_match("/([a-zA-Z0-9]+)@([a-zA-Z0-9]+)\.([a-zA-Z0-9]+)/",$string))
	{
		return false;
	}
	else
		return true;
}
function check_unique($string,$value)
{
	$query = "select * from users where $string=$value";
	$result=mysql_query($query);
	$dd=mysql_num_rows($result);
	if(mysql_num_rows($result)>=1)
	{
		return $string;
	}
        else
        {
        return "";
        }
}
function check_all_unique($array,$array2)
{
	$output="<legal>true</legal>";
	$outputText = "";
	reset($array);
	$legal = true;
	for($i=0;$i<count($array);$i++)
	{
		$temp = key($array);
		$temp2 = current($array);
		$result = check_unique("$temp", "\"$temp2\"");
		if($result!="")
		{
			$legal = false;
			$output = "<legal>false</legal>";
			$outputText .= $array2[$result].",";
		}
		next($array);
	}
	if($legal == false)
	{
		$outputText .="已经存在。";
		$output .= "<error>".$outputText."</error>";
		
		return $output;
		//echo "<script>alert(\"$output\");</script>";
	}
//	else
//		echo "注册合法";
	
}
/*$con = mysql_connect("localhost", "root", "52113344");
 $db_selected = mysql_select_db("ezbuying",$con);
$email = "owlfeather@163.com";
$array["uname"]="35";
$array["ID_card"]="441";
$array2["uname"]="用户名";
$array2["ID_card"]="身份证";
check_all_unique($array, $array2);*/
?>
