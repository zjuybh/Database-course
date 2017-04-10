<html><head><title>图书单本入库</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head><body>
	<a href = 'main.php'>返回主菜单</a> &nbsp;
	<h2 align='center' >图书单本入库</h2>
	<form action = "" method="post">
	<table align="center">
	<tr><td>书号</td>
	<td><input type="text" name="bno"></td></tr>

	<tr><td>类别</td>
	<td><input type="text" name="category"></td></tr>

	<tr><td>题目</td>
	<td><input type="text" name="title"></td></tr>

	<tr><td>出版社</td>
	<td><input type="text" name="press"></td></tr>

	<tr><td>年份</td>
	<td><input type="text" onkeyup="if(!/^\d+$/.test(this.value)) {alert('只能输入数字 !'); this.value=this.value.replace(/[^\d]+/g,'');}" name="year"></td></tr>

	<tr><td>作者</td>
	<td><input type="text" name="author"></td></tr>

	<tr><td>价格</td>
	<td><input type="text" name="price" runat="server" class="easyui-numberbox" precision="2" />  </td></tr>

	<tr><td>总藏书量</td>
	<td><input type="text" onkeyup="if(!/^\d+$/.test(this.value)) {alert('只能输入数字 !'); this.value=this.value.replace(/[^\d]+/g,'');}" name="total"></td></tr>

	<tr><td>库存</td>
	<td><input type="text" onkeyup="if(!/^\d+$/.test(this.value)) {alert('只能输入数字 !'); this.value=this.value.replace(/[^\d]+/g,'');}" name="stock"></td></tr>

	<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="提交"></td></tr>

	</table>
</form>
</body>
</html>

<?php
	include "conncet.php";
	if(isset($_POST['Submit'])){
		$bno = $_POST['bno'];
		$category = $_POST['category'];
		$title = $_POST['title'];
		$press = $_POST['press'];
		$year = (int)$_POST['year'];
		$author = $_POST['author'];
		$price = (float)$_POST['price'];
		$total = (int)$_POST['total'];
		$stock = (int)$_POST['stock'];

		// echo "$bno, $category, $title, $press, $year, $author, $price, $total, $stock, <br>";
		$stmt = "SELECT * FROM book WHERE bno = '$bno'";
		// echo "$stmt, <br>";
		$query = sqlsrv_query($conn, $stmt);
		$has_rows = sqlsrv_has_rows($query);
		if($has_rows){
			echo "<script>alert('该书目已存在！');</script>";
		}
		else{
			if($year == 0){
				echo "<script>alert('年份必须是整数且不能为0！');</script>";
			}
			else if($bno == ""){
				echo "<script>alert('书号不能为空！');</script>";
			}
			else if ($price == 0){
					echo "<script>alert('价格必须是整数或者浮点数且不能为0！');</script>";
			}
			else if($total == 0){
				echo "<script>alert('总藏书量必须是整数且不能为0！');</script>";
			}
			else if($stock == 0){
				echo "<script>alert('库存必须是整数且不能为0！');</script>";
			}
			else{
				$stmt2 = "INSERT INTO book VALUES('$bno','$category','$title','$press',$year,'$author',$price, $total, $stock)";
				// echo "$stmt2, <br>";
				$stmt2 = iconv('utf-8', 'GB2312', $stmt2);
				if(sqlsrv_query($conn, $stmt2)){
					echo "<script>alert('入库成功！');</script>";
				}
				else{
					echo "<script>alert('入库失败！');</script>";
					die (print_r(sqlsrv_errors(), true));
				}
			}
		}
		
	}

	
?>
