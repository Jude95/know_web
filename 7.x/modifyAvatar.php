<?php
include("connect.php");
include("token.php");

$avatar = addslashes($_POST["avatar"]);
$token = addslashes($_POST["token"]);
$uid = checkToken($pdo, $token);

$sql = "UPDATE person SET `avatar` = '{$avatar}' WHERE `id` = $uid";

if ($pdo->exec($sql)) {
    success_encode();
} else {
    other_encode(500, "更改失败");
}

