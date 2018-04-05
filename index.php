<?php
	
session_start();	

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use FF10\Models\Character;
use FF10\Controllers\BattleController;

$request = Request::createFromGlobals();

$app= new Silex\Application();

$app['debug']=true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

$url= 'http://'.$_SERVER['SERVER_NAME'].'/FF10';

//Battle View
$app->get('/', function () use ($app, $url, $request) {    
    //Titus Session Variables
    $_SESSION['TitusName']='Tidus';
    $_SESSION['TitusHP']=500;
    $_SESSION['TitusMP']=50;
    $_SESSION['TitusAttackStrength']=20;
    $_SESSION['TitusMagicStrength']=40;
    $_SESSION['TitusMagicCapabilities']=[];
    $titus= new Guardian($_SESSION['TitusName'], $_SESSION['TitusHP'], $_SESSION['TitusMP'], $_SESSION['TitusMagicStrength'], $_SESSION['TitusMagicStrength'], $_SESSION['TitusMagicCapabilities']);
    
    //Seymour Session Variables
    $_SESSION['SeymourName']='Seymour';
    $_SESSION['SeymourHP']=10000;
    $_SESSION['SeymourMP']=1000;
    $_SESSION['SeymourAttackStrength']=100;
    $_SESSION['SeymourMagicStrength']=300;
    $_SESSION['SeymourMagicCapabilities']=['Poison'];
    $_SESSION['SeymourSummonCapabilities']=['Anima'];
    $seymour= new Summoner($_SESSION['SeymourName'], $_SESSION['SeymourHP'], $_SESSION['SeymourMP'], $_SESSION['SeymourAttackStrength'], $_SESSION['SeymourMagicStrength'], $_SESSION['SeymourMagicCapabilities'], $_SESSION['SeymourSummonCapabilities']);

    return $app['twig']->render('base.twig.html', ['url'=>$url,
    'titusStatus'=>$titus->getStatus(),
    'seymourStatus'=>$seymour->getStatus()
    ]);
});

$app->run();