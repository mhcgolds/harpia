Harpia is a simple password pattern check named after the biggest eagle that lives in south america, the Harpy eagle.

It comes with default patters to check if password has alphanumeric or special characters.

Usage:

```php
$harpia = new \Mhcgolds\Harpia\Harpia();
$harpia
    ->addAlphaLowerCase() // Regex: [a-z]
    ->addAlphaUpperCase() // Regex: [A-Z]
    ->addNumeric() // Regex: [0-9]
    ->addSpecialChars(); // Regex: [@#!$&_\.]
    
$validPassword = '@Password123';
$invalidPassword = 'myPassword';

$harpia->check($validPassword);
var_dump($harpia->getResult()); // Prints 'bool(true)'

$harpia->check($invalidPassword);
var_dump($harpia->getResult()); // Prints 'bool(false)'
```

In the example above, Harpia was set to check if there is at least one alpha char in lowercase, on alpha char in lowercase, one numeric char and one special char. 
If any of those wasn't match, the result will be false. The complete regex used in example above will be `/([a-z]+)|([A-Z]+)|([0-9]+)|([@#!$&_\.]+)/` which is tested with `preg_match_all`.

It calculates the strength of the password by adding 1 point(by default) for each passed test. In the example above, a valid password would have strength of 4 points.

You can also add a custom regex segment with a custom strength point if you like:

```php
$harpia = new \Mhcgolds\Harpia\Harpia();
$harpia
    ->addAlphaAll()
    ->addCustomPattern('\d', 2);
```

The complete regex used in example above will be `/([a-zA-Z+])|([\d+])/` being the custom regex of strength 2. A valid password would have strength of 3 points, 1 for `addAlphaAll` and 2 for the custom added.