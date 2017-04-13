<?php

namespace TailorTest;


use Phalcon\Loader;
use TailorTest\Base\ServiceComposer;
use TailorTest\Service\UserService;

$loader = new Loader();
$loader->registerNamespaces([
    "TailorTest\\" => __DIR__,
    "TailorTest\\Base" => __DIR__ . "/Base",
    "TailorTest\\Base\\Exception" => __DIR__ . "/Base/Exception",
    "TailorTest\\Models" => __DIR__ . "/Models",
    "TailorTest\\Service" => __DIR__ . "/Service"
])->register();



$server = new ServiceComposer();

$server->addService(UserService::class)
    ->run();