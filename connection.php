<?php

$host = 'localhost';
$dbname = 'pdo';
$username = 'root';
$password = 'root';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;", $username, $password);
    print_r($pdo);
    return $pdo;
} catch (PDOException $exception) {
    echo "Error DB connection: {$exception->getMessage()}";
    return null;
}