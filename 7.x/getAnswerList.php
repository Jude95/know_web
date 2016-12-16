<?php
include("connect.php");
include("jsonWrapper.php");


$dataInfo = array("totalCount" => 0, "totalPage" => 0, "answers" => null);


$page = (int)$_POST["page"];
$count = (int)$_POST["count"];
$qid = (int)$_POST["qid"];

if (!$count) {
    $count = 10;
}

$sql = $pdo->prepare("SELECT answer.id, answer.content, answer.date, answer.exciting, answer.best, answer.uid AS authorId, person.username AS authorName, person.avatar AS authorAvatar 
FROM person RIGHT JOIN answer ON person.id = answer.uid WHERE qid = ? ORDER BY `date` LIMIT ? , ?");

$sql->execute(array($qid, $page * $count, $count));
$data = null;
foreach ($sql->fetchAll(PDO::FETCH_NAMED) as $row) {
    $data[] = $row;
}
$sql = $pdo->prepare("SELECT COUNT(*) AS count FROM answer WHERE qid = ?");
$sql->execute(array($qid));
$totalCount = $sql->fetch(PDO::FETCH_NAMED);
$dataInfo["answers"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);
