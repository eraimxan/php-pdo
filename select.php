<?php

$pdo = include_once __DIR__ . '/connection.php';


$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);


while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
 var_dump($user);
}


$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



$userId = '1';
$sql = "SELECT * FROM users WHERE id = $userId";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


$userId = 1;
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$email = 'igor@areaweb.su   ';
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([
 'email' => $email
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);