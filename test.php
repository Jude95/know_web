<?php
$name = $_POST["name"];
$password =  $_POST["password"];

if ($name != "redrock") {
	echo "name 错了，应该是 redrock  你写的是".$name;
	return;
}
if ($password != "123456") {
	echo "password 错了，应该是 123456  你写的是".$password;
	return;
}
echo "呵呵，骚年你还是挺机智的";
?>