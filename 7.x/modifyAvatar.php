<?php
include("connect.php");
include("token.php");

$avatar = $_POST["avatar"];
$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$sql = $pdo->prepare("UPDATE person SET `avatar` = ? WHERE `id` = ?");

if ($sql->execute(array($avatar, $uid))) {
    success_encode();
} else {
    other_encode(500, "更改失败");
}
