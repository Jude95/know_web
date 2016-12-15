<?php
function checkToken(PDO $pdo, $token)
{
    $query = "SELECT `id` FROM `person` WHERE `token` = '{$token}'";
    $result = $pdo->query($query);
    if ($row = $result->fetch(PDO::FETCH_NAMED)) {
        return $row["uid"];
    } else {
        other_encode(401, "token:{$token} 无效");
        return null;
    }
}

function create_unique(PDO $pdo, $id)
{
    $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . time() . rand();
    $data = sha1($data);
    $sql = "UPDATE person SET `token` = '{$data } ' WHERE `id` = '{$id}';";
    $pdo->prepare($sql);//TODO
    $pdo->exec($sql);
    return $data;
}
