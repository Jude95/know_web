<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);
$qid = (int)$_POST["qid"];

$sql = $pdo->prepare("DELETE FROM favorite WHERE uid = ? AND qid = ?");

if ($sql->execute(array($uid, $qid))) {
    success_encode();
} else {
    other_encode(500, "取消失败");
}
