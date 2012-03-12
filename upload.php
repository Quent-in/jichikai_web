<!doctype html>
<html lang="ja">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
<script>
var fileName="";
<?php
	$upfile=$_FILES["uploadfile"];
	if(is_uploaded_file($upfile["tmp_name"])){
		$extension=pathinfo($upfile["name"], PATHINFO_EXTENSION);
		$fileName=time().".".$extension;
		if(move_uploaded_file($upfile["tmp_name"], "img/".$fileName)){
			chmod("img/" . $fileName, 0644);
			echo "fileName='".$fileName."';";
		}
	}
		?>
	if(fileName){
		window.opener.document.getElementById("uploadFileName").value=fileName;
		alert("アップロード成功しました。")
		window.opener.editor.insertImgPath();
		window.close();
	}else{
		alert("アップロードに失敗しました。");
	}
</script>
</head>
</html>
