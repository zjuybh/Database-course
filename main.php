<?php
	session_start();
	$manager_id = @$_SESSION['manager_id'];
	if($manager_id){
		echo "欢迎登录！<br>";
		echo "<a href = 'book_in 1.php'>图书单本入库</a> &nbsp";
		echo "<a href = 'book_macroin.php'>图书批量入库</a> &nbsp";
		echo "<a href = 'query 1.php'>图书查询</a> &nbsp";
		echo "<a href = 'book_out 1.php'>图书借出</a> &nbsp";
		echo "<a href = 'book_return 1.php'>图书归还</a> &nbsp";
		echo "<a href = 'card_manage 1.php'>借书证管理</a> &nbsp";
		echo "<a href = 'login.php'>退出</a> &nbsp";
	}
	else{
		echo "对不起，您没有访问该页面的权限";
	}
	

?>