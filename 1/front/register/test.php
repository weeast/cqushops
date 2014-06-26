<?php
$con = mysql_connect ("w.rdc.sae.sina.com.cn:3307", "10nmklklny", "m42mhm2zmh0xlmzm5kkikw2wizhi314wh1jy2xy2");
if($con)
{
echo "ddd";
$db_selected = mysql_select_db("app_cqushop",$con);
		if(!$db_selected)
                {
                  echo "2222";
                }
                else
                {
                  echo "333";
                }
  $doo = "insert into users set uname=\"ddd\",email=\"email@dd.com\",ID_card=\"123456789012345678\",upwd=\"11111111\",pwd_question=\"pwd_question\",pwd_answer=\"pwd_answer\",sex=\"sex\",rname=\"$rname\",phoneNum=\"11111111112\",address=\"\",postcode=\"402260\",rsdate=\"1900-1-1\"";
  $do = mysql_query($doo);
  if($do)
  echo "yes";
  else
  echo "no";
}
else
echo "sss";
?>