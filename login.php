<html>
<head>
<title>管理员登录</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head>
<body>
<form action = "" method="post">
<div align="center"><font size = "5" color = "blue">管理员登录</font> </div>
<table align="center">
<tr><td>管理员账号</td>
	<td><input type="text" name="manager_id"></td></tr>
<tr><td>密码</td>
	<td><input type="password" name="password" size="21"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="登录"></td></tr>

</table>
	
</form>
</body>
</html>

<?php
	include "conncet.php";
	if(isset($_POST['Submit'])){
		$manager_id = $_POST['manager_id'];
		$password = $_POST['password'];
		$stmt = "SELECT * FROM manager WHERE manager_id = '$manager_id'";
		$result = sqlsrv_query($conn, $stmt);

		if($row = sqlsrv_fetch_array($result)){
			// echo $row['password'].',';
			// echo $password;
			if($row['password'] == $password){
				session_start();
				$_SESSION['manager_id'] = $manager_id;
				echo "登陆成功！</br>";
				header("location: http://localhost:8080/lib%20manage/main.php");
			}
			else{
				echo "<script>alert('密码错误！');</script>";
			}
		}
		else{
			echo "<script>alert('账号不存在！');</script>";
		}
	}


?>