<?php
include("connect.php");
include("token.php");

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;

switch ($type) {
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("SELECT url FROM image WHERE `qid` = ? ");
        break;
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("SELECT url FROM image WHERE `aid` = ? ");
        break;
    default:
        other_encode(400, "类型有误");
}

if ($sql && $sql->execute(array($id))) {
    success_encode($sql->fetchAll(PDO::FETCH_NAMED));
} else {
    other_encode(500, "上传失败");
}
