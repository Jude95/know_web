<?php
include("connect.php");
include("token.php");

$TYPE_QUESTION = 0;
$TYPE_ANSWER = 1;

$token = $_POST["token"];
checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

if ($type == $TYPE_ANSWER) {
    $sql = "UPDATE answer SET `exciting` = `exciting` + 1 WHERE `id` = $id";
} elseif ($type == $TYPE_QUESTION) {
    $sql = "UPDATE question SET `exciting` = `exciting` + 1 WHERE `id` = $id";
} else {
    other_encode(400, "一点都不exciting");
}

if ($pdo->exec($sql)) {
    success_encode($info = "excited");
} else {
    other_encode(500, "exciting失败");
}
