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
				array(Html5::c_()->p('content'), '<p>content</p>'),
				array(Html5::c_()->p(), '<p></p>'),
				array(Html5::c_()->hr(), '<hr>'),
				array(
						Html5::c_()->pre("body {\n\tfont-family: tahoma;\n}"),
						"<pre>body {\n\tfont-family: tahoma;\n}</pre>"
				),
				array(Html5::c_()->pre('content'), '<pre>content</pre>'),
				array(
						Html5::c_()->div()->div()->pre('the quick brown fox
jumps over the lazy dog.'), '<div>
	<div>
		<pre>the quick brown fox
jumps over the lazy dog.</pre>
	</div>
</div>'
				),
				array(
						Html5::c_()->blockquote('content'),
						'<blockquote>content</blockquote>'
				),
				array(
						Html5::c_()->blockquote(null, 'http://...'),
						'<blockquote cite="http://...">'
				),
				array(Html5::c_()->ol(), '<ol>'),
				array(
						Html5::c_()->ol(Html5::TYPE_LOWER_ROMAN, 5, true),
						'<ol type="i" start="5" reversed>'
				),
				array(Html5::c_()->ul(), '<ul>'),
				array(Html5::c_()->li('content', 5), '<li value="5">content</li>'),
				array(Html5::c_()->dl(), '<dl>'),
				array(Html5::c_()->dt('content'), '<dt>content</dt>'),
				array(Html5::c_()->dd('content'), '<dd>content</dd>'),
				array(Html5::c_()->figure(), '<figure>'),
				array(Html5::c_()->figcaption('content'), '<figcaption>content</figcaption>'),
				array(Html5::c_()->main(), '<main>'),
				array(Html5::c_()->div(), '<div></div>')
		);
	}
}
