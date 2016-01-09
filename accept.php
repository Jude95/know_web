<?php
 include("connect.php" );
 include("token.php");

 $result = array("status" => 0,"info" => "","data"=> null);
 $answerId = addslashes($_POST["answerId"]);
 $questionId = addslashes($_POST["answerId"]);
 $userId = checkToken(addslashes($_POST["token"]),$returnData);
	if ($authorId == -1) {
		echo json_encode($returnData);
		return;
	}
 if (mysql_query("SELECT * FROM answer WHERE id = {$answerId}")) {
 	$query = "UPDATE question SET bestAnswerId = {$answerId} WHERE id = {$questionId} AND authorId = {$userId} AND bestAnswerId = null";
	 if (mysql_query($query)) {
	 	$result["status"] = 200;
	 	$result["info"] = $query;
	 }else{
	 	$result["status"] = 0;
	 	$result["info"] =  mysql_error();
	 }
 }else{
 	$result["status"] = 0;
	$result["info"] =  "answerId".$answerId."is not exist";
 }
 echo json_encode($result);
?>