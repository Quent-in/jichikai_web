<?php
class BlogList{
	var $listhtml="";
	function BlogList($num,$arcv){
		global $PG_DIR;
		if($_GET["action"]==="edit"){
			return "";
		}
		$dir = opendir($PG_DIR);

		$this->listhtml=$arcv ? "<h2>ブログ記事一覧</h2>" : "新着記事一覧<br />";
		$this->listhtml.="<ul>";
		for($i=0;$file = readdir($dir);){
			if(!preg_match("/^_Blog__/",$file)){
				continue;
			}
			$mdate=filemtime($PG_DIR."/".$file);
			$dirinfo[$i]=array($mdate,$file);
			$i++;
		}
		rsort($dirinfo);
		$num = $num ? $num : $i ; 
		for($i=0;$i<$num&&$dirinfo[$i];$i++){
			$dir=$dirinfo[$i];
			$file=$dir[1];
			if(!preg_match("/^_Blog__/",$file)){continue;};
			$filetext=file_get_contents($PG_DIR."/".$file);
			$f=preg_split("/\n/",$filetext);
			$text=$f[0];
			$title=substr($text,1);
			$title=strip_tags($title);
			$filename=preg_replace("/(^_Blog__.*)\.txt/","$1",$file);
			$this->listhtml.="<li><a href='?page=$filename'> $title </a></li>\n";
			$this->listhtml.="<ul><li>Update ".date("Y/m/d",$dir[0])."</li></ul>";
		}
		$this->listhtml.="</ul>";
		return $this->listhtml;
	}
}
?>
