<?php
include("connect.php");
include("token.php");

$username = addslashes($_POST["username"]);
$password = addslashes($_POST["password"]);

$query = "SELECT `id`, `username`, `avatar` FROM person WHERE `username` = '{$username}' AND `password` = '{$password}'";
$result = $pdo->query($query);
if ($row = $result->fetch(PDO::FETCH_NAMED)) {
    $row["token"] = create_unique($pdo, $row["id"]);
    success_encode($row);
} else {
    other_encode(400, "账号密码错误");
}

