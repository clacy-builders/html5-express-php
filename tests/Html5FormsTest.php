<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5FormsTest extends Express_TestCase
{
	const expectedCheckboxes = '<fieldset>
	<label>
		<input type="checkbox" name="choice[]" value="cpp" autofocus required disabled>
		<span>C++</span>
	</label>
	<label>
		<input type="checkbox" name="choice[]" value="php" checked>
		<span>PHP</span>
	</label>
	<label>
		<input type="checkbox" name="choice[]" value="python" checked>
		<span>Python</span>
	</label>
</fieldset>';

	public function provider()
	{
		return array(
				// form()
				array(
						Html5::createSub()->form(
								'feedback.php', HTML5::METHOD_POST, HTML5::ENCTYPE_MULTIPART,
								'ISO-8859-1', HTML5::AUTOCOMPLETE_ON, true, HTML5::TARGET_TOP,
								'feedback-form'),
						'<form action="feedback.php" target="_top"' .
						' method="post" enctype="multipart/form-data"' .
						' accept-charset="ISO-8859-1" autocomplete="on"' .
						' novalidate name="feedback-form"></form>'
				),

				// label()
				array(
						Html5::createSub()->label('Your name', 'name'),
						'<label for="name">Your name</label>',
				),

				// text()
				array(
						Html5::createSub()->text(
								'name', 'M. E. Lee', 'Name', 20, 3, 120,
								'pattern', true, 'name-list', 'off',
								true, true, true),
						'<input type="text" name="name" value="M. E. Lee"' .
						' placeholder="Name" size="20" minlength="3"' .
						' maxlength="120" pattern="pattern" required' .
						' list="name-list" autocomplete="off" readonly' .
						' disabled autofocus>'
				),

				// checkbox()
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked(),
						'<input type="checkbox" name="choice[]" value="php" checked>'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked(array('php', 'java')),
						'<input type="checkbox" name="choice[]" value="php" checked>'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked('php'),
						'<input type="checkbox" name="choice[]" value="php" checked>'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked(false),
						'<input type="checkbox" name="choice[]" value="php">'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked(array('python', 'java')),
						'<input type="checkbox" name="choice[]" value="php">'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setChecked('python'),
						'<input type="checkbox" name="choice[]" value="php">'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]')
								->setRequired(),
						'<input type="checkbox" name="choice[]" required>'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]')
								->setDisabled(),
						'<input type="checkbox" name="choice[]" disabled>'
				),
				array(
						Html5::createSub()
								->checkbox('choice[]', 'php')
								->setDisabled(array('php', 'python')),
						'<input type="checkbox" name="choice[]" value="php" disabled>'
				),
				array(
						Html5::createSub()->checkbox('choice[]', 'php', array('php', 'python'),
								true, true, true, 'f1'),
						'<input type="checkbox" name="choice[]" value="php"' .
						' checked autofocus required disabled form="f1">'
				),

				// radio()
				array(
						Html5::createSub()->radio('choice[]', 'php', true, true, true,
								true, 'f1'),
						'<input type="radio" name="choice[]" value="php"' .
						' checked autofocus required disabled form="f1">'
				),

				// checkboxes()
				array(
						Html5::createSub()->append('fieldset')->checkboxes(
								'choice',
								array('cpp', 'php', 'python'),
								array('C++', 'PHP', 'Python'),
								array('php', 'python'), true, 'cpp', true),
						self::expectedCheckboxes
				),
		);
	}
}