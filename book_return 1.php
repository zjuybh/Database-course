<html><head><title>图书归还</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head><body>
	<a href = 'main.php'>返回主菜单</a> &nbsp;
	<h2 align='center' >图书归还</h2>
	<form action = "" method="post">
	<table align="center">
	<tr><td>借书证号</td>
	<td><input type="text" name="cno"></td></tr>
	<tr><td>书号</td>
	<td><input type="text" name="bno"></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="提交"></td></tr>

	</table>
</form>
</body>
</html>

<?php
	include "conncet.php";
	if(isset($_POST['Submit'])){
		$cno = $_POST['cno'];
		$bno = $_POST['bno'];
		// echo "$cno, $bno, <br>";

	$stmt = "SELECT * FROM card WHERE cno = '$cno'";
		// echo "$stmt, <br>";
	$result = sqlsrv_query($conn, $stmt);

	$stmt2 = "SELECT * FROM borrow WHERE bno = '$bno' AND cno = '$cno' ";
		// echo "$stmt2, <br>";
		$result2 = sqlsrv_query($conn, $stmt2);

		if($row = sqlsrv_fetch_array($result)){
			if($row2 = sqlsrv_fetch_array($result2)){
				session_start();
				$_SESSION['cno'] = $cno;
				$_SESSION['bno'] = $bno;
				header("location: http://localhost:8080/lib%20manage/book_return%202.php");
			}
			else{
				echo "<script>alert('您并未借出该书目！');</script>";
			}
		}
		else{
			echo "<script>alert('借书证不存在！');</script>";
		}
	}
?>