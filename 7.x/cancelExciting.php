<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;
$exciting = null;

switch ($type) {
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("DELETE FROM exciting_answer WHERE `uid` = ? AND `aid` = ?");
        $exciting = $pdo->prepare("UPDATE question SET exciting = exciting - 1");
        break;
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("DELETE FROM exciting_question WHERE `uid` = ? AND `qid` = ?");
        $exciting = $pdo->prepare("UPDATE question SET exciting = exciting - 1");
        break;
    default:
        other_encode(400, "一点都不exciting");
}

if ($sql && $sql->execute(array($uid, $id))) {
    $exciting->execute();
    success_encode($info = "excited");
} else {
    other_encode(500, "exciting失败");
}
