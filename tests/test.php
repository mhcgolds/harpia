<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) > 2) {
    $password = $argv[1];

    $harpia = new \Mhcgolds\Harpia\Harpia();

    foreach ($argv as $index => $param) {
        if ($index > 1) {
            if ($param === '-alpha_lower') {
                $harpia->addAlphaLowerCase();
            }
            else if ($param === '-alpha_upper') {
                $harpia->addAlphaUpperCase();
            }
            else if ($param === '-alpha_all') {
                $harpia->addAlphaAll();
            }
            else if ($param === '-numeric') {
                $harpia->addNumeric();
            }
            else if ($param === '-special') {
                $harpia->addSpecialChars();
            }
            else {
                throw new Exception("Param \"$param\" was not recognized. Params available are: -alpha_lower, -alpha_upper, -alpha_all, -numeric or -special.");
            }
        }
    }

    $result = $harpia->check($password);

    if ($harpia->getResult()) {
        echo "Password \"$password\" check succeed. Strength points: " . $result->strengthPoints;
    }
    else {
        echo "Password \"$password\" check failed. Segments failed: " . implode(', ', $result->unmatchedSegments);
    }
}
else {
    echo 'Harpia test command. Usage example: test.php myPassword -alpha_all -numeric 
Provide your password as first argument. The next arguments are the type of checking you wanna test. You should provide at least one argument. They can be:
 -alpha_lower = Alpha characters in lower case 
 -alpha_upper = Alpha characters in upper case
 -alpha_all = Alpha characters in lower or upper case
 -numeric = Numeric characters
 -special = Special characters';
}

?>
