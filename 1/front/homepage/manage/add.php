
<title>添加商品</title>
<table width="950" border="0" align="center" cellpadding="0"
	cellspacing="0">
	<tr>
		<td colspan="3"></td>
	</tr>
	<tr>
		<td width="190" valign="top" bgcolor="#f0f0f0"><?php include("left.php");?></td>
		<td width="3">&nbsp;</td>
		<td width="757" align="center" valign="top" bgcolor="#FFFFFF">
		<table width="700" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="613" height="223" align="center"><br />
				<table width="700" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
						<form action="check.php" method="post" name="myform" id="myform">
						<table width="680" border="1" cellpadding="3" cellspacing="1"
							bordercolor="#D9EBB9">

							<tr>
								<td valign="middle" align="right" width="14%">商品id：<br />
								</td>
								<td width="86%"><input name="txt_id" type="text" id="txt_id"
									size="85" /></td>
							</tr>

							<tr>
								<td valign="middle" align="right" width="14%">商品标题：<br />
								</td>
								<td width="86%"><input name="txt_title" type="text"
									id="txt_title" size="85" /></td>
							</tr>

							<tr>
								<td valign="middle" align="right" width="14%">商品价格：<br />
								</td>
								<td width="86%"><input name="txt_price" type="text"
									id="txt_price" size="85" /></td>
							</tr>

							<tr>
								<td valign="middle" align="right" width="14%">图片地址：<br />
								</td>
								<td width="86%"><input name="txt_picture" type="text"
									id="txt_picture" size="85" /></td>
							</tr>

							<tr>
								<td width="14%" align="right" valign="middle">商品内容：</td>
								<td width="86%">
								<div class="file"><textarea name="file" rows="20" id="file"
									style="border: 1px; width: 580px;"></textarea></div>
								</td>
							</tr>

							<tr align="center">
								<td height="40" colspan="2"><input name="btn_tj" type="submit"
									class="btn1" id="btn_tj" onclick="return check(myform);"
									value="添加商品" /></td>
							</tr>
						</table>
						</form>
						</td>
					</tr>
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
