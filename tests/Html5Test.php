<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5Test extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(Html5::createHtml(), "<!DOCTYPE html>\n<html>"),

				// setValue()
				array(Html5::createSub('e')->setValue(0), '<e value="0">'),
				array(Html5::createSub('e')->setValue(1), '<e value="1">'),
				array(Html5::createSub('e')->setValue('foo'), '<e value="foo">'),

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

				// setMultiple()
				array(Html5::createSub('e')->setMultiple(), '<e multiple>'),
				array(Html5::createSub('e')->setMultiple(false), '<e>'),

				// setName()
				array(Html5::createSub('e')->setName('php'), '<e name="php">'),

				// setReadonly()
				array(Html5::createSub('e')->setReadonly(), '<e readonly>'),
				array(Html5::createSub('e')->setReadonly(false), '<e>'),

				// setRequired
				array(Html5::createSub('e')->setRequired(), '<e required>'),
				array(Html5::createSub('e')->setRequired(false), '<e>'),

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

				// setSize()
				array(Html5::createSub('e')->setSize(20), '<e size="20">')
		);
	}
}