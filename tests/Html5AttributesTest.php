<?php

namespace ClacyBuilders\Html5\Tests;

require_once 'vendor/clacy-builders/xml/allIncl.php';
require_once 'vendor/clacy-builders/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';

use ClacyBuilders\Tests\Express_TestCase;
use ClacyBuilders\Html5\Html5;

class Html5AttributesTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				// setAccept()
				array(
						Html5::createSub('e')->setAccept(Html5::ACCEPT_AUDIO),
						'<e accept="audio/*">'
				),
				array(
						Html5::createSub('e')->setAccept(['.jpg', '.png', '.gif']),
						'<e accept=".jpg,.png,.gif">'
				),
				array(
						Html5::createSub('e')->setAccept('.jpg')->setAccept(['.png']),
						'<e accept=".jpg,.png">'
				),
				// setAccept_charset()
				array(
						Html5::createSub('e')->setAccept_charset('ISO-8859-15'),
						'<e accept-charset="ISO-8859-15">'
				),
				array(
						Html5::createSub('e')->setAccept_charset(['ISO-8859-1', 'ISO-8859-15']),
						'<e accept-charset="ISO-8859-1 ISO-8859-15">'
				),
				array(
						Html5::createSub('e')
								->setAccept_charset('ISO-8859-1')
								->setAccept_charset(['ISO-8859-15']),
						'<e accept-charset="ISO-8859-1 ISO-8859-15">'
				),

				// setAutocomplete()
				array(
						Html5::createSub('e')->setAutocomplete(),
						'<e autocomplete="on">'
				),
				array(
						Html5::createSub('e')->setAutocomplete(HTML5::AUTOCOMPLETE_OFF),
						'<e autocomplete="off">'
				),
				array(
						Html5::createSub('e')->setAutocomplete(false),
						'<e autocomplete="off">'
				),
				array(
						Html5::createSub('e')->setAutocomplete(true),
						'<e autocomplete="on">'
				),

				// setAutofocus()
				array(Html5::createSub('e')->setAutofocus(), '<e autofocus>'),
				array(Html5::createSub('e')->setAutofocus(false), '<e>'),

				// setChecked()
				array(Html5::createSub('e')->setValue(0)->setChecked(0), '<e value="0" checked>'),
				array(Html5::createSub('e')->setValue(0)->setChecked(1), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setChecked(0), '<e value="1">'),
				array(Html5::createSub('e')->setValue(0)->setChecked(false), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setChecked([0, 2]), '<e value="1">'),
				array(
						Html5::createSub('e')->setValue(1)->setChecked([0, 1]),
						'<e value="1" checked>'
				),

				// setData()
				array(Html5::createSub('e')->setData('demo.swf'), '<e data="demo.swf">'),
				array(
						Html5::createSub('e')->setData('M. E. Lee', 'user'),
						'<e data-user="M. E. Lee">'
				),

				// setDirname()
				array(
						Html5::createSub('e')->setDirname('comment.dir'),
						'<e dirname="comment.dir">'
				),

				// setDisabled()
				array(
						Html5::createSub('e')->setValue(0)->setDisabled(0),
						'<e value="0" disabled>'
				),
				array(Html5::createSub('e')->setValue(0)->setDisabled(1), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setDisabled(0), '<e value="1">'),
				array(Html5::createSub('e')->setValue(0)->setDisabled(false), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setDisabled([0, 2]), '<e value="1">'),
				array(
						Html5::createSub('e')->setValue(1)->setDisabled([0, 1]),
						'<e value="1" disabled>'
				),

				// setEnctype()
				array(
						Html5::createSub('e')->setEnctype(),
						'<e enctype="multipart/form-data">'
				),
				array(
						Html5::createSub('e')->setEnctype(Html5::ENCTYPE_TEXT),
						'<e enctype="text/plain">'
				),

				// setHeaders()
				array(
						Html5::c_('e')->setHeaders(['r1', 'r2'])->setHeaders('r3'),
						'<e headers="r1 r2 r3">'
				),

				// setMedia()
				array(
						Html5::c_('e')
								->setMedia([Html5::MEDIA_SCREEN, Html5::MEDIA_PRINT])
								->setMedia(Html5::MEDIA_TV),
						'<e media="screen,print,tv">'
				),

				// setRel()
				array(
						Html5::createSub('e')->setRel([
								Html5::REL_AUTHOR, Html5::REL_NOFOLLOW, Html5::REL_AUTHOR]),
						'<e rel="author nofollow">'
				),

				// setSandbox()
				array(
						Html5::c_('e')
								->setSandbox([Html5::SANDBOX_SAME_ORIGIN, Html5::SANDBOX_FORMS])
								->setSandbox(Html5::SANDBOX_SCRIPTS),
						'<e sandbox="allow-same-origin allow-forms allow-scripts">'
				),

				// setSelected()
				array(Html5::createSub('e')->setValue(0)->setSelected(0), '<e value="0" selected>'),
				array(Html5::createSub('e')->setValue(0)->setSelected(1), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setSelected(0), '<e value="1">'),
				array(Html5::createSub('e')->setValue(0)->setSelected(false), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1)->setSelected([0, 2]), '<e value="1">'),
				array(
						Html5::createSub('e')->setValue(1)->setSelected([0, 1]),
						'<e value="1" selected>'
				),

				// setValue()
				array(Html5::createSub('e')->setValue(0), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1), '<e value="1">'),
				array(Html5::createSub('e')->setValue('foo'), '<e value="foo">'),
		);
	}
}