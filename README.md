# get-keyframes
<p align="left">
<a href='https://opensource.org/licenses/MIT'><img src='https://img.shields.io/badge/License-MIT-green.svg' alt='LICENSE MIT' /></a>
<a href='OJDDEV.md'><img src="https://img.shields.io/badge/OJD-mozartk-green.svg" alt="OJD" title="WE ARE OJD"></a>
</p>
  
Now you can easily get the keyframes from videofiles with php.  

## Installation
Run the composer command 
```cmd
composer require mozartk/get-keyframes
```

getKeyframes can be installed with Composer by adding the library as a dependency to your composer.json file.
```json
{
    "require": {
        "mozartk/get-keyframes": "~1.0"
    }
}
```
  
## Basic Usage
### How to run
```php
// Include your autoload 
require_once 'vendor/autoload.php';

use mozartk\GetKeyFrames\GetKeyFrames;

$info = new GetKeyFrames(); // Initialize your library
$data = $info->getVideoInfo("./samples.mkv"); //load videofiles

print_r($data); //print keyframes result
```
### Result
```php
Array
(
    [frame] => Array
        (
            [0] => 0
            [1] => 1
            [2] => 4
            [3] => 8
            [4] => 250
            [5] => 338
            [6] => 588
            [7] => 838
            [8] => 1088
        )

    [time] => Array
        (
            [0] => 0.000000
            [1] => 0.017000
            [2] => 0.067000
            [3] => 0.133000
            [4] => 4.160000
            [5] => 5.624000
            [6] => 9.784000
            [7] => 13.944000
            [8] => 18.104000
        )

)
```

#### If you need to work with large size files
Add the following at the start of your script
```php
ini_set('max_execution_time', -1);
```

## License
Made by mozartk.  
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
