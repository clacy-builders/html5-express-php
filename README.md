# ML Express

## Installation
### Prerequisites

ML Express for PHP requires PHP 5.4 or newer.

### Using Composer

Add the following to your project's `composer.json` file:

    {
        "require": {
            "ml-express/html5": "dev-master@dev"
        }
    }

Run `composer install` or `composer update`.

## Basic Usage

    <?php
    require_once 'vendor/autoload.php';
    
    use \ML_Express\HTML5\Html5;
    use \ML_Express\Adhoc;
    
    $html = Html5::createHtml();
    $body = $html->body();
    $body->p('Lorem ipsum dolor');
    
    print $html->getMarkup();

This is the generated markup:

    <!DOCTYPE html>
    <html>
        <body>
            <p>Lorem ipsum dolor</p>
        </body>
    </html>