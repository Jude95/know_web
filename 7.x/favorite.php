<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$qid = (int)$_POST["qid"];

$sql = $pdo->prepare("INSERT INTO favorite (`uid`, `qid` ) VALUES ( ?, ?)");

if ($sql && $sql->execute(array($uid, $qid))) {
    success_encode();
} else {
    other_encode(500, "exciting失败");
}
