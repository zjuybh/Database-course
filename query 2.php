<html><head><title>查询结果</title>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
<a href = 'query 1.php'>继续查询</a> &nbsp;
</head><body>
<?php
include "conncet.php";
	$fieldname = $_POST["fieldname"];
	$cmpstr = $_POST["cmpstr"];
	$cmpval = $_POST["cmpval"];
	$order = $_POST["order"];
	// echo "$fieldname, $cmpstr, $cmpval".'</br>';

	$cmpval = iconv('utf-8', 'GB2312', $cmpval);
	$order = iconv('utf-8', 'GB2312', $order);
	
	$stmt = "SELECT * FROM book WHERE ";

	if($cmpstr == '='){
		$stmt .= "$fieldname = '$cmpval' order by '$order' ";
	}
	else if($cmpstr == '<>'){
		$stmt .= "$fieldname <> '$cmpval' order by '$order' ";
	}
	else if($cmpstr == 'ks'){
		if($fieldname == 'year'){
			$stmt .= "$fieldname >= $cmpval order by '$order' ";
		}
		else{
			$stmt .= "$fieldname LIKE '$cmpval%' order by '$order' ";
		}
	}
	else if($cmpstr == 'js'){
		if($fieldname == 'year'){
			$stmt .= "$fieldname <= $cmpval order by '$order' ";
		}
		else{
			$stmt .= "$fieldname LIKE '%$cmpval' order by '$order' ";
		}
	}
	else if($cmpstr == 'bh'){
		$stmt .= "$fieldname LIKE '%$cmpval%' order by '$order' ";
	}

	// echo iconv('GB2312', 'utf-8', $stmt)."</br>";

	
	// if($conn == false){
	// echo "连接失败!";
	// die( print_r( sqlsrv_errors(), true));
	// }
	// else{
	// echo "连接成功！";
	// }

	
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
		echo "没有查询到相关数据！";
	}

	sqlsrv_close($conn);
?>



</body></html>