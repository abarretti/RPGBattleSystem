<?php

use FF10\Models\Character;
//use FF10\Models\Summoner;

//require '/Character.php';
//require 'Summoner.php';

$titus= new Guardian('Titus', 500, 50, 20, 40, []);
$seymour= new Summoner('Seymour', 10000, 1000, 100, 300, ['Poison'],['Anima']);

var_dump($titus->getStatus());
var_dump($seymour->getStatus());

echo $seymour->poison($titus)."\n";
echo $titus->getHp();

var_dump($titus->getStatus());

?>

<!-- php Desktop/PHP/FF10/app/FF10/Models/testBattle.php -->