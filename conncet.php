<?php
	

	$serverName = "余柏翰的计算机\SQLEXPRESS";
	$uid = "ybh2017";
	$pwd = "123456";
	$db = "lib management";
	$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>$db);

	$conn = sqlsrv_connect($serverName, $connectionInfo);

?>