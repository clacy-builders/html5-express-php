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

`Adhoc` allows you to use any method name not previously defined to add XML elements or attributes.

    <?php
    require_once 'vendor/autoload.php';
    
    use \ML_Express\Html5;
    use \ML_Express\Adhoc;
    
    class Html extends Html5
    {
        use Adhoc;
    }
    
    $html = Html::createHtml();
    $body = $html->body();
    $body
            ->p('Lorem ' . Html::em('ipsum') . ' dolor' . Html::br());
    
    print $html->getMarkup();

This is the generated markup:

    <!DOCTYPE html>
    <html>
        <body>
            <p>Lorem <em>ipsum</em> dolor<br></p>
        </body>
    </html>