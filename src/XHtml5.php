<?php
namespace ClacyBuilders\Html5;

use ClacyBuilders\Html5\Html5;

class XHtml5 extends Html5
{
	const MIME_TYPE = 'application/xhtml+xml';
	const XML_DECLARATION = true;
	const HTML_MODE = false;
	const XML_NAMESPACE = 'http://www.w3.org/1999/xhtml';

	/**
	 * Creates a html element.
	 *
	 * @param  string  $lang        The document's language.
	 * @param  string  $manifest    Application cache manifest.
	 * @param  array   $namespaces  Additional <code>xmlns</code> attributes (prefix => uri).
	 * @return Html5
	 */
	public static function createHtml($lang = null, $manifest = null, $namespaces = [])
	{
		return static::createRoot('html', $namespaces)
				->setLang($lang)
				->attrib('manifest', $manifest);
	}
}