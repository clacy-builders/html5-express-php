<?php

namespace ML_Express\HTML5\Tests;

require_once 'vendor/ml-express/xml/src/Xml.php';
require_once 'vendor/ml-express/xml/src/XmlAttributes.php';
require_once 'vendor/ml-express/xml/src/functions.php';
require_once 'vendor/ml-express/xml/src/shared/ClassAttribute.php';
require_once 'vendor/ml-express/xml/src/shared/StyleAttribute.php';
require_once 'vendor/ml-express/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';
require_once 'src/H5.php';

use ML_Express\Tests\Express_TestCase;
use ML_Express\HTML5\Html5;
use ML_Express\HTML5\H5;

class H5Test extends Express_TestCase
{
	public function provider()
	{
		$cnt = 'content';
		return array(
				array(
						H5::a('a', 'b', 'c', 'd', 'e', 'f', 'g'),
						Html5::createSub()->a('a', 'b', 'c', 'd', 'e', 'f', 'g')->getMarkup()
				),
				array(H5::em($cnt), Html5::createSub()->em($cnt)->getMarkup()),
				array(H5::strong($cnt), Html5::createSub()->strong($cnt)->getMarkup()),
				array(H5::small($cnt), Html5::createSub()->small($cnt)->getMarkup()),
				array(H5::s($cnt), Html5::createSub()->s($cnt)->getMarkup()),
				array(H5::cite($cnt), Html5::createSub()->cite($cnt)->getMarkup()),
				array(
						H5::q($cnt, 'http://...'),
						Html5::createSub()->q($cnt, 'http://...')->getMarkup()
				),
				array(H5::dfn($cnt, 'title'), Html5::createSub()->dfn($cnt, 'title')->getMarkup()),
				array(
						H5::abbr('CPU', 'Central Processing Unit'),
						Html5::createSub()->abbr('CPU', 'Central Processing Unit')->getMarkup()
				),
				array(H5::data('ten', 10), Html5::createSub()->data('ten', 10)->getMarkup()),
				array(
						H5::time('1.6.2014', '2014-06-01'),
						Html5::createSub()->time('1.6.2014', '2014-06-01')->getMarkup()
				),
				array(H5::code($cnt), Html5::createSub()->code($cnt)->getMarkup()),
				array(H5::v('n'), Html5::createSub()->v('n')->getMarkup()),
				array(H5::samp($cnt), Html5::createSub()->samp($cnt)->getMarkup()),
				array(H5::kbd('F5'), Html5::createSub()->kbd('F5')->getMarkup()),
				array(H5::sub(2), Html5::createSub()->sub(2)->getMarkup()),
				array(H5::sup(2), Html5::createSub()->sup(2)->getMarkup()),
				array(H5::i($cnt), Html5::createSub()->i($cnt)->getMarkup()),
				array(H5::b($cnt), Html5::createSub()->b($cnt)->getMarkup()),
				array(H5::u($cnt), Html5::createSub()->u($cnt)->getMarkup()),
				array(H5::mark($cnt), Html5::createSub()->mark($cnt)->getMarkup()),
				array(H5::ruby('☘'), Html5::createSub()->ruby('☘')->getMarkup()),
				array(H5::rt('Shamrock'), Html5::createSub()->rt('Shamrock')->getMarkup()),
				array(H5::rp(':'), Html5::createSub()->rp(':')->getMarkup()),
				array(
						H5::bdi('ottO', Html5::DIR_RTL),
						Html5::createSub()->bdi('ottO', Html5::DIR_RTL)->getMarkup()
				),
				array(
						H5::bdo('ottO', Html5::DIR_RTL),
						Html5::createSub()->bdo('ottO', Html5::DIR_RTL)->getMarkup()
				),
				array(H5::span($cnt), Html5::createSub()->span($cnt)->getMarkup()),
				array(H5::br(), Html5::createSub()->br()->getMarkup()),
				array(H5::wbr(), Html5::createSub()->wbr()->getMarkup()),
				array(
						H5::ins($cnt, '2014-06-01', '/edits/r123'),
						Html5::createSub()->ins($cnt, '2014-06-01', '/edits/r123')->getMarkup()
				),
				array(
						H5::del($cnt, '2014-06-01', '/edits/r123'),
						Html5::createSub()->del($cnt, '2014-06-01', '/edits/r123')->getMarkup()
				)
		);
	}
}

