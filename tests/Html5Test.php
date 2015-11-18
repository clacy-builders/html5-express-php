<?php

namespace ML_Express\HTML5\Tests;

require_once 'vendor/ml-express/xml/src/Xml.php';
require_once 'vendor/ml-express/xml/src/XmlAttributes.php';
require_once 'vendor/ml-express/xml/src/functions.php';
require_once 'vendor/ml-express/xml/src/shared/ClassAttribute.php';
require_once 'vendor/ml-express/xml/src/shared/StyleAttribute.php';
require_once 'vendor/ml-express/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';

use ML_Express\Tests\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5Test extends Express_TestCase
{
	public function provider()
	{
		return array(
				// createHtml()
				array(Html5::createHtml(), "<!DOCTYPE html>\n<html>"),
				array(Html5::createHtml('en'), "<!DOCTYPE html>\n<html lang=\"en\">"),
				array(
						Html5::createHtml(null, 'app.manifest'),
						"<!DOCTYPE html>\n<html manifest=\"app.manifest\">"
				)
		);
	}
}