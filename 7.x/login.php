<?php
include("connect.php");
include("token.php");

$name = addslashes($_POST["name"]);
$password = addslashes($_POST["password"]);

$query = "SELECT `id`, `name`, `avatar` FROM person WHERE `name` = '{$name}' AND `password` = '{$password}'";
$result = $pdo->query($query);
if ($row = $result->fetch(PDO::FETCH_NAMED)) {
    $row["token"] = create_unique($pdo, $row["student_number"]);
    success_encode($row);
} else {
    other_encode(400, "账号密码错误");
}


