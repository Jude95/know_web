<?php
include("connect.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "answers" => null);

$page = addslashes($_POST["page"]);
$count = addslashes($_POST["count"]);
$desc = true;
$id = addslashes($_POST["questionId"]);
if ($count == 0) {
    $count = 10;
}
$sql = "SELECT answer.id, answer.content, answer.date, answer.uid AS authorId, person.name AS authorName, person.avatar AS authorAvatar 
FROM person RIGHT JOIN answer ON person.id = answer.uid WHERE qid = {$id} ORDER BY date LIMIT ($page * $count) , $count";

$result = $pdo->query($sql);
$data = null;
foreach ($result->fetchAll(PDO::FETCH_NAMED) as $row) {
    $data[] = $row;
}
$totalCount = $pdo->query("SELECT COUNT(*) AS count FROM answer WHERE qid = $id")->fetch(PDO::FETCH_NAMED);
$dataInfo["answers"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);
