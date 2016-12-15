<?php
include("connect.php");
include("token.php");

$result = checkToken($pdo, $token);

$uid = $result["uid"];

$title = addslashes($_POST["title"]);
$content = addslashes($_POST["content"]);

//$sql = "INSERT INTO question ( uid , title , content , date ) VALUES (  $uid . , '{$title}','{$content}',now())";
$sql = "INSERT INTO question ( `uid`, `title`, `content` ) VALUES (  $uid , '{$title}', '{$content}'";

if ($pdo->exec($sql)) {
    success_encode();
} else {
    other_encode(500, $pdo->errorInfo());
}
