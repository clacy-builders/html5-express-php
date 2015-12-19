<?php
namespace ML_Express\HTML5;

use ML_Express\HTML5\Html5;

class XHtml5 extends Html5
{
	const MIME_TYPE = 'application/xhtml+xml';
	const XML_DECLARATION = true;
	const SGML_MODE = false;
	const XML_NAMESPACE = 'http://www.w3.org/1999/xhtml';
}