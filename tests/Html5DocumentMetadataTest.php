<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5DocumentMetadataTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(
						Html5::createSub()->head(),
						"<head>\n\t<meta charset=\"UTF-8\">\n</head>"
				),
				array(
						Html5::createSub()->title('content'),
						'<title>content</title>'
				),
				array(
						Html5::createSub()->base(null, Html5::TARGET_PARENT),
						'<base target="_parent">'
				),
				array(
						Html5::createSub()->base('../'),
						'<base href="../">'
				),
				array(
						Html5::createSub()->css('style.css'),
						'<link rel="stylesheet" href="style.css">'
				),
				array(
						Html5::createSub()->css('screen.css', 'screen'),
						'<link rel="stylesheet" href="screen.css" media="screen">'
				),
				array(
						Html5::createSub()->css(
								'contrast.css', null,
								'High Contrast', true),
						'<link' .
						' rel="alternate stylesheet" href="contrast.css"' .
						' title="High Contrast">'
				),
				array(
						Html5::createSub()->css(
								'contrast.css', 'screen',
								'High Contrast', true),
						'<link' .
						' rel="alternate stylesheet" href="contrast.css"' .
						' media="screen" title="High Contrast">'
				),

				// @todo hier fehlt alternate

				array(
						Html5::createSub()->atom('feed.xml'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/atom+xml">'
				),
				array(
						Html5::createSub()->atom('feed.xml', 'Atom Feed'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/atom+xml" title="Atom Feed">'
				),
				array(
						Html5::createSub()->rss('feed.xml'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/rss+xml">'
				),
				array(
						Html5::createSub()->rss('feed.xml', 'RSS Feed'),
						'<link' .
						' rel="alternate" href="feed.xml"' .
						' type="application/rss+xml" title="RSS Feed">'
				),
				array(
						Html5::createSub()->icon(),
						'<link rel="icon" href="favicon.ico">'
				),
				array(
						Html5::createSub()->icon('favicon.ico'),
						'<link rel="icon" href="favicon.ico">'
				),
				array(
						Html5::createSub()->icon(
								'favicon.ico', 'image/vnd.microsoft.icon'),
						'<link' .
						' rel="icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon">'
				),
				array(
						Html5::createSub()->icon(
								'favicon.ico', 'image/vnd.microsoft.icon',
								'16x16 32x32'),
						'<link' .
						' rel="icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon"' .
						' sizes="16x16 32x32">'
				),
				array(
						Html5::createSub()->shortcut_icon(),
						'<link rel="shortcut icon" href="favicon.ico">'
				),
				array(
						Html5::createSub()->shortcut_icon('favicon.ico'),
						'<link rel="shortcut icon" href="favicon.ico">'
				),
				array(
						Html5::createSub()->shortcut_icon(
								'favicon.ico', 'image/vnd.microsoft.icon'),
						'<link' .
						' rel="shortcut icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon">'
				),
				array(
						Html5::createSub()->shortcut_icon(
								'favicon.ico', 'image/vnd.microsoft.icon',
								'16x16 32x32'),
						'<link' .
						' rel="shortcut icon" href="favicon.ico"' .
						' type="image/vnd.microsoft.icon"' .
						' sizes="16x16 32x32">'
				),
				array(
						Html5::createSub()->meta('my-name', 'my content'),
						'<meta name="my-name" content="my content">'
				),
				array(
						Html5::createSub()->application_name('MyApp'),
						'<meta name="application-name" content="MyApp">'
				),
				array(
						Html5::createSub()->description('Lorem Ipsum Dolor'),
						'<meta name="description" content="Lorem Ipsum Dolor">'
				),
				array(
						Html5::createSub()->author('M. E. Lee'),
						'<meta name="author" content="M. E. Lee">'
				),
				array(
						Html5::createSub()->generator('ML Express PHP'),
						'<meta name="generator" content="ML Express PHP">'
				),
				array(
						Html5::createSub()->keywords('lorem, ipsum, dolor'),
						'<meta name="keywords" content="lorem, ipsum, dolor">'
				),
				array(
						Html5::createSub()->keywords(array('lorem', 'ipsum', 'dolor')),
						'<meta name="keywords" content="lorem,ipsum,dolor">'
				),
				array(
						Html5::createSub()->pragma('refresh', 10),
						'<meta http-equiv="refresh" content="10">'
				),
				array(
						Html5::createSub()->refresh(0, 'index.php'),
						'<meta http-equiv="refresh" content="0; URL=index.php">'
				),
				array(
						Html5::createSub()->refresh(10),
						'<meta http-equiv="refresh" content="10">'
				),
				array(
						Html5::createSub()->charset(),
						'<meta charset="UTF-8">'
				),
				array(
						Html5::createSub()->style(array(
								'body {', "\tbackground-color: #369;", '}')),
						"<style>\n" .
						"\tbody {\n\t\tbackground-color: #369;\n\t}\n" .
						"</style>"
				),
				array(
						Html5::createSub()->style(
								"body {\n\tbackground-color: #369;\n}"),
						"<style>\n" .
						"\tbody {\n\t\tbackground-color: #369;\n\t}\n" .
						"</style>"
				),
				array(
						Html5::createSub()->style(
								"body {\n\tbackground-color: #369;\n}",
								true, 'screen', 'text/css'),
						"<style type=\"text/css\" media=\"screen\" scoped>\n".
						"\tbody {\n\t\tbackground-color: #369;\n\t}\n" .
						"</style>"
				),
		);
	}
}