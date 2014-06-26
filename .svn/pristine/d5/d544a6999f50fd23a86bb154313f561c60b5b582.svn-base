<?php
require_once("./common/db_mysql.class.php");
$id=$_GET[id];
$DB = new DB_MySQL;
$sql = "select * from goods where  id='".$id."'";
$info = $DB->fetch_one_array($sql);
?>
