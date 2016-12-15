<?php
	include("connect.php");
	include("token.php");

	$authorId = checkToken(addslashes($_POST["token"]),$returnData);
	if ($authorId == -1) {
		echo json_encode($returnData);
		return;
	}
	$title = addslashes($_POST["title"]);
	$content = addslashes($_POST["content"]);

	$sql = "INSERT INTO question ( authorId , title , content , date ) 
	VALUES ( '".$authorId."' , '".$title."','{$content}',now())";

	if (mysql_query($sql)) {
		$returnData["info"] = $sql;
	}else{
		header("http/1.1 500 Internal Server Error");
		$returnData["error"] = mysql_error();
	}

 	echo json_encode($returnData);
?>