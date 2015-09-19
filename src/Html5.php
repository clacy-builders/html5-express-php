<?php

namespace ML_Express\HTML5;

use ML_Express;
class Html5 extends \ML_Express\Xml
{
	const MIME_TYPE = 'application/xml';
	const FILENAME_EXTENSION = 'html';
	const XML_DECLARATION = false;
	const DOCTYPE = '<!DOCTYPE html>';
	const SGML_MODE = true;
	const ROOT_ELEMENT = 'html';
	const XML_NAMESPACE = null;

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
