<html><head><title>借书证管理</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head><body>
	<a href = 'main.php'>返回主菜单</a> &nbsp;
	<h2 align='center' >借书证管理</h2>
	<form action = "" method="post">
	<table border="1" align="center">

	<tr><td>借书证号</td><td><input type="text" name="cno" size="20"></td></tr>
	<tr><td>姓名</td><td><input type="text" name="name" size="20"></td></tr>
	<tr>
	<th>所在院(系)</th>
	<td>
		<select name = 'department'>
			<option>材料科学与工程学院</option>
			<option>传媒与国际文化学院</option>
			<option>地球科学学院</option>
			<option>电气工程学院</option>
			<option>动物科学学院</option>
			<option>法学院</option>
			<option>高分子科学与工程学系</option>
			<option>公共管理学院</option>
			<option>公共体育与艺术部</option>
			<option>管理学院</option>
			<option>海洋学院</option>
			<option>航空航天学院</option>
			<option>化学工程与生物工程学院</option>
			<option>化学系</option>
			<option>环境与资源学院</option>
			<option>基础医学系</option>
			<option>机械工程学院</option>
			<option>计算机科学与技术学院</option>
			<option>建筑工程学院</option>
			<option>教育学院</option>
			<option>经济学院</option>
			<option>控制科学与工程学院</option>
			<option>临床医学系</option>
			<option>马克思主义学院</option>
			<option>能源工程学院</option>
			<option>农业与生物技术学院</option>
			<option>人文学院</option>
			<option>生命科学学院</option>
			<option>生物系统工程与食品科学学院</option>
			<option>生物医学工程与仪器科学学院</option>
			<option>数学科学学院</option>
			<option>外国语言文化与国际交流学院</option>
			<option>物理学系</option>
			<option>信息与电子工程学院</option>
			<option>药学院</option>
			<option>医学院</option>
		</select>
	</td>
	</tr>
	<tr><td>持卡人身份</td><td><input type="radio" name="role" value='T'>教师
	<input type="radio" name="role" value='S'>学生</td></tr>
	<tr><td>管理类型</td><td><input type="radio" name="judge" value="add">增加借书证
	<input type="radio" name="judge" value="delete">删除借书证</td></tr>
	<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="提交"></td></tr>

<?php
	include "conncet.php";
	if(isset($_POST['Submit'])){
		$judge = $_POST['judge'];
		// echo "$cno, $name, $department, $role, $judge <br>";
		if($judge == 'add'){
			$cno = $_POST['cno'];
			$name = $_POST['name'];
			$department = $_POST['department'];
			$role = $_POST['role'];

			$stmt = "SELECT * FROM card WHERE cno = '$cno'";
			$query = sqlsrv_query($conn, $stmt);
			$has_rows = sqlsrv_has_rows($query);
			if(!$has_rows){
				$stmt2 = "INSERT INTO card VALUES('$cno','$name','$department','$role')";
				$stmt2 = iconv('utf-8', 'GB2312', $stmt2);
				// echo "$stmt2<br>";
				if(sqlsrv_query($conn, $stmt2)){
					echo "<script>alert('添加成功！');</script>";
				}
				else{
					echo "<script>alert('添加失败！');</script>";
					die (print_r(sqlsrv_errors(), true));
				}
			}
			else{
				echo "<script>alert('已存在该借书证！');</script>";
			}
		}
		
		else if($judge == 'delete'){
			$cno = $_POST['cno'];
			// $name = $_POST['name'];
			// $department = $_POST['department'];
			// $role = $_POST['role'];
			// $judge = $_POST['judge'];
			$stmt3 = "SELECT * FROM card WHERE cno = '$cno'";
			$query3 = sqlsrv_query($conn, $stmt3);
			$has_rows = sqlsrv_has_rows($query3);
			if($has_rows){
				$stmt4 = "DELETE FROM card WHERE cno = '$cno'";
				$stmt4 = iconv('utf-8', 'GB2312', $stmt4);
				// echo "$stmt4<br>";
				if(sqlsrv_query($conn, $stmt4)){
					echo "<script>alert('删除成功！');</script>";
				}
				else{
					echo "<script>alert('删除失败！');</script>";
					die (print_r(sqlsrv_errors(), true));
				}
			}
			else{
				echo "<script>alert('不存在该借书证！');</script>";
			}
		}
	}

?>