<html><head><title>查询结果</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
	<tr>
		<td colspan="4" style="text-align: center;">
			<a href = 'book_return 1.php'>继续还书</a> &nbsp;
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

		echo "还书成功！";
		$stmt3 = "UPDATE book SET stock = stock + 1 WHERE bno = '$bno'";
		// echo iconv('GB2312', 'utf-8', $stmt3)."</br>";
		$query3 = sqlsrv_query($conn, $stmt3);
		$stmt4 = "DELETE borrow WHERE bno = '$bno' and cno = '$cno' ";
		$query4 = sqlsrv_query($conn, $stmt4);

	}

	else{
		echo "该借书卡还没有借出过书籍！";
	}

	



?>