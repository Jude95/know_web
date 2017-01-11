<?php
$pdo = new PDO("mysql:host=localhost;dbname=bihu;", "bihu", "bihu");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->exec("set names 'utf8mb4'");

$TYPE_QUESTION = 1;
$TYPE_ANSWER = 2;
