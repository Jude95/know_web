<?php
$pdo = new PDO("mysql:host=localhost;dbname=bihu;", "bihu", "bihu");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
