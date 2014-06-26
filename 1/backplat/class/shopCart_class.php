<?php
require_once './functions/conn.php';
require_once './functions/checkLogin.php';
require_once './functions/db_query.php';
//header("Content-Type:text/xml;charset=utf-8");
session_start();

class Cart
{
	var $cast_name;
/*	public function _construct($goods, $user_name, $id)
	{
		$this->items = $goods;
		$this->user = $user_name;
		$query_column = "cart_id";
		$query_station = "user_name = \"$user_name\"";
		$table = "shopCart";
		$q = db_query($query_column,$query_station, $table);
		if($q == false)
		{
			$insert = "insert into $table set username=\"$user_name\"";
			$t = mysql_query($insert);
		}
		$this->id = mysql_result($q,0);
		$_SESSION[$user_name]=$this;
		$this->_updata();
	}*/
	public function findTable()
	{
		$result=mysql_list_tables('ezbuying');
		$i=0;
		while($i<mysql_num_rows($result))
		{
			if($this->cast_name==mysql_tablename($result,$i))
			{
				return true;
			}
			$i++;
		}
		return false;
	}
	public function addGoods($good_id,$good_count)
	{
		$_SESSION["$this->cast_name"]["$good_id"]['good_id'] = $good_id;
		$_SESSION["$this->cast_name"]["$good_id"]['good_count'] = $good_count;
		$query = "select * from goods where id=$good_id";
		$q = mysql_query($query);
		if(!$q)
			return false;
		else 
		{
			$temp = mysql_fetch_assoc($q);
			$_SESSION["$this->cast_name"]["$good_id"]['price'] = $temp['price'];
			$_SESSION["$this->cast_name"]["$good_id"]['imgsrc'] = $temp['picture'];
			$_SESSION["$this->cast_name"]["$good_id"]['good_name'] = $temp['content'];
			if($this->_updata())
				return true;
			else
			{
				return false;
			}
		}
	}
	public function delGoods($good_id,$good_count)
	{
		$_SESSION["$this->cast_name"]["$good_id"]['good_count'] = 0;
		if($this->_updata())
			return true;
		else
			return false;
	}
	public function _updata()
	{
		$table = $this->cast_name;
		if(!$this->findTable())
			$this->create_table();
		reset($_SESSION["$this->cast_name"]);
		for($i=0; $i<count($_SESSION["$this->cast_name"]); $i++)
		{
//			echo count($_SESSION["$this->cast_name"]);
//			echo "</br>";
//			echo $_SESSION["$this->cast_name"][1]['price'];
//			echo $this->cast_name;
			$user_name = $_SESSION['uname'];
			$gid = key($_SESSION["$this->cast_name"]);
			echo $gid;
//			$gvalue = current($_SESSION["$this->cast_name"]["$gid"]);
			if($gid!="number" && $gid!="totalMoney" &&$gid!='id_list')
			{
//				echo "gid=$gid";
				$query_station = "good_id = $gid";
				$query_column = "*";
				$temp_r = db_query($query_column, $query_station, $table);
				$r = mysql_query($temp_r);
				$result_num = mysql_num_rows($r);
//				echo "result_num=$result_num";
				$good_id = $_SESSION["$this->cast_name"]["$gid"]["good_id"];
//				echo "good_id=$good_id";
				$good_count = $_SESSION["$this->cast_name"]["$gid"]['good_count'];
				$imgsrc = $_SESSION["$this->cast_name"]["$gid"]['imgsrc'];
				$good_name = $_SESSION["$this->cast_name"]["$gid"]['good_name'];
				$price = $_SESSION["$this->cast_name"]["$gid"]['price'];
				if($result_num==0)
				{
					$query = "insert into $table set good_id=$good_id,good_count=$good_count,price=$price,good_name=\"$good_name\",imgsrc=\"$imgsrc\"";
					$q=mysql_query($query);
					if(!$q)
					{
					//	echo "$query";
						return false;
					}
					else
						return true;
				}
				else 
				{
					$good_inf = mysql_fetch_assoc($r);
					$test = count($good_inf);
					//reset($good_inf);
					for($j=0; $j<count($good_inf); $j++)
					{
						$g_column = key($good_inf);
						$g_value = $_SESSION["$this->cast_name"]["$gid"]["$g_column"];
//						if($g_column != "good_id" && $g_column != "good_name")
//						{
							/*if($g_column == "price" || $g_column =="good_count")
								$insert = "insert into $table set $g_column=$g_value";
							else
								$insert = "insert into $table set $g_column=\"$g_value\"";*/
							$query = "update $table set good_count=$good_count,price=$price,imgsrc=\"$imgsrc\" where good_id=$gid";
//							echo $query;
							$r = mysql_query($query);
							if(!$r)
							{
								return false;
							}
//						}
						next($good_inf);
					}
				}
			}
			next($_SESSION["$this->cast_name"]);
		}
		return true;
	}
	public function get()
	{
		$table = $this->cast_name;
		$query = "select * from $table";
		$result = mysql_query($query);
		if(!$result)
		{
			return false;
		}
		else 
		{
			$total_price = 0;
			for($i=0; $i<mysql_num_rows($result); $i++)
			{
				$temp = mysql_fetch_assoc($result);
				$good_id = $temp['good_id'];
				$_SESSION["$this->cast_name"]['id_list'][$i] = $good_id;
				$_SESSION["$this->cast_name"]["$good_id"]['good_count'] = $temp['good_count'];
				$_SESSION["$this->cast_name"]["$good_id"]['imgsrc'] = $temp['imgsrc'];
				$_SESSION["$this->cast_name"]["$good_id"]['good_name'] = $temp['good_name'];
				$_SESSION["$this->cast_name"]["$good_id"]['price'] = $temp['price'];
				$_SESSION["$this->cast_name"]["$good_id"]['good_price'] = $temp['price']*$temp['good_count'];
				$total_price += $_SESSION["$this->cast_name"]["$good_id"]['good_price'];
			}
			$_SESSION["$this->cast_name"]["number"] = mysql_num_rows($result);
			$_SESSION["$this->cast_name"]["totalMoney"] = $total_price;
			return true;
		}
	}
	public function create_table()
	{
		$table = "$this->cast_name";
		$query = "create table $table (good_id int(10) not null unique,imgsrc varchar(200) not null,good_name varchar(50) not null,price int(11) not null,good_count int(10) not null default 1,index(imgsrc));";
		$q = mysql_query($query);
		if($q)
		{
			$table = "shopCart";
			$date = date('y-m-d');
			$c_name = $this->cast_name;
			$uname = $_SESSION['uname'];
			$uid = $_SESSION['uid'];
			$query = "insert into $table set user_name=\"$uname\",user_id=$uid,cast_name=\"$c_name\",
				add_date=\"$date\"";
			$q = mysql_query($query);
			if(!$q)
				return false;
			else
				return true;
		}
		else 
		{
			return false;
		}
	}
	public function clear_table()
	{
		$table = $this->cast_name;
		$query = "drop table $table";
		$q = mysql_query($query);
		if($q)
		{
			$table = "shopCart";
			$c_name = $this->cast_name;
			$query = "delete from $table where cast_name=\"$c_name\"";
			$q = mysql_query($query);
			if(!$q)
				return false;
			else 
				return true;
		}
		else
			return false;
	}
}