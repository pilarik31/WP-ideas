<?php
require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
use PilaLib\Classes\Utilities;

$utils = new Utilities();

$euroValue = $utils->getEurToCzk();
var_dump($euroValue);
echo $euroValue;

echo PHP_EOL . PHP_EOL;

$multipleEuroValue = $utils->getEurToCzk(10);
var_dump($multipleEuroValue);
echo $multipleEuroValue;
