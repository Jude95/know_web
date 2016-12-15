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
$start = $page * $count;

$sql = "SELECT answer.id, answer.content, answer.date, answer.uid AS authorId, person.username AS authorName, person.avatar AS authorAvatar 
FROM person RIGHT JOIN answer ON person.id = answer.uid WHERE qid = $qid ORDER BY `date` LIMIT $start , $count";

$result = $pdo->query($sql);
$data = null;
foreach ($result->fetchAll(PDO::FETCH_NAMED) as $row) {
    $data[] = $row;
}
$totalCount = $pdo->query("SELECT COUNT(*) AS count FROM answer WHERE qid = $qid")->fetch(PDO::FETCH_NAMED);
$dataInfo["answers"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);
