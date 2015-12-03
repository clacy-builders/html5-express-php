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

class Html5GroupingContentTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(Html5::createSub()->p('content'), '<p>content</p>'),
				array(Html5::createSub()->p(), '<p></p>'),
				array(Html5::createSub()->hr(), '<hr>'),
				array(
						Html5::createSub()->pre("body {\n\tfont-family: tahoma;\n}"),
						"<pre>body {\n\tfont-family: tahoma;\n}</pre>"
				),
				array(Html5::createSub()->pre('content'), '<pre>content</pre>'),
				array(
						Html5::createSub()->blockquote('content'),
						'<blockquote>content</blockquote>'
				),
				array(
						Html5::createSub()->blockquote(null, 'http://...'),
						'<blockquote cite="http://...">'
				),
				array(Html5::createSub()->ol(), '<ol>'),
				array(
						Html5::createSub()->ol(Html5::TYPE_LOWER_ROMAN, 5, true),
						'<ol type="i" start="5" reversed>'
				),
				array(Html5::createSub()->ul(), '<ul>'),
				array(Html5::createSub()->li('content', 5), '<li value="5">content</li>'),
				array(
						Html5::createSub()->liItems(['lorem', 'ipsum', 'dolor']),
						'<li>lorem</li>
<li>ipsum</li>
<li>dolor</li>'
				),
				array(
						Html5::createSub()->liItems(['lorem', 'ipsum', 'dolor'], true),
						'<li value="0">lorem</li>
<li value="1">ipsum</li>
<li value="2">dolor</li>'
				),
				array(
						Html5::createSub()
								->liItems([2 => 'lorem', '1' => 'ipsum', 'foo' => 'dolor'], true),
						'<li value="2">lorem</li>
<li value="1">ipsum</li>
<li>dolor</li>'
				),
				array(Html5::createSub()->dl(), '<dl>'),
				array(Html5::createSub()->dt('content'), '<dt>content</dt>'),
				array(Html5::createSub()->dd('content'), '<dd>content</dd>'),
				array(Html5::createSub()->figure(), '<figure>'),
				array(
						Html5::createSub()->figcaption('content'),
						'<figcaption>content</figcaption>'
				),
				array(Html5::createSub()->main(), '<main>'),
				array(Html5::createSub()->div(), '<div></div>')
		);
	}
}
