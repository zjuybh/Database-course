<html><head><title>图书馆查询系统</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head><body>
	<a href = 'main.php'>返回主菜单</a> &nbsp;
	<h2 align='center' >图书查询</h2>
	<form action = "query 2.php" method="post">
	<table border='1' align='center'>
	<tr>
	<td>
		<select name="fieldname">
			<option value="category">类别</option>
			<option value="title">书名</option>
			<option value="press">出版社</option>
			<option value="author">作者</option>
			<option value="year">年份</option>
			<option value="price">价格</option>
		</select>
	</td>

	<td>
		<select name="cmpstr">
			<option value="=">相等</option>
			<option value="<>">不相等</option>
			<option value="ks">以此开始</option>
			<option value="js">以此结束</option>
			<option value="bh">含有此字符</option>
		</select>
	</td>

	<td>
		<input type="text" size="30" maxlength="60" name="cmpval">
	</td>

	<td>
		<select name="order">
			<option value="title">按书名排序</option>
			<option value="category">按类别排序</option>
			<option value="press">按出版社排序</option>
			<option value="year">按年份排序</option>
			<option value="price">按价格排序</option>
		</select>
	</td>

	</tr>

	<tr>
		<td colspan="4" style="text-align: center;">
			<input type="submit" value="开始查询">
		</td>
	</tr>

	</table>
	</form>
	</body>
	</html>