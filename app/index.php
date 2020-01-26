<?php

use App\Modules\GarbageScrapper\Scrapper;
use DI\Container;

require __DIR__.'/../vendor/autoload.php';

if(!isset($argv[1]) && !isset($argv[2])) {
    die("No address params found! Please enter your address as following after the script. index.php [postcode] [house number]");
}

$container = new Container();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR);
$dotenv->load();

/** @var Scrapper $scrapper */
$scrapper = $container->make(Scrapper::class);
$dates  = $scrapper
    ->setPostcode($argv[1])
    ->setHouseNumber($argv[2])
    ->scrapComingUp();

$data = [];

foreach($dates as $date) {
    $data[] = [
        'title' => $date->getTitle(),
        'date' => $date->getDate(),
        'icon' => $date->getIcon(),
    ];
}

header('Content-Type: application/json');
echo json_encode($data);
exit;