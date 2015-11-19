# HTML5 Express PHP

## Installation

HTML5 Express for PHP requires PHP 5.4 or newer.

Add the following to your project's `composer.json` file:
```json
{
    "require": {
        "ml-express/html5": ">=0.4"
    }
}
```

Run `composer install` or `composer update`.

## Basic Usage

An Example:
```php
<?php
require_once 'vendor/autoload.php';

use ML_Express\HTML5\Html5;

$dbRows = array(
        array('id' => 42, 'name' => 'Foo', 'town' => 'Berlin', 'amount' => 20),
        array('id' => 43, 'name' => 'Foo', 'town' => 'Berlin', 'amount' => 12),
        array('id' => 50, 'name' => 'Foo', 'town' => 'Cologne', 'amount' => 12),
        array('id' => 51, 'name' => 'Bar', 'town' => 'Cologne', 'amount' => 12),
        array('id' => 68, 'name' => 'Bar', 'town' => 'Hamburg', 'amount' => 15),
        array('id' => 69, 'name' => 'Bar', 'town' => 'Hamburg', 'amount' => 15)
);

$bgColor = '0, 51, 102';

$html = Html5::createHtml();
$head = $html->head();
$head->style("body, * {
    font-family: open sans, tahoma, verdana, sans-serif;
}
td, th {
    text-align: left;
    vertical-align: text-top;
    padding: 0.5em;
}
td:last-child {
    text-align: right;
}
th {
    color: white;
    background-color: rgba($bgColor, 1);
    font-weight: normal;
}
tr {
    background-color: rgba($bgColor, 0.2);
}
tr.every-2nd {
    background-color: rgba($bgColor, 0.4);
}
table {
    border-width: 0;
    border-spacing: 0;
}");

$body = $html->body();
$table = $body->table();
$table->thead()->trow(['name', 'town', 'amount'], null, true);
$table->tbody()
        ->trows($dbRows, ['name', 'town', 'amount'])
        ->stripes([null, 'every-2nd'], 0)
        ->rowspans();
print $html->getMarkup();

```

The generated markup:
```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body, * {
                font-family: open sans, tahoma, verdana, sans-serif;
            }
            td, th {
                text-align: left;
                vertical-align: text-top;
                padding: 0.5em;
            }
            td:last-child {
                text-align: right;
            }
            th {
                color: white;
                background-color: rgba(0, 51, 102, 1);
                font-weight: normal;
            }
            tr {
                background-color: rgba(0, 51, 102, 0.2);
            }
            tr.every-2nd {
                background-color: rgba(0, 51, 102, 0.4);
            }
            table {
                border-width: 0;
                border-spacing: 0;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>town</th>
                    <th>amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="3">Foo</td>
                    <td rowspan="2">Berlin</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Cologne</td>
                    <td>12</td>
                </tr>
                <tr class="every-2nd">
                    <td rowspan="3">Bar</td>
                    <td>Cologne</td>
                    <td>12</td>
                </tr>
                <tr class="every-2nd">
                    <td rowspan="2">Hamburg</td>
                    <td>15</td>
                </tr>
                <tr class="every-2nd">
                    <td>15</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
```
