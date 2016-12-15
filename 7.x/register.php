<?php
include("connect.php");
include("token.php");

$username = addslashes(@$_POST["username"]);
$pass = addslashes(@$_POST["password"]);

if ($username && $pass) {
    $query = "SELECT * FROM person WHERE `username` = '$username'";
    $user = $pdo->query($query);
    if ($user->fetchAll(PDO::FETCH_NAMED)) {
        other_encode(400, "用户名已被使用");
    } else {
        $sql = "INSERT INTO person (username, password) VALUES ('$username', '$pass')";
        $pdo->exec($sql);
        $sql = "SELECT * FROM person WHERE username = '$username'";
        if ($result = $pdo->query($sql)->fetch(PDO::FETCH_NAMED)) {
            $result["token"] = create_unique($pdo, $result['id']);
            success_encode($result);
        } else {
            other_encode(500, $pdo->errorInfo());
        }
    }
} else {
    other_encode(400, "用户名或密码不能为空");
}
