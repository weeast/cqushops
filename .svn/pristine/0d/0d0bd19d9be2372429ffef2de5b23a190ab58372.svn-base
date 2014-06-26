<?php
require("./global_manage.php");

$sql="select * from goods order by id desc";
if($_GET){

$page_num = $_GET['page_num']? $_GET['page_num']: 1;
}
else{

$page_num = 1;
}

$DB->query($sql);
$row_count_sum = $DB->get_rows();

$row_per_page = 10;

$page_count = ceil($row_count_sum/$row_per_page);

$is_first = (1 == $page_num) ? 1 : 0;
$is_last = ($page_num == $page_count) ? 1 : 0;

$start_row = ($page_num-1) * $row_per_page;

$sql .= " limit $start_row,$row_per_page";

$DB->query($sql);
$res = $DB->get_rows_array();

$rows_count=count($res);
?>

<html>
<head>
<title>删除商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=gb2312">

</head>
<body>
<table width="950" border="0" align="center" cellpadding="0"
	cellspacing="0">
	<tr>
		<td colspan="3"></td>
	</tr>
	<tr>
		<td width="190" valign="top" bgcolor="#EEEEEE"><?php include("left.php");?></td>
		<td width="757" valign="top" bgcolor="#FFFFFF">
		<table width="757" cellpadding="0" cellspacing="0" border="0"
			bgcolor="#ffffff">
			<tr align="left">
				<td class="border">
				<table width="100%" align="center" border="0" cellspacing="0"
					cellpadding="0">
					<tr height="24">
						<td height="59">&nbsp;</td>
					</tr>
				</table>
				<table width="757" border="0" align="center" cellpadding="0"
					cellspacing="0" class="tb1">
					<form action="./del.php" method="post" name="note" id="note">
					<tr align="left">
						<td class="border"></td>
					</tr>
					<tr class='style1'>
						<td width='45' height="26" align="center" bgcolor="D9EBB9">选择</td>
						<td width='335' align="center" bgcolor="D9EBB9">商品名称</td>
						<td width='198' align="center" bgcolor="D9EBB9">商品id</td>

					</tr>
					<?php
					$col1 = "#ffffff";			//设置记录行背景颜色为白色
					$col2 = "#f0f0f0";			//设置记录行背景颜色为灰色
					$col = $col2;

					for($i=0;$i<$rows_count;$i++){
					//记录行背景色交替
					if($col == $col1)
					$col = $col2;
					else
					$col = $col1;

					$title=$res[$i]['title'];	//标题
					$content=$res[$i]['content'];
					$picture=$res[$i]['picture'];
					$id = $res[$i]['id'];

					?>
					<tr valign="middle" bgcolor="<?php echo $col;?>" height="24">
						<td align="center"><input type="checkbox" name="file_id[]"
							value="<?php echo $id;?>" /></td>
						<td><?php echo $content;?></td>

						<td align="center"><?php echo $id;?></td>
					</tr>

					<?php
					}
					if($rows_count==0){
					?> <?php
					}
					?>

					<tr align="right" bgcolor="#F0F0F0" valign="middle">
						<td height="28" colspan="2" align="left" bgcolor="F8F7EB">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="select_all"
							onClick="check_all(this.form)" /> <span class="style1">全选</span>&nbsp;&nbsp;
						&nbsp;&nbsp; <input name="submit" type="submit" value=" 删除 "
							class="btn1" /></td>
						<td colspan="3" align="right" bgcolor="F8F7EB">共[<strong><?php echo $rows_count;?></strong>]件&nbsp;每页显示[<strong><?php echo $row_per_page;?></strong>]件&nbsp;
						<!--  分页显示控制链接 --> <?php
						if(!$is_first){
						?> <a href="./manage.php?page_num=1"> 第一页</a> <a
							href="./manage.php?page_num=	<?php echo ($page_num-1) ?>">上一页</a>
							<?php
						}
						else{
						?> 第一页&nbsp;上一页 <?php
						}
						if(!$is_last){
						?> <a href="./manage.php?page_num=<?php echo ($page_num+1) ?>">下一页</a>
						<a href="./manage.php?page_num=<?php echo $page_count ?>">最后一页</a>
						<?php
						}
						else{
						?> 下一页&nbsp;&nbsp;最后一页 <?php
						}
						?></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="4" height="5"></td>
					</tr>
					</form>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="3"></td>
	</tr>
</table>