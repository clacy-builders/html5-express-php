<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

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
						'<e accept=".png">'
				),
				array(
						Html5::createSub('e')->setAccept('.jpg')->setAccept(['.png'], true),
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
						'<e accept-charset="ISO-8859-15">'
				),
				array(
						Html5::createSub('e')
								->setAccept_charset('ISO-8859-1')
								->setAccept_charset(['ISO-8859-15'], true),
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
						Html5::createSub('e')->setData('user', 'M. E. Lee'),
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