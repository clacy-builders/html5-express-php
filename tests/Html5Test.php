<?php

namespace ClacyBuilders\Html5\Tests;

require_once 'vendor/clacy-builders/xml/allIncl.php';
require_once 'vendor/clacy-builders/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';
require_once 'src/XHtml5.php';

use ClacyBuilders\Tests\Express_TestCase;
use ClacyBuilders\Html5\Html5;
use ClacyBuilders\Html5\XHtml5;

class Html5Test extends Express_TestCase
{
	public function provider()
	{
		return array(
				// createHtml()
				array(Html5::createHtml(), "<!DOCTYPE html>\n<html></html>"),
				array(Html5::createHtml('en'), "<!DOCTYPE html>\n<html lang=\"en\"></html>"),
				array(
						Html5::createHtml(null, 'app.manifest'),
						"<!DOCTYPE html>\n<html manifest=\"app.manifest\"></html>"
				),
				array(
						XHtml5::createHtml('en'),
						self::XML_DECL . "\n<!DOCTYPE html>\n<html xmlns=\"" .
						XHtml5::XML_NAMESPACE . "\" xml:lang=\"en\"/>"
				)
		);
	}
}