# HTML5 Express PHP

## Installation

HTML5 Express for PHP requires PHP 5.4 or newer.

Add the following to your project's `composer.json` file:
```json
{
    "require": {
        "ml-express/html5": ">=0.2"
    }
}
```

Run `composer install` or `composer update`.

## Basic Usage

```php
<?php
require_once 'vendor/autoload.php';

use \ML_Express\HTML5\Html5;

$html = Html5::createHtml();
$body = $html->body();
$body->p('Lorem ipsum dolor');

print $html->getMarkup();
```

This is the generated markup:

```html
<!DOCTYPE html>
<html>
    <body>
        <p>Lorem ipsum dolor</p>
    </body>
</html>
```