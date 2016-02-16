<?php

namespace ML_Express\HTML5\Tests;

require_once 'vendor/ml-express/xml/allIncl.php';
require_once 'vendor/ml-express/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';

use ML_Express\Tests\Express_TestCase;
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

	const expectedOptions = '<select name="choice">
	<option value="cpp" disabled>C++</option>
	<option value="php" selected>PHP</option>
	<option value="python">Python</option>
</select>';

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
						Html5::createSub()->label('User', 'user', 'login'),
						'<label for="user" form="login">User</label>'
				),

				// hidden()
				array(
						Html5::createSub()->hidden('category', 'Cats', 'search'),
						'<input type="hidden" name="category" value="Cats" form="search">'
				),

				// hiddens()
				array(
						Html5::createSub()->hiddens(
								null, ['cat' => 'Cats', 'items-per-page' => 5], 'search'),
						'<input type="hidden" name="cat" value="Cats"' .
						' form="search">' . "\n" .
						'<input type="hidden" name="items-per-page" value="5"' .
						' form="search">'
				),
				array(
						Html5::createSub()->hiddens(array(
								array('cat', 'Cats'),
								array('per-page', 5)
						)),
						'<input type="hidden" name="cat" value="Cats">' . "\n" .
						'<input type="hidden" name="per-page" value="5">'),

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
				array(
						Html5::createSub()->append('fieldset')->checkboxes(
								'choice[]', null,
								array(
										'cpp' => 'C++',
										'php' => 'PHP',
										'python' => 'Python'),
								array('php', 'python'), true, 'cpp', true),
						self::expectedCheckboxes
				),
				array(
						Html5::createSub()->append('fieldset')->checkboxes(
								'choice[]',
								array(
										(object) array(
												'val' => 'cpp',
												'label' => 'C++'),
										array(
												'val' => 'php',
												'label' => 'PHP'),
										array(
												'val' => 'python',
												'label' => 'Python')),
								null,
								array('php', 'python'), true, 'cpp', true),
						self::expectedCheckboxes
				),
				array(
						Html5::createSub()->append('fieldset')->checkboxes(
								'choice[]',
								array(
										array(1, 'cpp', 'C++'),
										array(2, 'php', 'PHP'),
										array(3, 'python', 'Python')),
								array(1, 2),
								array('php', 'python'), true, 'cpp', true),
						self::expectedCheckboxes
				),
				array(
						Html5::createSub()->append('fieldset')->checkboxes(
								'choice[]', null,
								array(
										'cpp' => 'C++',
										'php' => 'PHP',
										'python' => 'Python'),
								null, null, true, true),
						str_replace(
								array(' checked', ' required', '">'),
								array('', '', '" disabled>'),
								self::expectedCheckboxes)
				),

				// radios()
				array(
						Html5::createSub()->append('fieldset')->radios(
								'choice',
								array('cpp', 'php', 'python'),
								array('C++', 'PHP', 'Python'),
								'php', true, 'cpp', true),
						str_replace(
								array('checkbox', '[]', 'python" checked'),
								array('radio', '', 'python"'),
								self::expectedCheckboxes)
				),

				// file()
				array(
						Html5::createSub()->file(
								'upload', array(HTML5::ACCEPT_IMAGE, '.webm'),
								true, true, true, true, 'form-2'),
						'<input type="file" name="upload" accept="image/*,.webm"' .
						' multiple autofocus required disabled form="form-2">'
				),

				// submit()
				array(
						Html5::createSub()->submit(
								'OK', 'ok', true, true, 'index.php',
								HTML5::METHOD_GET, HTML5::ENCTYPE_APPLICATION,
								true, HTML5::TARGET_PARENT, 'form-2'),
						'<input type="submit" name="ok" value="OK"' .
						' formaction="index.php" formmethod="get"' .
						' formenctype="application/x-www-form-urlencoded"' .
						' formnovalidate formtarget="_parent" autofocus' .
						' disabled form="form-2">'
				),

				// image()
				array(
						Html5::createSub()->image(
								'button.png', 'OK', 80, 60, 'ok', true, true,
								'index.php', HTML5::METHOD_GET,
								HTML5::ENCTYPE_APPLICATION, true,
								HTML5::TARGET_PARENT, 'form-2'),
						'<input type="submit" name="ok" src="button.png" alt="OK"' .
						' width="80" height="60" formaction="index.php"' .
						' formmethod="get"' .
						' formenctype="application/x-www-form-urlencoded"' .
						' formnovalidate formtarget="_parent" autofocus' .
						' disabled form="form-2">'
				),

				// reset()
				array(
						Html5::createSub()->reset(
								'Reset', 'reset', true, true, 'form-2'),
						'<input type="reset" name="reset" value="Reset"' .
						' autofocus disabled form="form-2">'
				),

				// inpButton()
				array(
						Html5::createSub()->inpButton(
								'Button', 'button', true, true, 'form-2'),
						'<input type="button" name="button" value="Button"' .
						' autofocus disabled form="form-2">'
				),

				// select()
				array(
						Html5::createSub()->select(
								'choice', true, HTML5::AUTOCOMPLETE_ON, true,
								true, 5, true, 'form-2'),
						'<select name="choice[]" multiple autocomplete="on" size="5"' .
						' autofocus required disabled form="form-2"></select>'
				),

				// option()
				array(
						Html5::createSub()->option('PHP', 'php', true, true),
						'<option value="php" selected disabled>PHP</option>'
				),
				array(
						Html5::createSub()->option('PHP', 'php', true, true, true),
						'<option label="PHP" value="php" selected disabled>'
				),

				// options()
				array(
						Html5::createSub()->select('choice')->options(
								array('cpp', 'php', 'python'),
								array('C++', 'PHP', 'Python'),
								'php', 'cpp'),
						self::expectedOptions
				),
				array(
						Html5::createSub()->select('choice')->options(
								array(
										array('v' => 'cpp', 'l' => 'C++'),
										array('v' => 'php', 'l' => 'PHP'),
										array('v' => 'python', 'l' => 'Python')
								),
								null, array('php'), 'cpp'),
						self::expectedOptions
				),

				// textarea()
				array(
						Html5::createSub()->textarea('Lorem ipsum dolor',
								'suggestions', 40, 10, Html5::WRAP_HARD,
								'Your suggestions', 5, 140, true, true, true, true, true,
								'suggestions.dir', Html5::INPUTMODE_LATIN_PROSE,
								'form-2'),
						'<textarea name="suggestions" cols="40" rows="10" wrap="hard"' .
						' placeholder="Your suggestions" minlength="5" maxlength="140" required' .
						' autocomplete="on" readonly disabled autofocus' .
						' dirname="suggestions.dir" inputmode="latin-prose" form="form-2">' .
						'Lorem ipsum dolor</textarea>'
				),

				// fieldset()
				array(
						Html5::createSub()
								->fieldset('programming-languages', true, 'foo')
								->label('Programming languages'),
						'<fieldset name="programming-languages" disabled form="foo">' .
						"\n\t<label>Programming languages</label>\n</fieldset>"
				),
		);
	}
}