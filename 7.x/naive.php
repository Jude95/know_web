<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;
$naive = null;

switch ($type) {
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("INSERT INTO naive_answer (`uid`, `aid` ) VALUES ( ?, ?)");
        $naive = $pdo->prepare("UPDATE answer SET naive = naive + 1");
        break;
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("INSERT INTO naive_question (`uid`, `qid` ) VALUES ( ?, ?)");
        $naive = $pdo->prepare("UPDATE question SET naive = naive + 1");
        break;
    default:
        other_encode(400, "Too young!");
}

if ($sql && $sql->execute(array($uid, $id))) {
    $naive->execute();
    success_encode($info = "naive");
} else {
    other_encode(500, "Too simple!");
}
