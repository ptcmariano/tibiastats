<?php

require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'https://secure.tibia.com/community/?subtopic=highscores&world=Umera&list=experience');

$crawler->filter('tr.LabelH ~ tr')->each(function ($node) {
    if ($node->filter('td:nth-child(2)')->count()>0) {
        print "nome: ";
        print $node->filter('td:nth-child(2)')->text()."\n";
        print "exp: ";
        print $node->filter('td:last-child')->text()."\n";
    }
});
