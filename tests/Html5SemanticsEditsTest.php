<?php

namespace ClacyBuilders\Html5\Tests;

require_once 'vendor/clacy-builders/xml/allIncl.php';
require_once 'vendor/clacy-builders/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';

use ClacyBuilders\Tests\Express_TestCase;
use ClacyBuilders\Html5\Html5;

class Html5SemanticsEditsTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(
						Html5::createSub()->a('content', 'http://...'),
						'<a href="http://...">content</a>'
				),
				array(
						Html5::createSub()->a('content', 'http://...', Html5::TARGET_BLANK),
						'<a href="http://..." target="_blank">content</a>'
				),
				array(
						Html5::createSub()->a(
								'content', 'http://...', null, Html5::REL_ALTERNATE, null, 'en'),
						'<a href="http://..." rel="alternate" hreflang="en">content</a>'
				),
				array(
						Html5::createSub()->a(
								'content', '/download/1234.pdf', null,
								null, 'application/pdf', null, null,
								'my-document.pdf'),
						'<a href="/download/1234.pdf"' .
						' type="application/pdf"' .
						' download="my-document.pdf">content</a>'),
				array(
						Html5::createSub()->a('content', 'http://...',
								null, null, null, null, 'stats.php?id=125'),
						'<a href="http://..." ping="stats.php?id=125">content</a>'),
				array(
						Html5::createSub()->a('content', 'http://...', null, null, null, null,
								['stats.php?id=125', 'foo.php']),
						'<a href="http://..." ping="stats.php?id=125 foo.php">content</a>'),
				array(
						Html5::createSub()
								->a('Search', 'index.php')
								->addQuery(['s' => 'lorem ipsum', 'cat' => 'cats&dogs']),
						'<a href="index.php?s=lorem+ipsum&cat=cats%26dogs">Search</a>'
				),
				array(
						Html5::createSub()
								->a('Search', 'index.php')
								->addQuery(['s' => 'lorem ipsum', 'cat' => null]),
						'<a href="index.php?s=lorem+ipsum">Search</a>'
				),
				array(
						Html5::createSub()
								->a('Search', 'index.php?s=lorem+ipsum')
								->addQuery(['cat' => 'cats&dogs']),
						'<a href="index.php?s=lorem+ipsum&cat=cats%26dogs">Search</a>'
				),
				array(
						Html5::createSub()
								->a('Search', 'index.php#sticky')
								->addQuery(['cat' => 'cats&dogs']),
						'<a href="index.php?cat=cats%26dogs#sticky">Search</a>'
				),
				array(
						Html5::createSub()
								->a('Search', 'index.php?s=lorem+ipsum#sticky')
								->addQuery(['cat' => 'cats&dogs']),
						'<a href="index.php?s=lorem+ipsum&cat=cats%26dogs#sticky">Search</a>'
				),
				array(
						Html5::createSub()
								->audio('/uploads/2711')
								->addQuery(['mp3']),
						'<audio src="/uploads/2711?mp3"></audio>'
				),
				array(
						Html5::createSub()
								->a('Home', 'index.php')->setPing('stats.php')
								->addQuery(['id' => 123], 'ping'),
						'<a href="index.php" ping="stats.php?id=123">Home</a>'
				),
				array(Html5::createSub()->em('content'), '<em>content</em>'),
				array(Html5::createSub()->strong('content'), '<strong>content</strong>'),
				array(Html5::createSub()->small('content'), '<small>content</small>'),
				array(Html5::createSub()->s('content'), '<s>content</s>'),
				array(Html5::createSub()->cite('content'), '<cite>content</cite>'),
				array(
						Html5::createSub()->q('content', 'http://...'),
						'<q cite="http://...">content</q>'
				),
				array(
						Html5::createSub()->dfn('content', 'title'),
						'<dfn title="title">content</dfn>'
				),
				array(
						Html5::createSub()->abbr('CPU', 'Central Processing Unit'),
						'<abbr title="Central Processing Unit">CPU</abbr>'
				),
				array(Html5::createSub()->data('ten', 10), '<data value="10">ten</data>'),
				array(
						Html5::createSub()->time('1.6.2014', '2014-06-01'),
						'<time datetime="2014-06-01">1.6.2014</time>'
				),
				array(Html5::createSub()->code('append()'), '<code>append()</code>'),
				array(
						Html5::createSub()
								->codeblock("<div>\n\t<p>content</p>\n</div>", '  ')
								->getRoot(),
						"<pre><code>" .
						"&lt;div&gt;\n  &lt;p&gt;content" .
						"&lt;/p&gt;\n&lt;/div&gt;" .
						"</code></pre>"
				),
				array(
						Html5::createSub()
								->codeblock("<div>\n\t<p>content</p>\n</div>", null)
								->getRoot(),
						"<pre><code>" .
						"&lt;div&gt;\n\t&lt;p&gt;content" .
						"&lt;/p&gt;\n&lt;/div&gt;" .
						"</code></pre>"
				),
				array(
						Html5::createSub()
								->codeblock("<div>\n\t<p>content</p>\n</div>")
								->setClass('html')
								->getRoot(),
						"<pre><code class=\"html\">" .
						"&lt;div&gt;\n    &lt;p&gt;content" .
						"&lt;/p&gt;\n&lt;/div&gt;" .
						"</code></pre>"
				),
				array(Html5::createSub()->v('n'), '<var>n</var>'),
				array(Html5::createSub()->samp('content'), '<samp>content</samp>'),
				array(Html5::createSub()->kbd('F5'), '<kbd>F5</kbd>'),
				array(Html5::createSub()->sub(2), '<sub>2</sub>'),
				array(Html5::createSub()->sup(2), '<sup>2</sup>'),
				array(Html5::createSub()->i('content'), '<i>content</i>'),
				array(Html5::createSub()->b('content'), '<b>content</b>'),
				array(Html5::createSub()->u('content'), '<u>content</u>'),
				array(Html5::createSub()->mark('content'), '<mark>content</mark>'),
				array(Html5::createSub()->ruby('☘'), '<ruby>☘</ruby>'),
				array(Html5::createSub()->rt('Shamrock'), '<rt>Shamrock</rt>'),
				array(Html5::createSub()->rp(':'), '<rp>:</rp>'),
				array(
						Html5::createSub()->bdi('ottO', Html5::DIR_RTL),
						'<bdi dir="rtl">ottO</bdi>'
				),
				array(
						Html5::createSub()->bdo('ottO', Html5::DIR_RTL),
						'<bdo dir="rtl">ottO</bdo>'
				),
				array(Html5::createSub()->span('content'), '<span>content</span>'),
				array(Html5::createSub()->br(), '<br>'),
				array(Html5::createSub()->wbr(), '<wbr>'),

				array(
						Html5::createSub()->ins('content', '2014-06-01', '/edits/r123'),
						'<ins cite="/edits/r123" datetime="2014-06-01">content</ins>'
				),
				array(
						Html5::createSub()->del('content', '2014-06-01', '/edits/r123'),
						'<del cite="/edits/r123" datetime="2014-06-01">content</del>'
				)
		);
	}
}










