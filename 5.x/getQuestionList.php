<?php
	include("connect.php");

	$dataInfo = array("totalCount" => 0,"totalPage" =>0,"questions"=> null);

	$page = addslashes($_POST["page"]);
	$count = addslashes($_POST["count"]);
	if ($count == 0) {
		$count = 20;
	}

	$sql = "SELECT question.id,question.title,question.content,question.bestAnswerId,question.date,question.recent,question.answerCount,question.authorId,person.name as authorName,person.face as authorFace FROM person RIGHT JOIN question ON person.id = question.authorId ORDER BY IFNULL(recent,date) DESC LIMIT ".($page*$count).",".$count;

	$result = mysql_query($sql);

	while($row = mysql_fetch_assoc($result)){
		$data[] = $row;
	}
	$totalCount = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM question"));
	
	$dataInfo["questions"] = $data;
	$dataInfo["totalCount"] = (int)$totalCount['count'];
	$dataInfo["curPage"] = $page;
	$dataInfo["totalPage"] = (int)($totalCount['count']/$count)+1;

	echo json_encode($dataInfo);
?>