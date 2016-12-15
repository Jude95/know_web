<?php
include("connect.php");
include("token.php");

$result = checkToken($pdo, $token);
$uid = $result["uid"];

$answerId = addslashes($_POST["answerId"]);
$questionId = addslashes($_POST["questionId"]);

$sql = "SELECT * FROM answer WHERE `id` = {$answerId} AND `qid` = {$questionId}";

if ($pdo->query($sql)) {
    $sql = "UPDATE answer SET `best` = TRUE WHERE `qid` = {$questionId} AND `uid` = {$uid}";
    if ($pdo->query($sql)) {
        success_encode();
    } else {
        other_encode(500, $pdo->errorInfo());
    }
} else {
    other_encode(404, "未找到对应回答");
}
