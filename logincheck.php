<?php
	require("config.php");
	if($_POST["user"]==$user && $_POST["pass"]==$pass){
		setcookie("login_info",true,time()*60*60*24);	
		header("location:./".$_POST["backto"]);
	}
	else{
?>
ログイン失敗。。。<br>
<?php
	echo"<a href='./".$_POST["backto"]."'>戻る</a>";
	}
?>