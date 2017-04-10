<html><head><title>查询结果</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
	<tr>
		<td colspan="4" style="text-align: center;">
			<a href = 'book_out 1.php'>继续借书</a> &nbsp;
		</td>
	</tr>
</head><body>
<?php
	include "conncet.php";
	session_start();
	$cno = @$_SESSION['cno'];
	$bno = @$_SESSION['bno'];
	
	$stmt = "SELECT * FROM borrow WHERE cno = '$cno'";
	// echo iconv('GB2312', 'utf-8', $stmt)."</br>";

	$query = sqlsrv_query($conn, $stmt);
	$has_rows = sqlsrv_has_rows($query);
	$dispMsg = "";
	$i = 0;
	$field_num = 0;

	if($has_rows){
		$field_num = sqlsrv_num_fields($query);
		$field_arr = sqlsrv_field_metadata($query);
		$dispMsg = "<table border = '1' align = 'center'>";
		$dispMsg .= "<tr>";

		for($i = 0; $i < $field_num; $i++){
			$col_arr = $field_arr[$i];
			$dispMsg .= "<th>".$col_arr["Name"]."</th>";
		}

		$dispMsg .= "</tr>";
		echo $dispMsg;

		while($row = sqlsrv_fetch_array($query)){
			$dispMsg = "<tr>";
			for($i = 0; $i < $field_num; $i++){
				$tmpstr = iconv('GB2312', 'utf-8', $row[$i]);
				if(strlen($tmpstr) == 0){
					$tmpstr = "&nbsp";
				}
				$dispMsg .= "<td>".$tmpstr."</td>";
			}
			$dispMsg .= "</tr>";
			echo $dispMsg;
		}
		echo "</table>";
	}

	else{
		echo "该借书卡还没有借出过书籍！";
	}


	$stmt2 = "SELECT stock FROM book WHERE bno = '$bno'";
	$query2 = sqlsrv_query($conn, $stmt2);
	// echo iconv('GB2312', 'utf-8', $stmt2)."</br>";
	$row2 = sqlsrv_fetch_array($query2);
	if($row2['stock'] >= 0){
		echo "借书成功！";
		$stmt3 = "UPDATE book SET stock = stock - 1 WHERE bno = '$bno'";
		// echo iconv('GB2312', 'utf-8', $stmt3)."</br>";
		$query3 = sqlsrv_query($conn, $stmt3);
		date_default_timezone_set("Asia/Shanghai");
		$borrow_date = date("Y-m-d");
		$return_date = date('Y-m-d', strtotime('+20 days'));
		$stmt5 = "INSERT INTO borrow VALUES('$cno','$bno','$borrow_date','$return_date', '001');";
		$query5 = sqlsrv_query($conn, $stmt5);
	}
	else{
		$stmt4 = "SELECT min(return_date) AS min_return_time FROM borrow WHERE bno = '$bno'";
		// echo iconv('GB2312', 'utf-8', $stmt4)."</br>";
		$query4 = sqlsrv_query($conn, $stmt4);
		$row4 = sqlsrv_fetch_array($query4);
		echo "很抱歉！库存不足，已借出的该书最早的归还时间为： ";
		echo $row4['min_return_time'];
	}



?>