<?php
include("connect.php");
include("token.php");

$username = addslashes(@$_POST["username"]);
$password = addslashes(@$_POST["password"]);

if ($username && $password) {
    $sql = $pdo->prepare("SELECT * FROM person WHERE `username` = ?");
    $sql->execute(array($username));
    if ($sql->fetchAll(PDO::FETCH_NAMED)) {
        other_encode(400, "用户名已被使用");
    } else {
        $sql = $pdo->prepare("INSERT INTO person (username, password) VALUES ( ?, ? )");
        $sql->execute(array($username, $password));
        $sql = $pdo->prepare("SELECT * FROM person WHERE username = ?");
        $sql->execute(array($username));
        if ($result = $sql->fetch(PDO::FETCH_NAMED)) {
            $result["token"] = create_unique($pdo, $result['id']);
            success_encode($result);
        } else {
            other_encode(500, "注册失败");
        }
    }
} else {
    other_encode(400, "用户名或密码不能为空");
}
