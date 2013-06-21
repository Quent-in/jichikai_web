<?php
	session_start();
	require("config.php");
	if($_POST["user"]==$user && $_POST["pass"]==$pass){
		$_SESSION['jichikaiLogin'] = true;
		header("location:./".$_POST["backto"]);
	}
	else{
?>
ログイン失敗。。。<br>
<?php
	echo"<a href='./".$_POST["backto"]."'>戻る</a>";
	}
?>
