<?php

require 'vendor/autoload.php';

use Goutte\Client;

$dsn = 'mysql:host=data;';
$user = 'root';
$password = 'stats';

try {
    $conn = new PDO($dsn, $user, $password);
    $conn->exec("CREATE DATABASE IF NOT EXISTS tibiastats;");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage() . '\n -->> run this again first \n\n';
}

try {
    $conn = new PDO($dsn, $user, $password);
    $conn->exec("use tibiastats;CREATE TABLE IF NOT EXISTS expworld (charname VARCHAR(255), exp VARCHAR(255), coletd_at TIMESTAMP DEFAULT NOW());");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage() . '\n -->> run this again first \n\n';
}
