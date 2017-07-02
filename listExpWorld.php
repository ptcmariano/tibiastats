<?php

require 'vendor/autoload.php';

use Goutte\Client;

$dsn = 'mysql:dbname=tibiastats;host=data;';
$user = 'root';
$password = 'stats';

$client = new Client();
$crawler = $client->request('GET', 'https://secure.tibia.com/community/?subtopic=highscores&world=Honbra&list=experience');

$crawler->filter('tr.LabelH ~ tr')->each(function ($node) use ($dsn, $user, $password) {
    if ($node->filter('td:nth-child(2)')->count()>0) {
        try {
            $conn = new PDO($dsn, $user, $password);
            $tb = $conn->prepare("INSERT INTO expworld (charname,exp) VALUES (?,?);");
            $tb->execute([$node->filter('td:nth-child(2)')->text(),$node->filter('td:last-child')->text()]);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
});

try {
    $conn = new PDO($dsn, $user, $password);
    $tb = $conn->query("SELECT COUNT(*) FROM expworld;");
    foreach ($tb as $row) {
        var_dump($row);
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
