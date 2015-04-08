<?php

require_once __DIR__.'/../vendor/autoload.php';

// utilisation du stockage en base

Connect::setDB(include __DIR__ . '/../config/database.php');
$card = new Card(new DBStockage());

$apple=new Product('apple', 1000.78);

$card->buy($apple, 5);

$stmt = Connect::getDB()->query('SELECT * FROM products');
$data = $stmt->fetchAll();
echo "<pre>";
print_r($data);
echo "</pre>";

// utilisation avec le système de SessionStockage

$card2 = new Card(new SessionStockage());

$raspberry=new Product('raspberry', 45.78);

$card2->buy($raspberry, 12);
$card2->buy($raspberry, 1);  // on en ajoute 1

echo "<pre>";
print_r($_SESSION);
echo "</pre>";










