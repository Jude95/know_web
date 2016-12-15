<?php
include("connect.php");
include("token.php");

$token = addslashes($_POST["token"]);
$uid = checkToken($pdo, $token);

$aid = addslashes($_POST["aid"]);
$qid = addslashes($_POST["qid"]);

$sql = "SELECT * FROM answer WHERE `id` = {$aid} AND `qid` = {$qid}";

if ($pdo->query($sql)) {
    $sql = "UPDATE answer SET `best` = TRUE WHERE `qid` = {$qid} AND `uid` = {$uid}";
    if ($pdo->query($sql)) {
        success_encode();
    } else {
        other_encode(500, "采纳失败");
    }
} else {
    other_encode(404, "未找到对应回答");
}
