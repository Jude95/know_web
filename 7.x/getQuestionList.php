<?php
include("connect.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "questions" => null);

$page = addslashes($_POST["page"]);
$count = addslashes($_POST["count"]);
if ($count == 0) {
    $count = 10;
}

$sql = "SELECT question.id, question.title, question.content, question.date, question.recent, question.answerCount, question.uid, person.name AS authorName, person.avatar AS authorAvatar 
FROM person RIGHT JOIN question ON person.id = question.uid ORDER BY IFNULL(recent, date) DESC LIMIT ($page * $count) , $count";

$result = $pdo->query($sql);
$data = null;
foreach ($result->fetchAll(PDO::FETCH_NAMED) as $row) {
    $data[] = $row;
}
$totalCount = $pdo->query("SELECT COUNT(*) AS count FROM question")->fetch(PDO::FETCH_NAMED);

$dataInfo["questions"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);
