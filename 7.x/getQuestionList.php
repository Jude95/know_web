<?php
include("connect.php");
include("jsonWrapper.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "questions" => null);

$page = (int)$_POST["page"];
$count = (int)$_POST["count"];
if (!$count) {
    $count = 10;
}
$start = $page * $count;

$sql = "SELECT question.id, question.title, question.content, question.date, question.recent, question.answerCount, question.uid, person.username AS authorName, person.avatar AS authorAvatar 
FROM person RIGHT JOIN question ON person.id = question.uid ORDER BY IFNULL(`recent`, `date`) DESC LIMIT $start , $count";

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