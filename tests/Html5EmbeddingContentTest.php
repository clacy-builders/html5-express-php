<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5EmbeddingContentTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(Html5::createSub()->img('logo.png'), '<img src="logo.png" alt="">'),
				array(Html5::createSub()->img('logo.png', ''), '<img src="logo.png" alt="">'),
				array(
						Html5::createSub()->img('logo.png', 'Acme Inc.'),
						'<img src="logo.png" alt="Acme Inc.">'
				),
				array(
						Html5::createSub()->img('logo.png', 'Acme Inc.', array(
								'logo-HD.png 2x', 'logo-phone.png 100w',
								'logo-phone-HD.png 100w 2x'
						)),
						'<img src="logo.png" srcset="' .
						'logo-HD.png 2x,logo-phone.png 100w,' .
						'logo-phone-HD.png 100w 2x" alt="Acme Inc.">'
				),
				array(
						Html5::createSub()->img('logo.png', 'Acme Inc.', null, 140, 100),
						'<img src="logo.png" alt="Acme Inc." width="140" height="100">'
				),
				array(
						Html5::createSub()->img('navigation.jpg', null, null, null, null, '#map'),
						'<img src="navigation.jpg" usemap="#map">'
				),
				array(
						Html5::createSub()
								->img('navigation.jpg', null, null, null, null, null, true),
						'<img src="navigation.jpg" ismap>'
				),
				array(
						Html5::createSub()->iframe(
								'inside_iframe.html', 960, 320, 'myframe', true,
								true, null, true),
						'<iframe src="inside_iframe.html" width="960" height="320"' .
						' name="myframe" sandbox seamless allowfullscreen>'
				),
				array(
						Html5::createSub()->iframe(
								null, 960, 320, 'myframe', true, true,
								'<a href="/gallery?m=cover&p=1">gallery</a>'),
						'<iframe srcdoc="<a href=&quot;/gallery' .
						'?m=cover&amp;amp;p=1&quot;>gallery</a>"' .
						' width="960" height="320" name="myframe"' .
						' sandbox seamless>'
				),
				array(
						Html5::createSub()->embed(
								'demo.swf', 'application/x-shockwave-flash', 320, 240),
						'<embed src="demo.swf" type="application/x-shockwave-flash"' .
						' width="320" height="240">'
				),
				array(
						Html5::createSub()->object(
								'demo.swf', 'application/x-shockwave-flash',
								'myobj', 320, 240, 'myform', 'mymap', true),
						'<object data="demo.swf"' .
						' type="application/x-shockwave-flash" name="myobj"' .
						' width="320" height="240" form="myform"' .
						' usemap="#mymap" typemustmatch></object>'
				),
				array(
						Html5::createSub()->param('movie', 'watch.swf'),
						'<param name="movie" value="watch.swf">'
				),
				array(Html5::createSub()->param('movie', null), ''),
				array(Html5::createSub()->param('movie', false), ''),
				array(
						Html5::createSub()->object()->params(array(
								'movie' => 'watch.swf',
								'flashvars' => '/1234',
								'allowfullscreen' => false
						)),
						"<object>\n" .
						"\t<param name=\"movie\" value=\"watch.swf\">\n" .
						"\t<param name=\"flashvars\" value=\"/1234\">\n" .
						"</object>"
				),
				array(
						Html5::createSub()->object()->params(array(
								'movie' => 'watch.swf',
								'flashvars' => '/1234',
								'allowfullscreen' => 'false'
						)),
						"<object>\n" .
						"\t<param name=\"movie\" value=\"watch.swf\">\n" .
						"\t<param name=\"flashvars\" value=\"/1234\">\n" .
						"\t<param name=\"allowfullscreen\" value=\"false\">\n" .
						"</object>"
				),
				array(
						Html5::createSub()->video(
								320, 200, 'vision.webm', 'poster.jpg',
								true, true, true, true, Html5::PRELOAD_NONE,
								Html5::CROSSORIGIN_ANONYMOUS),
						'<video src="vision.webm" width="320" height="200"' .
						' poster="poster.jpg" preload="none" autoplay' .
						' controls loop muted crossorigin="anonymous"></video>'
				),
				array(
						Html5::createSub()->video(320, 200)->setPoster('poster.jpg'),
						'<video width="320" height="200" poster="poster.jpg"></video>'
				),
				array(
						Html5::createSub()->audio('sound.mp3')->setLoop(),
						'<audio src="sound.mp3" loop></audio>'
				),
				array(
						Html5::createSub()
								->video(null, null, 'vision.webm')
								->setAutoplay()->setMuted()->setControls(),
						'<video src="vision.webm" autoplay controls muted></video>'
				),
				array(
						Html5::createSub()
								->video(null, null, 'vision.webm')
								->setPreload(Html5::PRELOAD_AUTO),
						'<video src="vision.webm" preload="auto"></video>'
				),
				array(
						Html5::createSub()
								->video()->setControls()
								->sources('uploads/1701.%s'),
						"<video controls>\n" .
						"\t<source src=\"uploads/1701.mp4\"" .
						" type=\"video/mp4; codecs=avc1.42E01E,mp4a.40.2\">\n" .
						"\t<source src=\"uploads/1701.webm\"" .
						" type=\"video/webm; codecs=vp8,vorbis\">\n" .
						"\t<source src=\"uploads/1701.ogv\"" .
						" type=\"video/ogg; codecs=theora,vorbis\">\n" .
						"</video>"
				),
				array(
						Html5::createSub()
								->audio()->setControls()
								->sources('uploads/1701.%s'),
						"<audio controls>\n" .
						"\t<source src=\"uploads/1701.mp3\"" .
						" type=\"audio/mpeg\">\n" .
						"\t<source src=\"uploads/1701.ogg\"" .
						" type=\"audio/ogg; codecs=vorbis\">\n" .
						"</audio>"
				),
				array(
						Html5::createSub()
								->audio()->setControls()
								->sources('uploads/1701.%s', array('mp3', 'wav', 'foo')),
						"<audio controls>\n" .
						"\t<source src=\"uploads/1701.mp3\"" .
						" type=\"audio/mpeg\">\n" .
						"\t<source src=\"uploads/1701.wav\"" .
						" type=\"audio/wav\">\n" .
						"\t<source src=\"uploads/1701.foo\">\n" .
						"</audio>"
				),
				array(
						Html5::createSub()
								->audio()->setControls()
								->sources('uploads/1701.%s', array(
										'mp3' => 'audio/mpeg',
										'wav' => 'audio/wav'
								)),
						"<audio controls>\n" .
						"\t<source src=\"uploads/1701.mp3\"" .
						" type=\"audio/mpeg\">\n" .
						"\t<source src=\"uploads/1701.wav\"" .
						" type=\"audio/wav\">\n" .
						"</audio>"
				),
				array(
						Html5::createSub()->track(
								'subtitles.vtt', Html5::KIND_SUBTITLES, true,
								'en', 'English'),
						'<track kind="subtitles" src="subtitles.vtt" srclang="en"' .
						' label="English" default>'
				),
				array(Html5::createSub()->map('nav'), '<map name="nav">'),
				array(
						Html5::createSub()->area(
								Html5::SHAPE_RECT, '0,100,0,20', 'uploads/1709',
								'sounds', Html5::TARGET_BLANK, Html5::MIME_MP3,
								'sounds.mp3', Html5::REL_ALTERNATE, 'en',
								'statistics.php?id=1709'),
						'<area shape="rect" coords="0,100,0,20"' .
						' href="uploads/1709" alt="sounds" target="_blank"' .
						' type="audio/mpeg" download="sounds.mp3"' .
						' rel="alternate" hreflang="en"' .
						' ping="statistics.php?id=1709">'
				),
				array(
						Html5::createSub()->rect(array(0, 100, 0, 20)),
						'<area shape="rect" coords="0,100,0,20">'
				),
				array(
						Html5::createSub()
								->circle('250,200,35')
								->setPing(array('one/1709', 'two/1709')),
						'<area shape="circle" coords="250,200,35" ping="one/1709 two/1709">'
				),
				array(
						Html5::createSub()->poly('10,10,100,100,10,100', '/test'),
						'<area shape="poly" coords="10,10,100,100,10,100" href="/test" alt="">'
				),
		);
	}
}