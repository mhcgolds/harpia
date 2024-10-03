<?php

require __DIR__ . '/../vendor/autoload.php';

$harpia = new \Mhcgolds\Harpia\Harpia();
$harpia
    ->addAlphaLowerCase()
    ->addAlphaUpperCase()
    ->addNumeric()
    ->addSpecialChars();

$validPassword = '@Password123';
$invalidPassword = 'myPassword';

$harpia->check($validPassword);
var_dump($harpia->getResult()); // Will print 'bool(true)'

$harpia->check($invalidPassword);
var_dump($harpia->getResult()); // Will print 'bool(false)'