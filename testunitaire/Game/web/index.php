<?php

require_once __DIR__.'/../vendor/autoload.php';



use Hangman\Game;
use Hangman\Word;
use Hangman\GameContainer;
use Hangman\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

$loader = new Loader(__DIR__ . '/../data/words.yml');

var_dump($loader->getWord());