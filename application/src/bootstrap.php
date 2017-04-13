<?php

namespace TailorTest;


use Phalcon\Loader;
use TailorTest\Base\ServiceComposer;

$loader = new Loader();
$loader->registerNamespaces([
    "TailorTest\\" => __DIR__,
    "TailorTest\\Base" => __DIR__ . DIRECTORY_SEPARATOR . "Base",
    "TailorTest\\Base\\Exception" => __DIR__ . DIRECTORY_SEPARATOR . "Base" . DIRECTORY_SEPARATOR . "Exception",
    "TailorTest\\Models" => __DIR__ . DIRECTORY_SEPARATOR . "Models"
])->register();



$server = new ServiceComposer();