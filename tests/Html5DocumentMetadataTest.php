<?php

namespace ML_Express\HTML5\Tests;

require_once 'vendor/ml-express/xml/src/Xml.php';
require_once 'vendor/ml-express/xml/src/XmlAttributes.php';
require_once 'vendor/ml-express/xml/src/functions.php';
require_once 'vendor/ml-express/xml/src/shared/ClassAttribute.php';
require_once 'vendor/ml-express/xml/src/shared/StyleAttribute.php';
require_once 'vendor/ml-express/xml/tests/Express_TestCase.php';
require_once 'src/Html5.php';

use ML_Express\Tests\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5DocumentMetadataTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(
						Html5::c_()->head(),
						"<head>\n\t<meta charset=\"UTF-8\">\n</head>"
				),
				array(
						Html5::c_()->title('content'),
						'<title>content</title>'
				),
				array(
						Html5::c_()->base(null, Html5::TARGET_PARENT),
						'<base target="_parent">'
				),
				array(
						Html5::c_()->base('../'),
						'<base href="../">'
				),
				array(
						Html5::c_()->css('style.css'),
						'<link rel="stylesheet" href="style.css">'
				),
				array(
						Html5::c_()->css('screen.css', 'screen'),
						'<link rel="stylesheet" href="screen.css" media="screen">'
				),
				array(
						Html5::c_()->css('contrast.css', null, 'High Contrast', true),
						'<link' .
						' rel="alternate stylesheet" href="contrast.css"' .
						' title="High Contrast">'
				),
				array(
						Html5::c_()->css('contrast.css', 'screen', 'High Contrast', true),
						'<link' .
						' rel="alternate stylesheet" href="contrast.css"' .
						' media="screen" title="High Contrast">'
				),

				// @todo hier fehlt alternate

				array(
						Html5::c_()->atom('feed.xml'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/atom+xml">'
				),
				array(
						Html5::c_()->atom('feed.xml', 'Atom Feed'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/atom+xml" title="Atom Feed">'
				),
				array(
						Html5::c_()->rss('feed.xml'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/rss+xml">'
				),
				array(
						Html5::c_()->rss('feed.xml', 'RSS Feed'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/rss+xml" title="RSS Feed">'
				),
				array(
						Html5::c_()->icon(),
						'<link rel="icon" href="favicon.ico">'
				),
				array(
						Html5::c_()->icon('favicon.ico'),
						'<link rel="icon" href="favicon.ico">'
				),
				array(
						Html5::c_()->icon('favicon.ico', 'image/vnd.microsoft.icon'),
						'<link' .
						' rel="icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon">'
				),
				array(
						Html5::c_()->icon(
								'favicon.ico', 'image/vnd.microsoft.icon',
								'16x16 32x32'),
						'<link' .
						' rel="icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon"' .
						' sizes="16x16 32x32">'
				),
				array(
						Html5::c_()->shortcut_icon(),
						'<link rel="shortcut icon" href="favicon.ico">'
				),
				array(
						Html5::c_()->shortcut_icon('favicon.ico'),
						'<link rel="shortcut icon" href="favicon.ico">'
				),
				array(
						Html5::c_()->shortcut_icon('favicon.ico', 'image/vnd.microsoft.icon'),
						'<link' .
						' rel="shortcut icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon">'
				),
				array(
						Html5::c_()->shortcut_icon(
								'favicon.ico', 'image/vnd.microsoft.icon',
								'16x16 32x32'),
						'<link' .
						' rel="shortcut icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon"' .
						' sizes="16x16 32x32">'
				),
				array(
						Html5::c_()->meta('my-name', 'my content'),
						'<meta name="my-name" content="my content">'
				),
				array(
						Html5::c_()->application_name('MyApp'),
						'<meta name="application-name" content="MyApp">'
				),
				array(
						Html5::c_()->description('Lorem Ipsum Dolor'),
						'<meta name="description" content="Lorem Ipsum Dolor">'
				),
				array(
						Html5::c_()->author('M. E. Lee'),
						'<meta name="author" content="M. E. Lee">'
				),
				array(
						Html5::c_()->generator('ML Express PHP'),
						'<meta name="generator" content="ML Express PHP">'
				),
				array(
						Html5::c_()->keywords('lorem, ipsum, dolor'),
						'<meta name="keywords" content="lorem, ipsum, dolor">'
				),
				array(
						Html5::c_()->keywords(array('lorem', 'ipsum', 'dolor')),
						'<meta name="keywords" content="lorem,ipsum,dolor">'
				),
				array(
						Html5::c_()->pragma('refresh', 10),
						'<meta http-equiv="refresh" content="10">'
				),
				array(
						Html5::c_()->refresh(0, 'index.php'),
						'<meta http-equiv="refresh" content="0; URL=index.php">'
				),
				array(
						Html5::c_()->refresh(10),
						'<meta http-equiv="refresh" content="10">'
				),
				array(
						Html5::c_()->charset(),
						'<meta charset="UTF-8">'
				),
				array(
						Html5::c_()->style(
								"body {\n\tbackground-color: #369;\n}",
								true, 'screen', 'text/css'),
						'<style type="text/css" media="screen" scoped>
	body {
		background-color: #369;
	}
</style>'
				),
				array(
						Html5::c_('html')->head()->style(
								"body {\n\tbackground-color: #369;\n}"),
						'<html>
	<head>
		<meta charset="UTF-8">
		<style>
			body {
				background-color: #369;
			}
		</style>
	</head>
</html>'
				)
		);
	}
}