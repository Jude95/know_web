<?php
include("connect.php");
include("jsonWrapper.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "answers" => null);


$token = $_POST["token"];
$uid = checkToken($pdo, $token);
$page = (int)$_POST["page"];
$count = (int)$_POST["count"];

if (!$count) {
    $count = 10;
}

$sql = $pdo->prepare("
    SELECT
      question.id,
      question.title,
      question.content,
      question.date,
      question.recent,
      question.answerCount,
      question.uid    AS autherId,
      person.username AS authorName,
      person.avatar   AS authorAvatar
    FROM question
      RIGHT JOIN person ON person.id = question.uid
      RIGHT JOIN favorite ON favorite.qid = question.id
    WHERE favorite.uid = ? ORDER BY IFNULL(`recent`, `date`) DESC
    LIMIT ?, ?
    ");

$sql->execute(array($uid, $page * $count, $count));
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
