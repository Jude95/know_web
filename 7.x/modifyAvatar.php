<?php

include("connect.php");
include("token.php");

$avatar = addslashes($_POST["avatar"]);
$token = addslashes($_POST["token"]);
$result = checkToken($pdo, $token);

$uid = $result["uid"];

$sql = "UPDATE person SET `avatar` = '{$avatar}' WHERE `id` = '{$uid}'";

if ($pdo->exec($sql)) {
    success_encode();
} else {
    other_encode(500, $pdo->errorInfo());
}

