<?php

 include("connect.php");

 include("token.php");

 $face = addslashes($_POST["face"]);

 $authorId = checkToken(addslashes($_POST["token"]),$returnData);

	if ($authorId == -1) {
		echo json_encode($returnData);
		return;
	}

 $query = "UPDATE person SET face = '{$face}' WHERE id = '{$authorId}'";
 if (mysql_query($query)) {
 	$result["info"] = "修改成功";
 }else{
 	header("http/1.1 500 Internal Server Error");
 	$result["error"] =  mysql_error();
 }
 echo json_encode($result);

?>