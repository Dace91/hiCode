<?php

$link = mysqli_connect('localhost', 'root', 'antoine') or die("pb connexion");

// réinitialisation
$link->query("
        DROP DATABASE IF EXISTS card;
        ") or die("drop database impossible");

//$link->query("
//        DELETE FROM mysql.user WHERE user='tony' and host='tony';
//        ") or die("drop user impossible");

$link->query("
        CREATE DATABASE IF NOT EXISTS `card` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"
        ) or die("pb create database card");

echo "ok database \n";

$link->query("
        GRANT ALL PRIVILEGES ON card.* to 'tony'@'localhost' IDENTIFIED BY
'tony' WITH GRANT OPTION;"
        ) or die("impossible de créer l'utilisateur tony");

echo "Ok new user \n";

mysqli_close($link);

$link = mysqli_connect('localhost', 'tony', 'tony', 'card') or die("pb connexion");

// table users
$link->query("
         CREATE TABLE `products` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
        `name` VARCHAR(30) NOT NULL,
        `total` DECIMAL(10,2) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 ")or die("pb create table products");


// seed tables
$link->query("
        INSERT INTO products (`name`,`total`) VALUES 
        ('apple', 0), ('raspbery', 0);
        ")or die("pb insert data products");

mysqli_close($link);

echo "ok tout est bon, on passe aux droits pour les fichiers et dossiers du site";

/**
// les "données" du site doivent appartenir à Apache
exec('sudo chown -R www-data: *');

// fichier modifiables et lisible par www-data uniquement
exec('sudo find * -type f -exec chmod 660 {} \ ;');

// et que les dossiers soient inscriptible et traversable par www-data
exec('sudo find * -type d -exec chmod 770 {} \;');
*/

