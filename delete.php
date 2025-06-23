<?php


$pdo = include_once __DIR__ . '/connection.php';


$userId = 1;
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);