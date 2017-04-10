<a href = 'main.php'>返回主菜单</a> &nbsp;
<br>

<?php
	include "conncet.php";
	$fp = fopen('input.txt', 'r');
	$count = 1;
	while(1){
		$temp = fgets($fp);
		if(!feof($fp)){
			$temp = explode(" ", $temp);
			$bno = $temp[0];
			$category = $temp[1];
			$title = $temp[2];
			$press = $temp[3];
			$year = (int)$temp[4];
			$author = $temp[5];
			$price = (float)$temp[6];
			$total = (int)$temp[7];
			$stock = (int)$temp[8];

			$stmt = "SELECT * FROM book WHERE bno = '$bno'";
			$query = sqlsrv_query($conn, $stmt);
			$has_rows = sqlsrv_has_rows($query);
			if($has_rows){
				echo "第"."$count"."条书目已存在！<br>";
			}
			else{
				if(!is_int($year)){
					echo "第"."$count"."条书目的年份必须是整数！<br>";
				}
				else if (!is_float($price)){
					if(!is_int($price)){
						echo "第"."$count"."条书目的价格必须是整数或者浮点数！<br>";
					}	
				}
				else if(!is_int($total)){
					echo "第"."$count"."条书目的藏书量必须是整数！<br>";
				}
				else if(!is_int($stock)){
					echo "第"."$count"."条书目的库存必须是整数！<br>";
				}
				else{
					$stmt2 = "INSERT INTO book VALUES('$bno','$category','$title','$press',$year,'$author',$price, $total, $stock)";
					// echo "$stmt2, <br>";
					$stmt2 = iconv('utf-8', 'GB2312//ignore', $stmt2);
					if(sqlsrv_query($conn, $stmt2)){
						echo "第"."$count"."条书目入库成功！<br>";
					}
					else{
						echo "第"."$count"."条书目入库失败！<br>";
						// die (print_r(sqlsrv_errors(), true));
					}
				}
			}
			// echo "$bno, $category, $title, $press, $year, $author, $price, $total, $stock, <br>";
		}


		else{
			break;
		}

		$count++;
	}

?>