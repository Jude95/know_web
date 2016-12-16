<?php
include("connect.php");
include("token.php");

$username = $_POST["username"];
$password = $_POST["password"];

$sql = $pdo->prepare("SELECT `id`, `username`, `avatar` FROM person WHERE `username` = ? AND `password` = ?");

$sql->execute(array($username, $password));
if ($row = $sql->fetch(PDO::FETCH_NAMED)) {
    $row["token"] = create_unique($pdo, $row["id"]);
    success_encode($row);
} else {
    other_encode(400, "账号密码错误");
}

