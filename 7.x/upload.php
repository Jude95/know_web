<?php
if ($_FILES["tmp"]["type"] == "image/*") {
    $type = explode(".", $_FILES["tmp"]["name"])[1];
    $path = "upload/" . date("YmdHis") . "." . $type;
    move_uploaded_file($_FILES["tmp"]["tmp_name"], $path);
    echo $path;
} else {
    header("http/1.1 400 Bad Request");
    echo "Fuck You!";
}
