<?php

namespace ML_Express\HTML5;

use ML_Express\Xml;

class Html5 extends Xml
{
	const MIME_TYPE = 'text/html';
	const FILENAME_EXTENSION = 'html';
	const XML_DECLARATION = false;
	const DOCTYPE = '<!DOCTYPE html>';
	const SGML_MODE = true;
	const ROOT_ELEMENT = 'html';

	/**
	 * Creates html element.
	 *
	 * @param     string    $lang        The document's language.
	 * @param     string    $manifest    Application cache manifest.
	 * @return    Html5
	 */
	public static function createHTML($lang = null, $manifest = null)
	{
		$class = get_called_class();
		return (new $class('html'))
				->attrib('lang', $lang)
				->attrib('manifest', $manifest);
	}

	//////// Forms ////////

	/**
	 * <code>&lt;form></code>
	 *
	 * @param    string|null            $action            URL to use for form submission.
	 * @param    string|null            $method            See <code>setMethod()</code>
	 * @param    string|null            $enctype           See <code>setEnctype()</code>
	 * @param    string|array|null      $accept_charset    See <code>setAccept_charset()</code>
	 * @param    string|boolean|null    $autocomplete      See <code>setAutocomplete()</code>
	 * @param    boolean                $novalidate        See <code>setNovalidate()</code>
	 * @param    string|null            $target            See <code>setTarget()</code>
	 * @param    string|null            $name              See <code>setName()</code>
	 */
	public function form(
			$action = null, $method = null, $enctype = null,
			$accept_charset = null, $autocomplete = null, $novalidate = false,
			$target = null, $name = null)
	{
		return $this
				->append('form', '')
				->attrib('action', $action)
				->setTarget($target)
				->setMethod($method)
				->setEnctype($enctype)
				->setAccept_charset($accept_charset)
				->setAutocomplete($autocomplete)
				->setNovalidate($novalidate)
				->setName($name);
	}

	/**
	 * <code>&lt;label></code>
	 *
	 * @param    string         $content
	 * @param    string|null    $for        See setFor()
	 * @param    string|null    $form       See setForm()
	 */
	public function label($content = '', $for = null, $form = null)
	{
		return $this
				->append('label', $content)
				->setFor($for)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="text"></code>
	 *
	 * @param    string|null    $name            See setName()
	 * @param    mixed|null     $value           See setValue()
	 * @param    string|null    $placeholder     See setPlaceholder()
	 * @param    int|null       $minlength       See setMinlength()
	 * @param    int|null       $maxlength       See setMaxlength()
	 * @param    string|null    $pattern         See setPattern()
	 * @param    boolean        $required        See setRequired()
	 * @param    string|null    $list            See setList()
	 * @param    int|null       $size            See setSize()
	 * @param    string|null    $autocomplete    See setAutocomplete()
	 * @param    boolean        $readonly        See setReadonly()
	 * @param    boolean        $disabled        See setDisabled()
	 * @param    boolean        $autofocus       See setAutofocus()
	 * @param    string|null    $dirname         See setDirname()
	 * @param    string|null    $inputmode       See setInputmode()
	 * @param    string|null    $form            See setForm()
	 */
	public function text(
			$name = null, $value = null, $placeholder = null, $size = null,
			$minlength = null, $maxlength = null, $pattern = null,
			$required = false, $list = null, $autocomplete = null,
			$readonly = false, $disabled = false, $autofocus = false,
			$dirname = null, $inputmode = null, $form = null)
	{
		return $this
				->append('input')
				->setType('text')
				->setName($name)
				->setValue($value)
				->setPlaceholder($placeholder)
				->setSize($size)
				->setMinlength($minlength)
				->setMaxlength($maxlength)
				->setPattern($pattern)
				->setRequired($required)
				->setList($list)
				->setAutocomplete($autocomplete)
				->setReadonly($readonly)
				->setDisabled($disabled)
				->setAutofocus($autofocus)
				->setDirname($dirname)
				->setInputmode($inputmode)
				->setForm($form);
	}

	private function checkable(
			$type, $name = null, $value = null, $checked = false,
			$required = false, $disabled = false, $autofocus = false,
			$form = null)
	{
		return $this
				->append('input')
				->setType($type)
				->setName($name)
				->setValue($value)
				->setChecked($checked)
				->setAutofocus($autofocus)
				->setRequired($required)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="checkbox"></code>
	 *
	 * @see checkboxes()
	 *
	 * @param    string|null    $name         See setName()
	 * @param    mixed          $value        See setValue()
	 * @param    mixed          $checked      See setChecked()
	 * @param    boolean        $required     See setRequired()
	 * @param    mixed          $disabled     See setDisabled()
	 * @param    boolean        $autofocus    See setAutofocus()
	 * @param    string|null    $form         See setForm()
	 */
	public function checkbox(
			$name = null, $value = null, $checked = false, $required = false,
			$disabled = false, $autofocus = false, $form = null)
	{
		return $this->checkable(
				'checkbox', $name, $value, $checked, $required,
				$disabled, $autofocus, $form);
	}

	/**
	 * <code>&lt;input type="radio"></code>
	 *
	 * @see radios()
	 *
	 * @param    string|null    $name         See setName()
	 * @param    mixed          $value        See setValue()
	 * @param    mixed          $checked      See setChecked()
	 * @param    boolean        $required     See setRequired()
	 * @param    mixed          $disabled     See setDisabled()
	 * @param    boolean        $autofocus    See setAutofocus()
	 * @param    string|null    $form         See setForm()
	 */
	public function radio(
			$name = null, $value = null, $checked = false, $required = false,
			$disabled = false, $autofocus = false, $form = null)
	{
		return $this->checkable(
				'radio', $name, $value, $checked, $required,
				$disabled, $autofocus, $form);
	}

	private static function nameForGroup($name)
	{
		if  (!empty($name) && $name[strlen($name) - 1] != ']') {
			return $name . '[]';
		}
		return $name;
	}

	private function checkables(
			$type, $name, $values, $labels, $checked = array(),
			$required = false, $disabled = array(), $autofocus = false)
	{
		if ($type == 'checkbox') {
			$name = self::nameForGroup($name);
		}
		list($values, $labels) = self::pairedArrays($values, $labels);
		foreach ($values as $i => $value) {
			$label = $this->label();
			$label->checkable(
					$type, $name, $value, $checked, $required && $i == 0,
					$disabled, $autofocus && $i == 0);
			$label->append('span', $labels[$i]);
		}
		return $this;
	}

	/**
	 * Appends a group of checkboxes.
	 *
	 * There are different ways to define <code>$values</code> and code>$labels</code>:<br>
	 *
	 *<code><pre>
	 *     // Ad hoc
	 *     $values = array('cpp', 'java', 'php', 'python');
	 *     $labels = array('cpp', 'Java', 'PHP', 'Python');
	 *
	 *     // Configuration
	 *     $values = null;
	 *     $labels = array(
	 *             'cpp' => 'C++', 'java' => 'Java'
	 *             'php' => 'PHP', 'python' => 'Python');
	 *
	 *     // Database (can also be an array of objects)
	 *     $values = array(
	 *             array('id' => 1, 'val' => 'cpp', 'label' => 'C++'),
	 *             array('id' => 2, 'val' => 'java', 'label' => 'Java'),
	 *             array('id' => 3, 'val' => 'php', 'label' => 'PHP'),
	 *             array('id' => 4, 'val' => 'python', 'label' => 'Python'));
	 *     $labels = array('val', 'label');
	 *
	 *     $fieldset->checkboxes(
	 *             'languages', $values, $labels, array('php', 'cpp'),
	 *             true, 'java');
	 *</pre></code>
	 * Result:
	 *<code><pre><![cdata[
	 *     …
	 *     <label>
	 *         <checkbox name="languages[]" value="c++" checked required>
	 *         <span>C++</span>
	 *     </label>
	 *     <label>
	 *         <checkbox name="languages[]" value="java" disabled>
	 *         <span>Java</span>
	 *     </label>
	 *     …
	 *]]></pre></code>
	 *
	 * @see checkbox()
	 * @see radios()
	 * @see options()
	 *
	 * @param    string        $name         See setName()
	 * @param    array         $values       See above
	 * @param    array|null    $labels       See above
	 * @param    mixed         $checked      Is compared with the value attribute.<br>
	 *                                       Set it to <code>true</code>,
	 *                                       to check all checkboxes.<br>
	 *                                       See setChecked()
	 * @param    boolean       $required     Markes the first item as required.
	 * @param    mixed         $disabled     Is compared with the value attribute.<br>
	 *                                       Set it to <code>true</code>,
	 *                                       to disable all checkboxes.<br>
	 *                                       See setDisabled()
	 * @param    boolean       $autofocus    Markes the first item as autofocus.
	 */
	public function checkboxes(
			$name, $values, $labels = null, $checked = array(),
			$required = false, $disabled = array(), $autofocus = false)
	{
		return $this->checkables(
				'checkbox', $name, $values, $labels, $checked,
				$required, $disabled, $autofocus);
	}

	//////// Attributes ////////

	const ACCEPT_IMAGE = 'image/*';
	const ACCEPT_VIDEO = 'video/*';
	const ACCEPT_AUDIO = 'audio/*';

	/**
	 * Hint for expected file type in file upload controls (space separated or
	 * in an array).
	 *
	 * Possible values:
	 * <ul>
	 * <li><code>HTML5::ACCEPT_IMAGE</code>
	 * <li><code>HTML5::ACCEPT_VIDEO</code>
	 * <li><code>HTML5::ACCEPT_AUDIO</code>
	 * <li>A valid MIME type with no parameters
	 * <li>File extension: A string whose first character is a full stop (.)
	 * </ul>
	 *
	 * @see file()
	 *
	 * @param    string|array    $accept
	 */
	public function setAccept($accept, $appendArray = false)
	{
		return $this->attrib('accept', $accept, ',', $appendArray);
	}

	/**
	 * Character encodings to use for form submission (space separated or in an
	 * array).
	 *
	 * @see form()
	 *
	 * @param string|array    $accept_charset
	 */
	public function setAccept_charset($accept_charset, $appendArray = false)
	{
		return $this->attrib('accept-charset', $accept_charset, ' ', $appendArray);
	}

	const AUTOCOMPLETE_ON = 'on';
	const AUTOCOMPLETE_OFF = 'off';

	/**
	 * <ul>
	 * <li><code>form()</form>:<br>
	 * Default setting for autofill feature for controls in the form.
	 * <li><code>text()</code>, <code>search()</code>, <code>select()</code>:<br>
	 * Hint for form autofill feature.
	 * </ul>
	 *
	 * Possible values are
	 * <ul>
	 * <li><code>HTML5::AUTOCOMPLETE_ON</code> or <code>true</code>
	 * <li><code>HTML5::AUTOCOMPLETE_OFF</code> or <code>false</code>
	 * </ul>
	 *
	 * @param    string|boolean    $autocomplete
	 */
	public function setAutocomplete($autocomplete = self::AUTOCOMPLETE_ON)
	{
		if (is_bool($autocomplete)) {
			$autocomplete =
					$autocomplete
					? self::AUTOCOMPLETE_ON
					: self::AUTOCOMPLETE_OFF;
		}
		return $this->attrib('autocomplete', $autocomplete);
	}

	/**
	 * Automatically focus the form control when the page is loaded.
	 *
	 * @param    boolean    $autofocus
	 */
	public function setAutofocus($autofocus = true)
	{
		return $this->attrib('autofocus', $autofocus);
	}

	/**
	 * Whether the command or control is checked.
	 *
	 * Examples: <code><pre>
	 * $label->radio('choice', 'php')->setChecked();
	 * $label->radio('choice', 'php')->setChecked('php');
	 * $label->radio('choice', 'php')->setChecked(array('cpp', 'java'));
	 * </pre></code>
	 *
	 * @see checkbox()
	 * @see radio()
	 * @see checkboxes()
	 * @see radios()
	 *
	 * @param    mixed    $checked
	 */
	public function setChecked($checked = true)
	{
		return $this->booleanAttrib($checked, 'checked', 'value');
	}

	/**
	 * Enables the submission of the directionality of the element, and gives the name of the field
	 * that contains this value during form submission.
	 *
	 * @see text()
	 * @see search()
	 * @see textarea()
	 *
	 * @param    string    $dirname
	 */
	public function setDirname($dirname)
	{
		return $this->attrib('dirname', $dirname);
	}

	/**
	 * Whether the form control is disabled.
	 *
	 * Examples: <code><pre>
	 * $label->radio('choice', 'php')->setDisabled();
	 * $label->radio('choice', 'php')->setDisabled('php');
	 * $label->radio('choice', 'php')->setDisabled(array('cpp', 'java'));</pre></code>
	 *
	 * @see checkbox()
	 * @see radio()
	 * @see checkboxes()
	 * @see radios()
	 * @see select()
	 * @see option()
	 * @see options()
	 *
	 * @param    mixed    $disabled
	 */
	public function setDisabled($disabled = true)
	{
		return $this->booleanAttrib($disabled, 'disabled', 'value');
	}

	const ENCTYPE_APPLICATION = 'application/x-www-form-urlencoded';
	const ENCTYPE_MULTIPART = 'multipart/form-data';
	const ENCTYPE_TEXT = 'text/plain';

	/**
	 * Form data set encoding type to use for form submission.
	 *
	 * Possible values are:
	 * <ul>
	 * <li><code>HTML5::ENCTYPE_APPLICATION</code>
	 * <li><code>HTML5::ENCTYPE_MULTIPART</code>.<br>Use this for file uploads.
	 * <li><code>HTML5::ENCTYPE_TEXT</code>
	 * </ul>
	 *
	 * @see form()
	 *
	 * @param    string    $enctype
	 */
	public function setEnctype($enctype = self::ENCTYPE_MULTIPART)
	{
		return $this->attrib('enctype', $enctype);
	}

	/**
	 * Associate the label with form control.
	 *
	 * @see label()
	 *
	 * @param    string    $for
	 */
	public function setFor($for)
	{
		return $this->attrib('for', $for);
	}

	/**
	 * Associates the control with a form element.
	 *
	 * @see label()
	 * @see input()
	 *
	 * @param    string    $form
	 */
	public function setForm($form)
	{
		return $this->attrib('form', $form);
	}

	/**
	 * Vertical dimension.
	 *
	 * @see image()
	 *
	 * @param    int    $height
	 */
	public function setHeight($height)
	{
		return $this->attrib('height', $height);
	}

	const INPUTMODE_VERBATIM = 'verbatim';
	const INPUTMODE_LATIN = 'latin';
	const INPUTMODE_LATIN_NAME = 'latin-name';
	const INPUTMODE_LATIN_PROSE = 'latin-prose';
	const INPUTMODE_FULL_WIDTH_LATIN = 'full-width-latin';
	const INPUTMODE_KANA = 'kana';
	const INPUTMODE_KANA_NAME = 'kana-name';
	const INPUTMODE_KATAKANA = 'katakana';
	const INPUTMODE_NUMERIC = 'numeric';
	const INPUTMODE_TEL = 'tel';
	const INPUTMODE_EMAIL = 'email';
	const INPUTMODE_URL = 'url';

	/**
	 * Hint for selecting an input modality.
	 *
	 * Type <kbd>Html5::INP</kbd> to see all possible values.
	 *
	 * @see text()
	 * @search()
	 *
	 * @param    string    $inputmode
	 */
	public function setInputmode($inputmode)
	{
		return $this->attrib('inputmode', $inputmode);
	}

	/**
	 * Identifies a list of autocomplete options.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    string    $list
	 */
	public function setList($list)
	{
		return $this->attrib('list', $list);
	}

	/**
	 * Maximum length of value.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    int    $maxlength
	 */
	public function setMaxlength($maxlength)
	{
		return $this->attrib('maxlength', $maxlength);
	}

	const METHOD_GET = 'get';
	const METHOD_POST = 'post';

	/**
	 * HTTP method to use for form submission.
	 *
	 * Possible values are
	 * <ul>
	 * <li><code>HTML5::METHOD_GET</code>
	 * <li><code>HTML5::METHOD_POST</code>
	 *
	 * @see form()
	 *
	 * @param    string    $method
	 */
	public function setMethod($method)
	{
		return $this->attrib('method', $method);
	}

	/**
	 * Minimum length of value
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    int    $minlength
	 */
	public function setMinlength($minlength)
	{
		return $this->attrib('minlength', $minlength);
	}

	/**
	 * Whether to allow multiple values.
	 *
	 * @see select()
	 *
	 * @param    boolean    $multiple
	 */
	public function setMultiple($multiple = true)
	{
		return $this->attrib('multiple', $multiple);
	}

	/**
	 * <ul>
	 * <li><code>meta()</code>:<br>Metadata name
	 * <li><code>iframe()</code>, <code>object()</code>:<br>Name of nested browsing context
	 * <li><code>param()</code> Name of parameter
	 * <li><code>map()</code>:<br>Name of image map to reference from the usemap attribute
	 * <li><code>form()</code>:<br>Name of form to use in the <code>document.forms</code> API
	 * <li><code>checkbox()</code>, <code>radio()</code>, <code>select()</code>:<br>
	 * Name of form control to use for form submission and in the <code>form.elements</code> API
	 * </ul>
	 *
	 * @param    string    $name
	 */
	public function setName($name)
	{
		return $this->attrib('name', $name);
	}

	/**
	 * Bypass form control validation for form submission.
	 *
	 * @see form()
	 *
	 * @param    boolean    $novalidate
	 */
	public function setNovalidate($novalidate = true)
	{
		return $this->attrib('novalidate', $novalidate);
	}

	/**
	 * Pattern to be matched by the form control's value.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    string    $pattern
	 */
	public function setPattern($pattern)
	{
		return $this->attrib('pattern', $pattern);
	}

	/**
	 * User-visible label to be placed within the form control.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    string    $placeholder
	 */
	public function setPlaceholder($placeholder)
	{
		return $this->attrib('placeholder', $placeholder);
	}


	/**
	 * Whether to allow the value to be edited by the user.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param    boolean    $readonly
	 */
	public function setReadonly($readonly = true)
	{
		return $this->attrib('readonly', $readonly);
	}

	/**
	 * Whether the control is required for form submission.
	 *
	 * @param    boolean    $required
	 */
	public function setRequired($required = true)
	{
		return $this->attrib('required', $required);
	}

	/**
	 * Whether the option is selected by default.
	 *
	 * Examples: <code><pre>
	 * $select->option('PHP', 'php')->setSelected();
	 * $select->option('PHP', 'php')->setSelected('php');
	 * $select->option('PHP', 'php')->setSelected(array('cpp', 'java'));</pre></code>
	 *
	 * @see option()
	 *
	 * @param    mixed    $selected
	 */
	public function setSelected($selected = true)
	{
		return $this->booleanAttrib($selected, 'selected', 'value');
	}

	/**
	 * Size of the control.
	 *
	 * @see text()
	 * @see search()
	 * @see select()
	 *
	 * @param    int    $size
	 */
	public function setSize($size)
	{
		return $this->attrib('size', $size);
	}

	const TARGET_BLANK = '_blank';
	const TARGET_SELF = '_self';
	const TARGET_PARENT = '_parent';
	const TARGET_TOP = '_top';

	/**
	 * Browsing context for hyperlink navigation or form submission.
	 *
	 * Possible values are:
	 * <ul>
	 * <li><code>HTML5::TARGET_BLANK</code>
	 * <li><code>HTML5::TARGET_SELF</code>
	 * <li><code>HTML5::TARGET_PARENT</code>
	 * <li><code>HTML5::TARGET_TOP</code>
	 * <li>framename
	 * </ul>
	 *
	 * @see base()
	 * @see a()
	 * @see area()
	 * @see form()
	 *
	 * @param    string    $target
	 */
	public function setTarget($target)
	{
		return $this->attrib('target', $target);
	}

	/**
	 * <ul>
	 * <li><code>link()</code>, <code>alternate()</code>,
	 *     <code>icon()</code>, <code>shortcut_icon()</code>,
	 *     <code>a()</code>, <code>area()</code>:<br>
	 *     Hint for the type of the referenced resource
	 * <li><code>style()</code>, <code>embed()</code>, <code>object()</code>,
	 *     <code>source()</code>, <code>sources()</code>:<br>
	 *     Type of embedded resource.<br>For example <code>HTML5::MIME_WEBM</code>
	 * <li><code>ol()</code><br>
	 *     Kind of list marker<br>
	 *     Possible values are
	 *     <ul>
	 *     <li><code>HTML5::TYPE_DECIMAL</code>
	 *     <li><code>HTML5::TYPE_LOWER_ALPHA</code>
	 *     <li><code>HTML5::TYPE_UPPER_ALPHA</code>
	 *     <li><code>HTML5::TYPE_LOWER_ROMAN</code>
	 *     <li><code>HTML5::TYPE_UPPER_ROMAN</code></ul></ul>
	 *
	 * @param    string    $type
	 */
	public function setType($type)
	{
		return $this->attrib('type', $type);
	}


	/**
	 * <ul>
	 * <li><code>li()</code>:<br>Ordinal value of the list item
	 * <li><code>data()</code>:<br>Machine-readable value
	 * <li><code>param()</code>:<br>Value of parameter
	 * <li><code>checkbox()</code>, <code>radio()</code>:<br>Value of the form control
	 * <li><code>option()</code>:<br>Value to be used for form submission
	 * </ul>
	 *
	 * @param    string|int    $value
	 */
	public function setValue($value)
	{
		return $this->attrib('value', $value);
	}
}
