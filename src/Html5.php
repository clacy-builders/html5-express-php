<?php
namespace ClacyBuilders\Html5;

use ClacyBuilders\Xml;
use ClacyBuilders\Shared\AddQuery;
use ClacyBuilders\Shared\ClassAttribute;
use ClacyBuilders\Shared\DimensionAttributes;
use ClacyBuilders\Shared\MediaAttribute;
use ClacyBuilders\Shared\MediaAttributeConstants;
use ClacyBuilders\Shared\StyleAttribute;
use ClacyBuilders\Shared\TitleAttribute;
use ClacyBuilders\Shared\TypeAttribute;

class Html5 extends Xml implements MediaAttributeConstants
{
	use ClassAttribute, DimensionAttributes, MediaAttribute, StyleAttribute,
			TitleAttribute, TypeAttribute, AddQuery { addQuery as xmlAddQuery; }

	const MIME_TYPE = 'text/html';
	const FILENAME_EXTENSION = 'html';
	const XML_DECLARATION = false;
	const DOCTYPE = '<!DOCTYPE html>';
	const HTML_MODE = true;

	/**
	 * Creates html element.
	 *
	 * @param  string  $lang      The document's language.
	 * @param  string  $manifest  Application cache manifest.
	 * @return Html5
	 */
	public static function createHtml($lang = null, $manifest = null)
	{
		return static::createRoot('html')
				->setLang($lang)
				->attrib('manifest', $manifest);
	}

	//////// Document metadata ////////

	/**
	 * Appends a <code>head</code> element.
	 *
	 * @return Html5
	 */
	public function head()
	{
		return $this->append('head', '')->charset()->getParent();
	}

	/**
	 * Appends a <code>title</code> element.
	 *
	 * @param  string  $title   
	 * @return Html5
	 */
	public function title($title)
	{
		return $this->append('title', $title);
	}

	/**
	 * Appends a <code>base</code> element.
	 *
	 * @param  string  $href    Document base URL.
	 * @param  string  $target  Default browsing context for hyperlink navigation and form
	 *                          submission.<br>See const declarations starting with TARGET.
	 * @return Html5
	 */
	public function base($href, $target = null)
	{
		return $this
				->append('base')
				->setHref($href)
				->setTarget($target);
	}

	/**
	 * Appends a <code>link</code> element.
	 * @todo crossorigin attribute
	 *
	 * @param  string  $rel       Relationship between the document containing
	 *                            the hyperlink and the destination resource.
	 *                            See const declarations starting with REL.
	 * @param  string  $href      Address of the hyperlink.
	 * @param  string  $title     Title of the link.
	 * @param  string  $type      Hint for the type of the referenced resource.
	 * @param  string  $hreflang  Language of the linked resource.
	 * @param  string  $media     Applicable media.
	 * @param  string  $sizes     Sizes of the icons (for `rel="icon"`).
	 * @return Html5
	 */
	public function link($rel, $href,
			$title = null, $type = null, $hreflang = null, $media = null, $sizes = null)
	{
		return $this
				->append('link')
				->setRel($rel)
				->setHref($href)
				->setType($type)
				->setMedia($media)
				->setTitle($title)
				->setHreflang($hreflang)
				->setSizes($sizes);
	}

	/**
	 * A css link.
	 *
	 * @param  string   $href       Address of the hyperlink.
	 * @param  string  	$media      Applicable media.
	 * @param  string   $title      Title of the link.
	 * @param  boolean  $alternate  Whether it is an alternate stylesheet or not.
	 * @return Html5
	 */
	public function stylesheet($href, $media = null, $title = null, $alternate = false)
	{
		$rel = ($alternate ? 'alternate ' : '') . 'stylesheet';
		return $this->link($rel, $href, $title, null, null, $media);
	}

	/**
	 * A css link.
	 *
	 * @param  string   $href       Address of the hyperlink.
	 * @param  string   $media      Applicable media.
	 * @param  string   $title      Title of the link.
	 * @param  boolean  $alternate  Whether it is an alternate stylesheet or not.
	 * @return Html5
	 */
	public function css($href, $media = null, $title = null, $alternate = false)
	{
		return $this->stylesheet($href, $media, $title, $alternate);
	}

	/**
	 * A link to an alternative version of the page.
	 *
	 * @param  string  $href      Address of the hyperlink.
	 * @param  string  $title     Title of the link.
	 * @param  string  $type      Hint for the type of the referenced resource.
	 * @param  string  $hreflang  Language of the linked resource.
	 * @param  string  $media     Applicable media.
	 * @return Html5
	 */
	public function alternate($href, $title = null, $type = null, $hreflang = null, $media = null)
	{
		return $this->link('alternate', $href, $title, $type, $hreflang, $media);
	}

	/**
	 * A atom feed link.
	 *
	 * @param  string  $href   Address of the hyperlink.
	 * @param  string  $title  Title of the link.
	 * @return Html5
	 */
	public function atom($href, $title = null)
	{
		return $this->alternate($href, $title, 'application/atom+xml');
	}

	/**
	 * A rss-feed link
	 *
	 * @param  string  $href   Address of the hyperlink.
	 * @param  string  $title  Title of the link.
	 * @return Html5
	 */
	public function rss($href, $title = null)
	{
		return $this->alternate($href, $title, 'application/rss+xml');
	}

	/**
	 * A link to a favicon.
	 *
	 * @param  string   $href      Address of the hyperlink.
	 * @param  string   $type      Hint for the type of the referenced resource.
	 * @param  string   $sizes     Sizes of the icons.
	 * @param  boolean  $shortcut  Whether to use the <code>shortcut</code> keyword or not.
	 * @return Html5
	 */
	public function icon($href = 'favicon.ico', $type = null, $sizes = null, $shortcut = false)
	{
		$rel = $shortcut ? 'shortcut icon' : 'icon';
		return $this->link($rel, $href, null, $type, null, null, $sizes);
	}

	/**
	 * A link to a favicon using <code>shortcut icon</code>.
	 *
	 * @param  string  $href   Address of the hyperlink.
	 * @param  string  $type   Hint for the type of the referenced resource.
	 * @param  string  $sizes  Sizes of the icons.
	 * @return Html5
	 */
	public function shortcut_icon($href = 'favicon.ico', $type = null, $sizes = null)
	{
		return $this->icon($href, $type, $sizes, true);
	}

	/**
	 * Appends a <code>meta</code> element.
	 *
	 * @param  string  $name
	 * @param  string  $content
	 * @return Html5
	 */
	public function meta($name, $content)
	{
		return $this
				->append('meta')
				->setName($name)
				->attrib('content', $content);
	}

	/**
	 * Appends a <code>meta</code> element giving the name of the web application
	 * that the page represents.
	 *
	 * @param  string  $application_name
	 * @return Html5
	 */
	public function application_name($application_name)
	{
		return $this->meta('application-name', $application_name);
	}

	/**
	 * Appends a <code>meta</code> element giving the name of one of the page's authors.
	 *
	 * @param  string  $author
	 * @return Html5
	 */
	public function author($author)
	{
		return $this->meta('author', $author);
	}

	/**
	 * Appends a <code>meta</code> element that describes the page for use in a directory
	 * of pages, e.g. in a search engine.
	 *
	 * @param  string  $description
	 * @return Html5
	 */
	public function description($description)
	{
		return $this->meta('description', $description);
	}

	/**
	 * Appends a <code>meta</code> element that identifies one of the software packages
	 * used to generate the document.
	 *
	 * @param  string  $generator
	 * @return Html5
	 */
	public function generator($generator)
	{
		return $this->meta('generator', $generator);
	}

	/**
	 * Appends a <code>meta</code> element defining keywords relevant to the page.
	 *
	 * @param  string|string[]  $keywords  A string containing comma-separated tokens,
	 *                                     or an array of these tokens.
	 * @return Html5
	 */
	public function keywords($keywords)
	{
		return $this->append('meta')
				->setName('keywords')
				->complexAttrib('content', $keywords, ',');
	}

	/**
	 * A pragma directive.
	 *
	 * @param  string  $http_equiv  Pragma directive.
	 * @param  string  $content     Value of the element.
	 * @return Html5
	 */
	public function pragma($http_equiv, $content)
	{
		return $this
				->append('meta')
				->attrib('http-equiv', $http_equiv)
				->attrib('content', $content);
	}

	/**
	 * A pragma directive which acts as timed redirect.
	 *
	 * @param  string|int  $seconds
	 * @param  string      $url
	 * @return Html5
	 */
	public function refresh($seconds, $url = null)
	{
		if ($url) {
			$seconds .= '; URL=' . $url;
		}
		return $this->pragma('refresh', $seconds);
	}

	/**
	 * Appends a <code>meta</code> element specifying the document's character encoding.
	 *
	 * @return Html5
	 */
	public function charset()
	{
		if (!static::HTML_MODE) return $this;
		return $this
				->append('meta')
				->attrib('charset', static::CHARACTER_ENCODING);
	}

	/**
	 * Appends a <code>style</code> element.
	 *
	 * @param  string|array  $content  The embeded style information.
	 * @param  boolean       $scoped
	 * @param  string        $media    Applicable media.
	 * @param  string        $type     Type of embedded resource.
	 * @return Html5
	 */
	public function style($content, $scoped = false, $media = null, $type = null)
	{
		return $this
				->append('style')
				->setOption(self::OPTION_TEXT_MODE, self::TEXT_MODE_NO_LTRIM)
				->setType($type)
				->setMedia($media)
				->setScoped($scoped)
				->appendText($content);
	}

	//////// Sections ////////

	/**
	 * Appends a <code>body</code> element.
	 *
	 * @return Html5
	 */
	public function body()
	{
		return $this->append('body');
	}

	/**
	 * Appends an <code>article</code> element.
	 *
	 * @return Html5
	 */
	public function article()
	{
		return $this->append('article');
	}

	/**
	 * Appends a <code>section</code> element.
	 *
	 * @return Html5
	 */
	public function section()
	{
		return $this->append('section');
	}

	/**
	 * Appends a <code>nav</code> element.
	 *
	 * @return Html5
	 */
	public function nav()
	{
		return $this->append('nav');
	}

	/**
	 * Appends an <code>aside</code> element.
	 *
	 * @return Html5
	 */
	public function aside()
	{
		return $this->append('aside');
	}

	/**
	 * Appends a <code>h1</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h1($content = '')
	{
		return $this->append('h1', $content);
	}

	/**
	 * Appends a <code>h2</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h2($content = '')
	{
		return $this->append('h2', $content);
	}

	/**
	 * Appends a <code>h3</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h3($content = '')
	{
		return $this->append('h3', $content);
	}

	/**
	 * Appends a <code>h4</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h4($content = '')
	{
		return $this->append('h4', $content);
	}

	/**
	 * Appends a <code>h5</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h5($content = '')
	{
		return $this->append('h5', $content);
	}

	/**
	 * Appends a <code>h6</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function h6($content = '')
	{
		return $this->append('h6', $content);
	}

	/**
	 * Appends a <code>hgroup</code> element.
	 *
	 * @return Html5
	 */
	public function hgroup()
	{
		return $this->append('hgroup');
	}

	/**
	 * Appends a <code>header</code> element.
	 *
	 * @return Html5
	 */
	public function header()
	{
		return $this->append('header');
	}

	/**
	 * Appends a <code>footer</code> element.
	 *
	 * @return Html5
	 */
	public function footer()
	{
		return $this->append('footer');
	}

	/**
	 * Appends an <code>address</code> element.
	 *
	 * @return Html5
	 */
	public function address()
	{
		return $this->append('address');
	}

	//////// Grouping Content ////////

	/**
	 * Appends a <code>p</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function p($content = '')
	{
		return $this->append('p', $content);
	}

	/**
	 * Appends a <code>hr</code> element.
	 *
	 * @return Html5
	 */
	public function hr()
	{
		return $this->append('hr');
	}

	/**
	 * Appends a <code>pre</code> element
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function pre($content = '')
	{
		return $this->append('pre', $content)
				->setOption(self::OPTION_TEXT_MODE, self::TEXT_MODE_PREPEND);
	}

	/**
	 * Appends a <code>blockquote</code> element.
	 *
	 * @param  string  $cite  A valid URL potentially surrounded by space.
	 * @return Html5
	 */
	public function blockquote($content = '', $cite = null)
	{
		return $this->append('blockquote', $content)->setCite($cite);
	}

	/**
	 * Appends an <code>ol</code> element.
	 *
	 * @param  string   $type      Kind of list marker.
	 *                             See const declarations starting with TYPE.
	 * @param  int      $start     Ordinal value of the first item.
	 * @param  boolean  $reversed  Number the list backwards.
	 * @return Html5
	 */
	public function ol($type = null, $start = null, $reversed = false)
	{
		return $this
				->append('ol')
				->setType($type)
				->setStart($start)
				->setReversed($reversed);
	}

	/**
	 * Appends an <code>ul</code> element.
	 *
	 * @return Html5
	 */
	public function ul()
	{
		return $this->append('ul');
	}

	/**
	 * Appends a <code>li</code> element.
	 *
	 * @param  string  $content
	 * @param  int     $value    Ordinal value of the list item.
	 * @return Html5
	 */
	public function li($content = '', $value = null)
	{
		return $this->append('li', $content)->setValue($value);
	}

	/**
	 * Appends a <code>dl</code> element.
	 *
	 * @return Html5
	 */
	public function dl()
	{
		return $this->append('dl');
	}

	/**
	 * Appends a <code>dt</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function dt($content = '')
	{
		return $this->append('dt', $content);
	}

	/**
	 * Appends a <code>dd</code> element
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function dd($content = '')
	{
		return $this->append('dd', $content);
	}

	/**
	 * Appends a <code>figure</code> element.
	 *
	 * @return Html5
	 */
	public function figure()
	{
		return $this->append('figure');
	}

	/**
	 * Appends a <code>figcaption</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function figcaption($content = '')
	{
		return $this->append('figcaption', $content);
	}

	/**
	 * Appends a <code>main</code> element.
	 *
	 * @return Html5
	 */
	public function main()
	{
		return $this->append('main');
	}

	/**
	 * Appends a <code>div</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function div($content = '') {
		return $this->append('div', $content);
	}

	//////// Text-level semantics ////////

	/**
	 * Appends an <code>a</a> element.
	 *
	 * @param  string        $content
	 * @param  string        $href      Address of the hyperlink
	 * @param  string        $target    Browsing context for hyperlink navigation.
	 *                                  See const declarations starting with TARGET.
	 * @param  string        $rel       Relationship between the document containing
	 *                                  the hyperlink and the destination resource.
	 * @param  string        $type      Hint for the type of the referenced resource.
	 * @param  string        $hreflang  Language of the linked resource.
	 * @param  string|array  $ping      URLs to ping (space separated or array).
	 * @param  string        $download  Whether to download the resource instead of navigating to
	 *                                  it, and its file name if so.
	 * @return Html5
	 */
	public function a($content, $href, $target = null,
			$rel = null, $type = null, $hreflang = null, $ping = null, $download = null)
	{
		return $this
				->append('a', $content)
				->setHref($href)
				->setRel($rel)
				->setType($type)
				->setHreflang($hreflang)
				->setDownload($download)
				->setTarget($target)
				->setPing($ping);
	}

	/**
	 * Adds a query string to an attribute, by default to the <code>href</code> attribute.
	 *
	 * @param  array   $queryParts  Assotiave array with query arguments.
	 * @param  string  $attribute   Name of the attribute.
	 */
	public function addQuery($queryParts, $attribute = null) {
		if ($attribute === null) {
			switch ($this->name) {
				case 'img':
				case 'video':
				case 'audio':
				case 'source':
				case 'track': $attribute = 'src'; break;
				default: $attribute = 'href';
			}
		}
		return $this->xmlAddQuery($queryParts, $attribute);
	}

	/**
	 * Appends an <code>em</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function em($content = '')
	{
		return $this->append('em', $content);
	}

	/**
	 * Appends a <code>strong</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function strong($content = '')
	{
		return $this->append('strong', $content);
	}

	/**
	 * Appends a <code>small</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function small($content = '')
	{
		return $this->append('small', $content);
	}

	/**
	 * Appends a <code>s</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function s($content = '')
	{
		return $this->append('s', $content);
	}

	/**
	 * Appends a <code>cite</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function cite($content = '')
	{
		return $this->append('cite', $content);
	}

	/**
	 * Appends a <code>q</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $cite     Link to the source of the quotation or more information
	 *                           about the edit.
	 * @return Html5
	 */
	public function q($content = '', $cite = null)
	{
		return $this->append('q', $content)->setCite($cite);
	}

	/**
	 * Appends a <code>dfn</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $title    The term being defined.
	 * @return Html5
	 */
	public function dfn($content = '', $title = null)
	{
		return $this->append('dfn', $content)->setTitle($title);
	}

	/**
	 * Appends an <code>abbr</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $title    Full term or expansion of abbreviation.
	 * @return Html5
	 */
	public function abbr($content = '', $title = null)
	{
		return $this->append('abbr', $content)->setTitle($title);
	}

	/**
	 * Appends a <code>data</code> element.
	 *
	 * @param  string  $content
	 * @param  mixed   $value    Machine-readable value.
	 * @return Html5
	 */
	public function data($content = '', $value = null)
	{
		return $this->append('data', $content)->setValue($value);
	}

	/**
	 * Appends a <code>time</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $datetime  Machine-readable value.
	 * @return Html5
	 */
	public function time($content = '', $datetime = null)
	{
		return $this->append('time', $content)
				->setDatetime($datetime == $content ? null : $datetime);
	}

	/**
	 * Appends a <code>code</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function code($content = '')
	{
		return $this->append('code', $content);
	}

	/**
	 * Appends a <code>pre element, to which a code</code> element will be appended.
	 *
	 * For example: <code><pre>
	 *     $section
	 *             ->codeblock($html->getMarkup(), '  ')
	 *             ->setClass('html5');
	 * </pre></code>
	 *
	 * @param  string  $content
	 * @param  string  $spaces   Replacement for tabs.
	 * @return Html5
	 */
	public function codeblock($content, $spaces = '    ')
	{
		if ($spaces !== null) {
			$content = str_replace("\t", $spaces, $content);
		}
		$content = htmlspecialchars($content);
		return $this->pre()->inLine()->code($content);
	}

	/**
	 * Appends a <code>var</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function v($content = '')
	{
		return $this->append('var', $content);
	}

	/**
	 * Appends a <code>samp</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function samp($content = '')
	{
		return $this->append('samp', $content);
	}

	/**
	 * Appends a <code>kbd</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function kbd($content = '')
	{
		return $this->append('kbd', $content);
	}

	/**
	 * Appends a <code>sub</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function sub($content = '')
	{
		return $this->append('sub', $content);
	}

	/**
	 * Appends a <code>sup</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function sup($content = '')
	{
		return $this->append('sup', $content);
	}

	/**
	 * Appends an <code>i</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function i($content = '')
	{
		return $this->append('i', $content);
	}

	/**
	 * Appends a <code>b</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function b($content = '')
	{
		return $this->append('b', $content);
	}

	/**
	 * Appends an <code>u</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function u($content = '')
	{
		return $this->append('u', $content);
	}

	/**
	 * Appends a <code>mark</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function mark($content = '')
	{
		return $this->append('mark', $content);
	}

	/**
	 * Appends a <code>ruby</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function ruby($content = '')
	{
		return $this->append('ruby', $content);
	}

	/**
	 * Appends a <code>rt</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function rt($content = '')
	{
		return $this->append('rt', $content);
	}

	/**
	 * Appends a <code>rp</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function rp($content = '')
	{
		return $this->append('rp', $content);
	}

	/**
	 * Appends a <code>bdi</code> element
	 *
	 * @param  string  $content
	 * @param  string  $dir      @todo explaining text
	 *                           See const declarations starting with DIR.
	 * @return Html5
	 */
	public function bdi($content = '', $dir = null)
	{
		return $this->append('bdi', $content)->setDir($dir);
	}

	/**
	 * Appends a <code>bdo</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $dir      @todo explaining text;
	 *                           See const declarations starting with DIR.
	 * @return Html5
	 */
	public function bdo($content = '', $dir = null)
	{
		return $this->append('bdo', $content)->setDir($dir);
	}

	/**
	 * Appends a <code>span</code> element.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function span($content = '')
	{
		return $this->append('span', $content);
	}

	/**
	 * Appends a <code>br</code> element.
	 *
	 * @return Html5
	 */
	public function br()
	{
		return $this->append('br');
	}

	/**
	 * Appends a <code>wbr</code> element.
	 *
	 * @return Html5
	 */
	public function wbr()
	{
		return $this->append('wbr');
	}

	//////// Edits ////////

	/**
	 * Appends ins element.
	 *
	 * @param string  $content
	 * @param string  $datetime    Date and (optionally) time of the change.
	 * @param string  $cite        Link to the source of the quotation or more
	 *                             information about the edit.
	 * @return Html5
	 */
	public function ins($content = '', $datetime = null, $cite = null)
	{
		return $this
				->append('ins', $content)
				->setCite($cite)
				->setDatetime($datetime);
	}

	/**
	 * Appends a <code>del</code> element.
	 *
	 * @param  string  $content
	 * @param  string  $datetime  Date and (optionally) time of the change.
	 * @param  string  $cite      Link to the source of the quotation or more information
	 *                            about the edit.
	 * @return Html5
	 */
	public function del($content = '', $datetime = null, $cite = null)
	{
		return $this
				->append('del', $content)
				->setCite($cite)
				->setDatetime($datetime);
	}

	//////// Embedded content ////////

	/**
	 * Appends an <code>img</code> element.
	 * @todo crossorigin attribute
	 *
	 * @param  string           $src     Address of the resource.
	 * @param  string           $alt     Replacement text for use when images are not available.
	 * @param  string|string[]  $srcset  Images to use in different situations (e.g.
	 *                                   high-resolution displays, small monitors, etc)
	 * @param  int              $width   Horizontal dimension.
	 * @param  int              $height  Vertical dimension.
	 * @param  string           $usemap
	 * @param  boolean          $ismap   Whether the image is a server-side image map.
	 * @return Html5
	 */
	public function img($src, $alt = '', $srcset = null,
			$width = null, $height = null, $usemap = null, $ismap = false)
	{
		return $this
				->append('img')
				->setSrc($src)
				->setSrcset($srcset)
				->setAlt($alt)
				->setDimensions($width, $height)
				->setUsemap($usemap)
				->setIsmap($ismap);
	}

	/**
	 * Appends an <code>iframe</code> element.
	 *
	 * For example: <code><pre>
	 * $body->iframe(
	 *         'inframe.html', 960, 320, 'myframe',
	 *         [Html5::SANDBOX_TOP_NAVIGATION, Html5::SANDBOX_FORMS]);
	 * </pre></code>
	 *
	 * @param  string                $src              Address of the resource.
	 * @param  integer               $width            Horizontal dimension.
	 * @param  integer               $height           Vertical dimension.
	 * @param  string                $name             Name of nested browsing context.
	 * @param  string|array|boolean  $sandbox          Security rules for nested content.
	 *                                                 The <code>SANDBOX</code> Constants
	 *                                                 space-separated or in an array.
	 * @param  boolean               $seamless         Whether to apply the document's styles
	 *                                                 to the nested content.
	 * @param  string                $srcdoc           A document to render in the iframe.
	 * @param  boolean               $allowfullscreen  Whether to allow the iframe's contents
	 *                                                 to use <code>requestFullscreen()</code>.
	 * @return Html5
	 */
	public function iframe($src = null, $width = null, $height = null, $name = null,
			$sandbox = false, $seamless = false, $srcdoc = null, $allowfullscreen = false)
	{
		if (!empty($srcdoc)) {
			$srcdoc = str_replace('&', '&amp;', $srcdoc);
			$srcdoc = str_replace('&', '&amp;', $srcdoc);
			$srcdoc = str_replace('"', '&quot;', $srcdoc);
		}
		return $this
				->append('iframe')
				->setSrc($src)
				->setSrcdoc($srcdoc)
				->setDimensions($width, $height)
				->setName($name)
				->setSandbox($sandbox)
				->setSeamless($seamless)
				->setAllowfullscreen($allowfullscreen);
	}

	/**
	 * Appends an <code>embed</code> element.
	 *
	 * @param  string  $src     Address of the resource.
	 * @param  string  $type    Type of embedded resource.
	 * @param  int     $width   Horizontal dimension.
	 * @param  int     $height  Vertical dimension.
	 * @return Html5
	 */
	public function embed($src, $type = null, $width = null, $height = null)
	{
		return $this
				->append('embed')
				->setSrc($src)
				->setType($type)
				->setDimensions($width, $height);
	}

	/**
	 * Appends an <code>object</code> element.
	 *
	 * @param  string   $data           Address of the resource.
	 * @param  string   $type           Type of embedded resource (a valid MIME type).
	 * @param  string   $name           Name of nested browsing context.
	 * @param  int      $width          Horizontal dimension.
	 * @param  int      $height         Vertical dimension.
	 * @param  string   $form           Associates the control with a form element.
	 * @param  string   $usemap         Name of image map to use.
	 * @param  boolean  $typemustmatch  Whether the type attribute and the Content-Type value
	 *                                  need to match for the resource to be used.
	 * @return Html5
	 */
	public function object($data = null, $type = null, $name = null,
			$width = null, $height = null, $form = null, $usemap = null, $typemustmatch = false)
	{
		return $this
				->append('object', '')
				->setData($data)
				->setType($type)
				->setName($name)
				->setDimensions($width, $height)
				->setForm($form)
				->setUsemap($usemap)
				->setTypemustmatch($typemustmatch);
	}

	/**
	 * Appends a <code>param</code> element.
	 *
	 * @param  string  $name   Name of parameter.
	 * @param  string  $value  Value of parameter.
	 * @return Html5           The created <code>param</code> element or current element if
	 *                         <code>$value</code> is null or false.
	 */
	public function param($name, $value)
	{
		if ($value === null || $value === false || empty($name)) return $this;
		return $this
				->append('param')
				->setName($name)
				->setValue($value);
	}

	/**
	 * Appends multiple <code>param</code> elements.
	 *
	 * @param  array  $params  The keys are the names.
	 * @return Html5
	 */
	public function params($params)
	{
		foreach ($params as $name => $value) {
			$this->param($name, $value);
		}
		return $this;
	}

	/**
	 * Appends a <code>video</code> element.
	 *
	 * @param  int      $width        Horizontal dimension.
	 * @param  int      $height       Vertical dimension.
	 * @param  string   $src          Address of the resource.
	 * @param  string   $poster       Poster frame to show prior to video playback.
	 * @param  boolean  $autoplay
	 * @param  boolean  $controls     Show user agent controls.
	 * @param  boolean  $loop         Whether to loop the media resource.
	 * @param  boolean  $muted        Whether to mute the media resource by default.
	 * @param  string   $preload      Hints how much buffering the media resource will likely need.
	 *                                See const declarations starting with PRELOAD.
	 * @param  string   $crossorigin  How the element handles crossorigin requests.
	 *                                See const declarations starting with CROSSORIGIN.
	 * @param  string   $mediagroup   Groups media elements together with an implicit
	 *                                MediaController
	 * @return Html5
	 */
	public function video($width = null, $height = null, $src = null, $poster = null,
			$autoplay = false, $controls = false, $loop = false, $muted = false,
			$preload = null, $crossorigin = null, $mediagroup = null)
	{
		return $this
				->append('video', '')
				->setMediagroup($mediagroup)
				->setSrc($src)
				->setDimensions($width, $height)
				->setPoster($poster)
				->setPreload($preload)
				->setAutoplay($autoplay)
				->setControls($controls)
				->setLoop($loop)
				->setMuted($muted)
				->setCrossorigin($crossorigin);
	}

	/**
	 * Appends an <code>audio</code> element.
	 *
	 * @param  string   $src          Address of the resource.
	 * @param  boolean  $autoplay
	 * @param  boolean  $controls     Show user agent controls.
	 * @param  boolean  $loop         Whether to loop the media resource.
	 * @param  boolean  $muted        Whether to mute the media resource by default.
	 * @param  string   $preload      Hints how much buffering the media resource will likely need.
	 *                                See const declarations starting with PRELOAD.
	 * @param  string   $crossorigin  How the element handles crossorigin requests.
	 *                                See const declarations starting with CROSSORIGIN.
	 * @param  string   $mediagroup   Groups media elements together with an implicit
	 *                                MediaController.
	 * @return Html5
	 */
	public function audio($src = null, $autoplay = false, $controls = false, $loop = false,
			$muted = false, $preload = null, $crossorigin = null, $mediagroup = null)
	{
		return $this
				->append('audio', '')
				->setMediagroup($mediagroup)
				->setSrc($src)
				->setPreload($preload)
				->setAutoplay($autoplay)
				->setControls($controls)
				->setLoop($loop)
				->setMuted($muted)
				->setCrossorigin($crossorigin);
	}

	/**
	 * Appends a <code>source</code> element.
	 *
	 * @param  string        $src    Address of the resource.
	 * @param  string        $type   Type of embedded resource.
	 * @param  string|array  $media  Applicable media.
	 * @return Html5
	 */
	public function source($src, $type = null, $media = null)
	{
		return $this
				->append('source')
				->setSrc($src)
				->setType($type)
				->setMedia($media);
	}

	const MIME_MP4 = 'video/mp4; codecs=avc1.42E01E,mp4a.40.2';
	const MIME_OGV = 'video/ogg; codecs=theora,vorbis';
	const MIME_WEBM = 'video/webm; codecs=vp8,vorbis';
	const MIME_AAC = 'audio/mp4; codecs=mp4a.40.2';
	const MIME_MP3 = 'audio/mpeg';
	const MIME_OGG = 'audio/ogg; codecs=vorbis';
	const MIME_WAV = 'audio/wav';

	/**
	 * Appends <code>source</code> elements.
	 *
	 * Example: <code><pre>
	 * ->video(320, 200)->setPoster('media/poster.jpg')->setControls();
	 * ->sources('uploads/1258/%s')
	 * ->appendText('Your Browser doesn't support &hellip;');
	 * </pre></code>
	 * generates: <code><pre>
	 * &lt;video width="320" height="200" poster="media/poster.jpg" controls>
	 *     &lt;source src="uploads/1258/mp4" type="video/mp4; codecs=avc1.42E01E,mp4a.40.2">
	 *     &lt;source src="uploads/1258/webm" type="video/webm; codecs=vp8,vorbis">
	 *     &lt;source src="uploads/1258/ogv" type="video/ogg; codecs=theora,vorbis">
	 *      Your Browser doesn't support &hellip;
	 * &lt;/video></pre></code>
	 *
	 * @param  string        $path
	 * @param  array         $types
	 * @param  string|array  $media  Applicable media.
	 * @return Html5                 The current <code>video</code> or <code>audio</code> element.
	 */
	public function sources($path, $types = null, $media = null)
	{
		$media_types = array(
				'mp4' => self::MIME_MP4,
				'ogv' => self::MIME_OGV,
				'webm' => self::MIME_WEBM,
				'aac' => self::MIME_AAC,
				'mp3' => self::MIME_MP3,
				'ogg' => self::MIME_OGG,
				'wav' => self::MIME_WAV);
		$default_video_formats = array('mp4', 'webm', 'ogv');
		$default_audio_formats = array('mp3', 'ogg');
		if ($types === null) {
			$types = $this->name == 'video' ? $default_video_formats : $default_audio_formats;
		}
		foreach ($types as $key => $val) {
			if (is_int($key)) {
				$file = sprintf($path, $val);
				$type = isset($media_types[$val]) ? $media_types[$val] : null;
			} else {
				$file = sprintf($path, $key);
				$type = $val;
			}
			$this->source($file, $type, $media);
		}
		return $this;
	}

	/**
	 * Appends a <code>track</code> element to a <code>video</code> element.
	 *
	 * @param  string   $src      Address of the resource
	 * @param  string   $kind     The type of text track.<br>Possible values are <ul>
	 *                            <li><code>Html5::KIND_SUBTITLES</code>
	 *                            <li><code>Html5::KIND_CAPTIONS</code>
	 *                            <li><code>Html5::KIND_DESCRIPTIONS</code>
	 *                            <li><code>Html5::KIND_CHAPTERS</code>
	 *                            <li><code>Html5::KIND_METADATA</code>
	 * @param  boolean  $default  Enable the track if no other text track is more suitable.
	 * @param  string   $srclang  Language of the text track
	 * @param  string   $label    User-visible label
	 * @return Html5
	 */
	public function track($src, $kind = null, $default = null, $srclang = null, $label = null)
	{
		return $this
				->append('track')
				->setKind($kind)
				->setSrc($src)
				->setSrclang($srclang)
				->setLabel($label)
				->setDefault($default);
	}

	/**
	 * Appends a <code>map</code> element.
	 *
	 * @param  string  $name  Name of image map to reference from the <code>usemap</code>
	 *                        attribute.
	 * @return Html5
	 */
	public function map($name)
	{
		return $this->append('map')->setName($name);
	}

	/**
	 * Appends an <code>area</code> element to a <code>map</code> element.
	 *
	 * @param  string        $shape     The kind of shape to be created in an image map.<br>
	 *                                  Possible values are <ul>
	 *                                  <li>Html5::SHAPE_RECT
	 *                                  <li>Html5::SHAPE_CIRCLE
	 *                                  <li>Html5::SHAPE_POLY</ul>
	 * @param  string|array  $coords    Coordinates for the shape to be created in an image map
	 *                                  (comma separated).
	 * @param  string        $href      Address of the hyperlink.
	 * @param  string        $alt       Replacement text for use when images are not available.
	 * @param  string        $target    Browsing context for hyperlink navigation.<br>
	 *                                  Possible values are <ul>
	 *                                  <li>Html5::TARGET_BLANK
	 *                                  <li>Html5::TARGET_SELF
	 *                                  <li>Html5::TARGET_PARENT
	 *                                  <li>Html5::TARGET_TOP</ul>
	 * @param  string        $type      Hint for the type of the referenced resource.
	 * @param  string        $download  Whether to download the resource instead of navigating to
	 * 									it, and its file name if so.
	 * @param  string        $rel       Relationship between the document containing the hyperlink
	 *                                  and the destination resource.<br> For example: <ul>
	 *                                  <li>Html5::REL_ALTERNATE<li>Html5::REL_NEXT</ul>
	 * @param  string        $hreflang  Language of the linked resource.
	 * @param  string|array  $ping      URLs to ping (space separated or array).
	 * @return Html5
	 */
	public function area($shape, $coords, $href = null, $alt = null, $target = null,
			$type = null, $download = null, $rel = null, $hreflang = null, $ping = null)
	{
		if ($href !== null && $alt === null) {
			$alt = '';
		}
		return $this
				->append('area')
				->setShape($shape)
				->setCoords($coords)
				->setHref($href)
				->setAlt($alt)
				->setTarget($target)
				->setType($type)
				->setDownload($download)
				->setRel($rel)
				->setHreflang($hreflang)
				->setPing($ping);
	}

	/**
	 * Appends an <code>area</code> element. Shape is Html5::SHAPE_RECT
	 *
	 * @return Html5
	 */
	public function rect($coords, $href = null, $alt = null, $target = null,
			$type = null, $download = false, $rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(self::SHAPE_RECT,
				$coords, $href, $alt, $target, $type, $download, $rel, $hreflang, $ping);
	}

	/**
	 * Appends an <code>area</code> element. Shape is Html5::SHAPE_CIRCLE.
	 *
	 * @return Html5
	 */
	public function circle($coords, $href = null, $alt = null, $target = null,
			$type = null, $download = false, $rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(self::SHAPE_CIRCLE,
				$coords, $href, $alt, $target, $type, $download, $rel, $hreflang, $ping);
	}

	/**
	 * Appends an <code>area</code> element. Shape is Html5::SHAPE_POLY.
	 *
	 * @return Html5
	 */
	public function poly($coords, $href = null, $alt = null, $target = null,
			$type = null, $download = false, $rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(self::SHAPE_POLY,
				$coords, $href, $alt, $target, $type, $download, $rel, $hreflang, $ping);
	}

	//////// Tabular Data ////////

	/**
	 * Appends a <code>table</code> element.
	 *
	 * @return Html5
	 */
	public function table($sortable = false)
	{
		return $this->append('table', '')->setSortable($sortable);
	}

	/**
	 * Appends a <code>caption</code> element.
	 *
	 * @return Html5
	 */
	public function caption($content = '')
	{
		return $this->append('caption', $content);
	}

	/**
	 * Appends a <code>colgroup</code> element.
	 *
	 * @return Html5
	 */
	public function colgroup($span = null)
	{
		if ($span === 0) return $this;
		if ($span == 1) return $this->col();
		return $this->append('colgroup')->setSpan($span);
	}

	/**
	 * Appends a <code>col</code> element.
	 *
	 * @return Html5
	 */
	public function col($span = null)
	{
		return $this
				->append('col')
				->setSpan($span);
	}

	/**
	 * Appends a <code>tbody</code> element.
	 *
	 * @return Html5
	 */
	public function tbody()
	{
		return $this->append('tbody', '');
	}

	/**
	 * Appends a <code>thead</code> element.
	 *
	 * @return Html5
	 */
	public function thead()
	{
		return $this->append('thead', '');
	}

	/**
	 * Appends a <code>tfoot</code> element.
	 *
	 * @return Html5
	 */
	public function tfoot()
	{
		return $this->append('tfoot', '');
	}

	/**
	 * Appends a <code>tr</code> element.
	 *
	 * @return Html5
	 */
	public function tr()
	{
		return $this->append('tr', '');
	}

	/**
	 * Appends a <code>td</code> element
	 * or converts a <code>th</code> element to a <code>td</code> element.
	 *
	 * @return Html5
	 */
	public function td($content = '', $colspan = null, $rowspan = null, $headers = null)
	{
		if ($this->name == 'th') {
			$this->name = 'td';
			$td = $this->setScope(null)->setAbbr(null)->setSorted(null);
		} else {
			$td = $this->append('td', $content);
		}
		return $td
				->setColspan($colspan)
				->setRowspan($rowspan)
				->setHeaders($headers);
	}

	/**
	 * Appends a <code>th</code> element
	 * or converts a <code>td</code> element to a <code>th</code> element.
	 *
	 * @return Html5
	 */
	public function th($content = '', $colspan = null, $rowspan = null,
			$headers = null, $scope = null, $abbr = null, $sorted = null)
	{
		if ($this->name == 'td') {
			$this->name = 'th';
			$th = $this;
		} else {
			$th = $this->append('th', $content);
		}
		return $th
				->setColspan($colspan)
				->setRowspan($rowspan)
				->setHeaders($headers)
				->setScope($scope)
				->setAbbr($abbr)
				->setSorted($sorted);
	}

	public function tcells($data, $keys = null, $cellCallback = null, $cellCallbackData = null)
	{
		if (!is_array($keys)) {
			$keys = \ClacyBuilders\keys($data, $keys);
		}
		$cell = $cellCallback === true ? 'th' : 'td';
		foreach ($keys as $key) {
			$td = $this->$cell(\ClacyBuilders\value($data, $key));
			if (is_callable($cellCallback)) {
				$cellCallback($td, $data, $key, $cellCallbackData);
			}
		}
		return $this;
	}

	public function trow($data, $keys = null,
			$cellCallback = null, $cellCallbackData = null)
	{
		return $this->tr()->tcells($data, $keys, $cellCallback, $cellCallbackData);
	}

	public function trows($data, $keys = null,
			$cellCallback = null, $cellCallbackData = null,
			$rowCallback = null, $rowCallbackData = null)
	{
		$keys = \ClacyBuilders\keys($data[0], $keys);
		foreach ($data as $i => $rowData) {
			$tr = $this->tr();
			if (isset($rowCallback)) {
				$rowCallback($tr, $data, $i, $rowCallbackData);
			}
			$tr->tcells($data[$i], $keys, $cellCallback, $cellCallbackData);
		}
		return $this;
	}

	public function rowspans() {
		// initialize array $tmp
		$tmp = array(); $r = 0;
		foreach ($this->children as $i => $child) {
			$row = array(); $c = 0;
			foreach ($child->children as $c => $td) {
				$row[$c]['cont'] = $td->content;
				$row[$c]['cell'] = null;
				$row[$c]['span'] = 1;
			}
			$tmp[$r++] = $row;
		}
		// find colspans
		for ($c = 0; $c < count($tmp[0]) - 1; $c++) {
			for ($r = 1, $p = 0; $r < count($tmp); $r++, $p++) {
				if ($tmp[$r][$c]['cont'] == $tmp[$p][$c]['cont']) {
					if ($c > 0 && $tmp[$r][$c - 1]['cell'] === null)
						continue;
					$tmp[$r][$c]['span'] = 0;
					if ($tmp[$p][$c]['cell'] === null) {
						$tmp[$r][$c]['cell'] = $p;
					}
					else {
						$tmp[$r][$c]['cell'] = $tmp[$p][$c]['cell'];
					}
					$tmp[$tmp[$r][$c]['cell']][$c]['span'] += 1;
				}
			}
		}

		// change table cells
		for ($r = 0; $r < count($tmp); $r++) {
			for ($c = 0; $c < count($tmp[0]); $c++) {
				if ($tmp[$r][$c]['span'] == 0) {
					$this
							->getChild($r)
							->removeChild($c);
				}
				else if ($tmp[$r][$c]['span'] > 1) {
					$this
							->getChild($r)
							->getChild($c)
							->setRowspan($tmp[$r][$c]['span']);
				}
			}
		}
		return $this;
	}

	//////// Forms ////////

	/**
	 * <code>&lt;form></code>
	 *
	 * @param  string          $action          URL to use for form submission.
	 * @param  string          $method          See <code>setMethod()</code>
	 * @param  string          $enctype         See <code>setEnctype()</code>
	 * @param  string|array    $accept_charset  See <code>setAccept_charset()</code>
	 * @param  string|boolean  $autocomplete    See <code>setAutocomplete()</code>
	 * @param  boolean         $novalidate      See <code>setNovalidate()</code>
	 * @param  string          $target          See <code>setTarget()</code>
	 * @param  string          $name            See <code>setName()</code>
	 * @return Html5
	 */
	public function form($action = null, $method = null, $enctype = null, $accept_charset = null,
			$autocomplete = null, $novalidate = false, $target = null, $name = null)
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
	 * @param  string  $content
	 * @param  string  $for      See setFor()
	 * @param  string  $form     See setForm()
	 * @return Html5
	 */
	public function label($content = '', $for = null, $form = null)
	{
		return $this
				->append('label', $content)
				->setFor($for)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="hidden"></code>
	 *
	 * @param  string  $name   Name of form control to use for form submission
	 *                         and in the form.elements API
	 * @param  mixed   $value  Value of the form control
	 * @param  string  $form   Associates the control with a form element
	 * @return Html5
	 */
	public function hidden($name, $value, $form = null)
	{
		return $this
				->append('input')
				->setType('hidden')
				->setName($name)
				->setValue($value)
				->setForm($form);
	}

	/**
	 * Appends a <code>group of hidden input</code> elements.
	 *
	 * There are different ways to define <code>$names</code> and <code>$values</code>:
	 * <code><pre>
	 * // Ad hoc
	 * $names = array('category', 'items-per-page');
	 * $values = array('Cats', 7);
	 *
	 * // Configuration
	 * $names = null;
	 * $values = array('category' => 'Cats', 'items-per-page' => 7);
	 *
	 * // Database (can also be an array of objects)
	 * $names = array(
	 *         array('id' => 1, 'name' => 'category', 'val' => 'Cats'),
	 *         array('id' => 2, 'name' => 'items-per-page', 'val' => 7)
	 * );
	 * $values = ('name', 'val');
	 * // or
	 * $names = array(
	 *         array('category', 'Cats'),
	 *         array('items-per-page', 7)
	 * );
	 * $values = null;
	 *
	 * $form->hiddens($names, $values);
	 * </pre></code>
	 *
	 * @param  array   $names   See above
	 * @param  array   $values  See above
	 * @param  string  $form    See setForm()
	 * @return Html5
	 */
	public function hiddens($names, $values = null, $form = null)
	{
		list($names, $values) = \ClacyBuilders\arrays($names, $values);
		foreach ($names as $i => $name) {
			$this->hidden($name, $values[$i], $form);
		}
		return $this;
	}

	/**
	 * <code>&lt;input type="text"></code>
	 *
	 * @param  string   $name          See setName()
	 * @param  mixed    $value         See setValue()
	 * @param  string   $placeholder   See setPlaceholder()
	 * @param  int      $minlength     See setMinlength()
	 * @param  int      $maxlength     See setMaxlength()
	 * @param  string   $pattern       See setPattern()
	 * @param  boolean  $required      See setRequired()
	 * @param  string   $list          See setList()
	 * @param  int      $size          See setSize()
	 * @param  string   $autocomplete  See setAutocomplete()
	 * @param  boolean  $readonly      See setReadonly()
	 * @param  boolean  $disabled      See setDisabled()
	 * @param  boolean  $autofocus     See setAutofocus()
	 * @param  string   $dirname       See setDirname()
	 * @param  string   $inputmode     See setInputmode()
	 * @param  string   $form          See setForm()
	 * @return Html5
	 */
	public function text($name = null, $value = null, $placeholder = null, $size = null,
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

	private function checkable($type, $name = null, $value = null, $checked = false,
			$required = false, $disabled = false, $autofocus = false, $form = null)
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
	 * @param  string  	$name       See setName()
	 * @param  mixed    $value      See setValue()
	 * @param  mixed    $checked    See setChecked()
	 * @param  boolean  $required   See setRequired()
	 * @param  mixed    $disabled   See setDisabled()
	 * @param  boolean  $autofocus  See setAutofocus()
	 * @param  string   $form       See setForm()
	 * @return Html5
	 */
	public function checkbox($name = null, $value = null, $checked = false, $required = false,
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
	 * @param  string  	$name       See setName()
	 * @param  mixed    $value      See setValue()
	 * @param  mixed    $checked    See setChecked()
	 * @param  boolean  $required   See setRequired()
	 * @param  mixed    $disabled   See setDisabled()
	 * @param  boolean  $autofocus  See setAutofocus()
	 * @param  string   $form       See setForm()
	 * @return Html5
	 */
	public function radio($name = null, $value = null, $checked = false, $required = false,
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

	private function checkables($type, $name, $values, $labels,
			$checked, $required, $disabled, $autofocus)
	{
		list($values, $labels) = \ClacyBuilders\arrays($values, $labels);
		if ($type == 'checkbox' && count($values) > 1) {
			$name = self::nameForGroup($name);
		}
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
	 * There are different ways to define <code>$values</code> and <code>$labels</code>:<br>
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
	 *<code><pre>
	 *     …
	 *     &lt;label>
	 *         &lt;checkbox name="languages[]" value="c++" checked required>
	 *         &lt;span>C++&lt;/span>
	 *     &lt;/label>
	 *     &lt;label>
	 *         &lt;checkbox name="languages[]" value="java" disabled>
	 *         &lt;span>Java&lt;/span>
	 *     &lt;/label>
	 *     …
	 * </pre></code>
	 *
	 * @see checkbox()
	 * @see radios()
	 * @see options()
	 *
	 * @param  string  $name        See setName()
	 * @param  array   $values      See above
	 * @param  array   $labels      See above
	 * @param  mixed   $checked     Is compared with the value attribute.<br>
	 *                              Set it to <code>true</code>, to check all checkboxes.<br>
	 *                              See setChecked()
	 * @param  boolean  $required   Marks the first item as required.
	 * @param  mixed    $disabled   Is compared with the value attribute.<br>
	 *                              Set it to <code>true</code>, to disable all checkboxes.<br>
	 *                              See setDisabled()
	 * @param  boolean  $autofocus  Marks the first item as autofocus.
	 * @return Html5
	 */
	public function checkboxes($name, $values, $labels = null,
			$checked = [], $required = false, $disabled = [], $autofocus = false)
	{
		return $this->checkables(
				'checkbox', $name, $values, $labels, $checked,
				$required, $disabled, $autofocus);
	}

	/**
	 * Appends a group of radio buttons.
	 *
	 * @param  string   $name       See setName()
	 * @param  array    $values     See checkboxes()
	 * @param  array   	$labels     See checkboxes()
	 * @param  mixed    $checked    Is compared with the value attribute.<br>
	 *                              See setChecked()
	 * @param  boolean  $required   Marks the first item as required.
	 * @param  mixed    $disabled   Is compared with the value attribute.<br>
	 *                              Set it to <code>true</code>, to disable all checkboxes.<br>
	 *                              See setDisabled()
	 * @param  boolean  $autofocus  Marks the first item as autofocus.
	 * @return Html5
	 */
	public function radios($name, $values, $labels = null,
			$checked = [], $required = false, $disabled = [], $autofocus = false)
	{
		return $this->checkables(
				'radio', $name, $values, $labels, $checked,
				$required, $disabled, $autofocus);
	}

	/**
	 * <code>&lt;input type="file"></code>
	 *
	 * @param  string   $name       See setName()
	 * @param  mixed    $accept     See setAccept()
	 * @param  boolean  $multiple   See setMultiple()
	 * @param  boolean  $required   See setRequired()
	 * @param  boolean  $disabled   See setDisabled()
	 * @param  boolean  $autofocus  See setAutofocus()
	 * @param  string   $form       See setForm()
	 * @return Html5
	 */
	public function file($name = null, $accept = null, $multiple = false, $required = false,
			$disabled = false, $autofocus = false, $form = null)
	{
		return $this
				->append('input')
				->setType('file')
				->setName($name)
				->setAccept($accept)
				->setMultiple($multiple)
				->setAutofocus($autofocus)
				->setRequired($required)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="submit"></code>
	 *
	 * @param  string   $value
	 * @param  string   $name            See setName()
	 * @param  boolean  $autofocus       See setAutofocus()
	 * @param  boolean  $disabled        See setDisabled()
	 * @param  string   $formaction      See setFormaction()
	 * @param  string   $formmethod      See setFormmethod()
	 * @param  string   $formenctype     See setFormenctype()
	 * @param  boolean  $formnovalidate  See setFormnovalidate()
	 * @param  string   $formtarget      See setFormtarget()
	 * @param  string   $form            See setForm()
	 * @return Html5
	 */
	public function submit($value, $name = null, $autofocus = false, $disabled = false,
			$formaction = null, $formmethod = null, $formenctype = null,
			$formnovalidate = null, $formtarget = null, $form = null)
	{
		return $this
				->append('input')
				->setType('submit')
				->setName($name)
				->setValue($value)
				->setFormAction($formaction)
				->setFormMethod($formmethod)
				->setFormenctype($formenctype)
				->setFormnovalidate($formnovalidate)
				->setFormtarget($formtarget)
				->setAutofocus($autofocus)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="image"></code>
	 *
	 * @param  string   $src             Address of the resource
	 * @param  string   $alt             Replacement text for use when images are not available
	 * @param  int      $width
	 * @param  int      $height
	 * @param  string   $name            See setName()
	 * @param  boolean  $autofocus       See setAutofocus()
	 * @param  boolean  $disabled        See setDisabled()
	 * @param  string   $formaction      See setFormaction()
	 * @param  string   $formmethod      See setFormmethod()
	 * @param  string   $formenctype     See setFormenctype()
	 * @param  boolean  $formnovalidate  See setFormnovalidate()
	 * @param  string   $formtarget      See setFormtarget()
	 * @param  string   $form            See setForm()
	 * @return Html5
	 */
	public function image($src, $alt, $width = null, $height = null,
			$name = null, $autofocus = false, $disabled = false,
			$formaction = null, $formmethod = null, $formenctype = null,
			$formnovalidate = null, $formtarget = null, $form = null)
	{
		return $this
				->append('input')
				->setType('submit')
				->setName($name)
				->setSrc($src)
				->attrib('alt', $alt)
				->setDimensions($width, $height)
				->setFormAction($formaction)
				->setFormMethod($formmethod)
				->setFormenctype($formenctype)
				->setFormnovalidate($formnovalidate)
				->setFormtarget($formtarget)
				->setAutofocus($autofocus)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="reset"></code>
	 *
	 * @param  string   $value      Value of the form control
	 * @param  string  	$name       See setName()
	 * @param  boolean  $autofocus  See setAutofocus()
	 * @param  boolean  $disabled   See setDisabled()
	 * @param  boolean  $form       See setForm()
	 * @return Html5
	 */
	public function reset($value, $name = null,
			$autofocus = false, $disabled = false, $form = null)
	{
		return $this
				->append('input')
				->setType('reset')
				->setName($name)
				->setValue($value)
				->setAutofocus($autofocus)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;input type="button"></code>
	 *
	 * @param  string   $value      Value of the form control
	 * @param  string   $name       See setName()
	 * @param  boolean  $autofocus  See setAutofocus()
	 * @param  boolean  $disabled   See setDisabled()
	 * @param  boolean  $form       See setForm()
	 * @return Html5
	 */
	public function inpButton($value,
			$name = null, $autofocus = false, $disabled = false, $form = null)
	{
		return $this
		->append('input')
		->setType('button')
		->setName($name)
		->setValue($value)
		->setAutofocus($autofocus)
		->setDisabled($disabled)
		->setForm($form);
	}

	/**
	 * <code>&lt;select></code>
	 *
	 * @see option()
	 * @see optgroup()
	 *
	 * @param  string          $name          Name of form control to use for form submission
	 *                                        and in the form.elements API
	 * @param  boolean         $required      See setRequired()
	 * @param  string|boolean  $autocomplete  See setAutocomplete()
	 * @param  boolean         $disabled      See setDisabled()
	 * @param  boolean         $autofocus     See setAutofocus()
	 * @param  int             $size          See setSize()
	 * @param  boolean         $multiple      See setMultiple()
	 * @param  string          $form          See setForm()
	 * @return Html5
	 */
	public function select($name = null, $required = false, $autocomplete = null,
			$disabled = false, $autofocus = false, $size = null, $multiple = false, $form = null)
	{
		if ($multiple) {
			$name = self::nameForGroup($name);
		}
		return $this
				->append('select', '')
				->setName($name)
				->setMultiple($multiple)
				->setAutocomplete($autocomplete)
				->setSize($size)
				->setAutofocus($autofocus)
				->setRequired($required)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * <code>&lt;option></code>
	 *
	 * @see options()
	 * @see select()
	 * @see datalist()
	 * @see optgroup()
	 *
	 * @param  string          $content
	 * @param  string          $value     See setValue()
	 * @param  boolean         $selected  See setSelected()
	 * @param  boolean         $disabled  See setDisabled()
	 * @param  string|boolean  $label     User-visible label<br>Set it to <code>true</code>
	 *                                    to use <code>$content</code> as label attribute
	 * @return Html5
	 */
	public function option($content = null, $value = null,
			$selected = false, $disabled = false, $label = false)
	{
		if ($label === true) {
			$label = $content;
			$content = null;
		}
		return $this
				->append('option', $content)
				->attrib('label', $label)
				->setValue($value)
				->setSelected($selected)
				->setDisabled($disabled);
	}

	/**
	 * Appends a <code>group of option</code> elements.
	 *
	 * @see option()
	 *
	 * @param  array        $values             See checkboxes()
	 * @param  array        $labels             See checkboxes()
	 * @param  mixed|array  $selected           Is compared with the value attribute.<br>
	 *                                          See setSelected()
	 * @param  mixed|array  $disabled           Is compared with the value attribute.<br>
	 *                                          See setDisabled()
	 * @param  boolean      $useLabelAttribute  Set it to <code>true</code> to use label
	 *                                          attribute
	 * @return Html5
	 */
	public function options($values, $labels = null,
			$selected = false, $disabled = false, $useLabelAttribute = false)
	{
		list($values, $labels) = \ClacyBuilders\arrays($values, $labels);
		foreach ($values as $i => $value) {
			$this->option(
					$labels[$i], $value, $selected, $disabled,
					$useLabelAttribute);
		}
		return $this;
	}

	/**
	 *
	 * @param  string   $content
	 * @param  string   $name          Name of form control to use for form submission
	 *                                 and in the <code>form.elements</code> API
	 * @param  int      $cols          Maximum number of characters per line
	 * @param  int      $rows          Number of lines to show
	 * @param  string   $wrap          How the value of the form control is to be wrapped
	 *                                 for form submission
	 * @param  string   $placeholder   User-visible label to be placed within the form control
	 * @param  int      $minlength     Minimum length of value
	 * @param  int      $maxlength     Maximum length of value
	 * @param  boolean  $required      Whether the control is required for form submission
	 * @param  string   $autocomplete  Hint for form autofill feature
	 * @param  boolean  $readonly      Whether to allow the value to be edited by the user
	 * @param  boolean  $disabled      Whether the form control is disabled
	 * @param  boolean  $autofocus     Automatically focus the form control when the page is loaded
	 * @param  string   $dirname       Name of form field to use for sending the element's
	 *                                 directionality in form submission
	 * @param  string   $inputmode     Hint for selecting an input modality
	 * @param  string   $form          Associates the control with a <code>form<code> element
	 * @return Html5
	 */
	public function textarea($content = '',
			$name = null, $cols = null, $rows = null, $wrap = null,
			$placeholder = null, $minlength = null, $maxlength = null,
			$required = false, $autocomplete = null, $readonly = false,
			$disabled = false, $autofocus = false, $dirname = null,
			$inputmode = null, $form = null)
	{
		return $this->append('textarea', $content)
				->setName($name)
				->setCols($cols)
				->setRows($rows)
				->setWrap($wrap)
				->setPlaceholder($placeholder)
				->setMinlength($minlength)
				->setMaxlength($maxlength)
				->setRequired($required)
				->setAutocomplete($autocomplete)
				->setReadonly($readonly)
				->setDisabled($disabled)
				->setAutofocus($autofocus)
				->setDirname($dirname)
				->setInputmode($inputmode)
				->setForm($form);
	}

	/**
	 * The <code>fieldset</code> element.
	 *
	 * The <code>fieldset</code> element represents a set of form controls optionally grouped
	 * under a common name.
	 *
	 * @param  string   $name      Name of form control to use in the
	 *                             <code>form.elements</code> API</p>
	 * @param  boolean  $disabled  Whether the form control is disabled.
	 * @param  string   $form      Associates the control with a <code>form</code> element.
	 * @return Html5
	 */
	public function fieldset($name = null, $disabled = false, $form = null)
	{
		return $this->append('fieldset')
				->setName($name)
				->setDisabled($disabled)
				->setForm($form);
	}

	/**
	 * The <code>legend</code> element.
	 *
	 * The <code>legend</code> element represents a caption for the rest of the contents
	 * of the <code>legend</code> element's parent <code>fieldset</code> element, if any.
	 *
	 * @param  string  $content
	 * @return Html5
	 */
	public function legend($content = '')
	{
		return $this->append('legend', $content);
	}

	//////// Attributes ////////

	/**
	 * Alternative label to use for the header cell when referencing the cell
	 * in other contexts.
	 *
	 * @see th()
	 *
	 * @param  string  $abbr
	 * @return Html5
	 */
	public function setAbbr($abbr)
	{
		return $this->attrib('abbr', $abbr);
	}

	const ACCEPT_IMAGE = 'image/*';
	const ACCEPT_VIDEO = 'video/*';
	const ACCEPT_AUDIO = 'audio/*';

	/**
	 * Sets the <code>accept</code> attribute.
	 *
	 * @param  string|array  $accept  Hint for expected file type in file upload controls
	 *                                (space separated or in an array).
	 *                                Possible values: <ul><li><code>HTML5::ACCEPT_IMAGE</code>
	 *                                <li><code>HTML5::ACCEPT_VIDEO</code>
	 *                                <li><code>HTML5::ACCEPT_AUDIO</code>
	 *                                <li>A valid MIME type with no parameters
	 *                                <li>File extension: A string whose first character is a full
	 *                                stop (.)</ul>
	 * @return Html5
	 */
	public function setAccept($accept)
	{
		return $this->complexAttrib('accept', $accept, ',', true);
	}

	/**
	 * Character encodings to use for form submission (space separated or in an array).
	 *
	 * @see form()
	 *
	 * @param  string|array  $accept_charset
	 * @return Html5
	 */
	public function setAccept_charset($accept_charset)
	{
		return $this->complexAttrib('accept-charset', $accept_charset, ' ', true);
	}

	public function setAllowfullscreen($allowfullscreen = false)
	{
		return $this->attrib('allowfullscreen', $allowfullscreen);
	}

	public function setAlt($alt)
	{
		return $this->attrib('alt', $alt);
	}

	const AUTOCOMPLETE_ON = 'on';
	const AUTOCOMPLETE_OFF = 'off';

	/**
	 * Sets the <code>autocomplete</code> attribute.
	 * <ul>
	 * <li><code>form()</code>:<br>
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
	 * @param  string|boolean  $autocomplete
	 * @return Html5
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
	 * @param  boolean  $autofocus
	 * @return Html5
	 */
	public function setAutofocus($autofocus = true)
	{
		return $this->attrib('autofocus', $autofocus);
	}

	/**
	 * Hint that the media resource can be started automatically when the page
	 * is loaded.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param  boolean  $autoplay
	 * @return Html5
	 */
	public function setAutoplay($autoplay = true)
	{
		return $this->attrib('autoplay', $autoplay);
	}

	/**
	 * Link to the source of the quotation or more information about the edit.
	 *
	 * @see ins()
	 * @see del()
	 *
	 * @param  string  $cite
	 * @return Html5
	 */
	public function setCite($cite)
	{
		return $this->attrib('cite', $cite);
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
	 * @param  mixed  $checked
	 * @return Html5
	 */
	public function setChecked($checked = true)
	{
		return $this->booleanAttrib('checked', $checked, 'value');
	}

	public  function setCols($cols)
	{
		return $this->attrib('cols', $cols);
	}

	/**
	 * Number of columns that the cell is to span.
	 *
	 * @see td()
	 * @see th()
	 *
	 * @param  int  $colspan
	 * @return Html5
	 */
	public function setColspan($colspan)
	{
		return $this->attrib('colspan', $colspan > 1 ? $colspan : null);
	}

	/**
	 * Show user agent controls.
	 *
	 * @see video()
	 * @see audio()
	 * @return Html5
	 */
	public function setControls($controls = true)
	{
		return $this->attrib('controls', $controls);
	}

	public function setCoords($coords)
	{
		return $this->complexAttrib('coords', $coords, ',');
	}

	const CROSSORIGIN_ANONYMOUS = 'anonymous';
	const CROSSORIGIN_USE_CREDENTIALS = 'use-credentials';

	/**
	 * Sets the crossorigin attribute.
	 *
	 * @see link()
	 * @see img()
	 * @see video()
	 * @see audio()
	 *
	 * @param  string  $value
	 * @return Html5
	 */
	public function setCrossorigin($value)
	{
		return $this->attrib('crossorigin', $value);
	}


	/**
	 * Address of the resource
	 *
	 * @see object()
	 *
	 * @param  string  $data
	 * @return Html5
	 */
	public function setData($data, $name = null)
	{
		if ($name !== null) {
			return $this->attrib('data-' . $name, $data);
		}
		return $this->attrib('data', $data);
	}

	public function setDatetime($datetime)
	{
		return $this->attrib('datetime', $datetime);
	}

	public function setDefault($default = true)
	{
		return $this->attrib('default', $default);
	}

	const DIR_LTR = 'ltr';
	const DIR_RTL = 'rtl';
	const DIR_AUTO = 'auto';

	public function setDir($dir)
	{
		return $this->attrib('dir', $dir);
	}

	/**
	 * Enables the submission of the directionality of the element, and gives the name of the field
	 * that contains this value during form submission.
	 *
	 * @see text()
	 * @see search()
	 * @see textarea()
	 *
	 * @param  string  $dirname
	 * @return Html5
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
	 * @param  mixed  $disabled
	 * @return Html5
	 */
	public function setDisabled($disabled = true)
	{
		return $this->booleanAttrib('disabled', $disabled, 'value');
	}

	/**
	 * Sets the <code>download</code> attribute.
	 *
	 * @see a()
	 * @see area()
	 *
	 * @param  string $filename
	 * @return Html5
	 */
	public function setDownload($filename)
	{
		return $this->attrib('download', $filename);
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
	 * @param  string  $enctype
	 * @return Html5
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
	 * @param  string  $for
	 * @return Html5
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
	 * @param  string  $form
	 * @return Html5
	 */
	public function setForm($form)
	{
		return $this->attrib('form', $form);
	}

	/**
	 * URL to use for form submission.
	 *
	 * @see submit()
	 *
	 * @param  string  $formaction
	 * @return Html5
	 */
	public function setFormaction($formaction)
	{
		return $this->attrib('formaction', $formaction);
	}

	/**
	 * Form data set encoding type to use for form submission
	 *
	 * @see submit()
	 * @see setEnctype()
	 *
	 * @param  string  $formenctype
	 * @return Html5
	 */
	public function setFormenctype($formenctype)
	{
		return $this->attrib('formenctype', $formenctype);
	}

	/**
	 * HTTP method to use for form submission.
	 *
	 * @see submit()
	 * @see setMethod()
	 *
	 * @param  string  $formmethod
	 * @return Html5
	 */
	public function setFormmethod($formmethod)
	{
		return $this->attrib('formmethod', $formmethod);
	}

	/**
	 * Bypass form control validation for form submission.
	 *
	 * @see submit()
	 * @see setNovalidate()
	 *
	 * @param  string  $formnovalidate
	 * @return Html5
	 */
	public function setFormnovalidate($formnovalidate)
	{
		return $this->attrib('formnovalidate', $formnovalidate);
	}

	/**
	 * Browsing context for form submission.
	 *
	 * @see submit()
	 * @see setTarget()
	 *
	 * @param  string  $formtarget
	 * @return Html5
	 */
	public function setFormtarget($formtarget)
	{
		return $this->attrib('formtarget', $formtarget);
	}

	/**
	 * The header cells for this cell (space separated or in an array).
	 *
	 * @see td()
	 * @see th()
	 *
	 * @param  string|array  $headers
	 * @return Html5
	 */
	public function setHeaders($headers)
	{
		return $this->complexAttrib('headers', $headers, ' ', true);
	}

	/**
	 * Vertical dimension.
	 *
	 * @see image()
	 *
	 * @param  int  $height
	 * @return Html5
	 */
	public function setHeight($height)
	{
		return $this->attrib('height', $height);
	}

	/**
	 * @param  string  $href
	 * @return Html5
	 */
	public function setHref($href)
	{
		return $this->attrib('href', $href);
	}

	/**
	 * Language of the linked resource.
	 *
	 * @see link()
	 * @see alternate()
	 * @see a()
	 * @see area()
	 *
	 * @param  string  $hreflang
	 * @return Html5
	 */
	public function setHreflang($hreflang)
	{
		return $this->attrib('hreflang', $hreflang);
	}

	public function setId($id)
	{
		return $this->attrib('id', $id);
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
	 * @param  string  $inputmode
	 * @return Html5
	 */
	public function setInputmode($inputmode)
	{
		return $this->attrib('inputmode', $inputmode);
	}

	public function setIsmap($ismap = true)
	{
		return $this->attrib('ismap', $ismap);
	}

	const KIND_SUBTITLES = 'subtitles';
	const KIND_CAPTIONS = 'captions';
	const KIND_DESCRIPTIONS = 'descriptions';
	const KIND_CHAPTERS = 'chapters';
	const KIND_METADATA = 'metadata';

	public function setKind($kind)
	{
		return $this->attrib('kind', $kind);
	}

	public function setLabel($label)
	{
		return $this->attrib('label', $label);
	}

	public function setLang($lang)
	{
		return static::HTML_MODE ? $this->attrib('lang', $lang) : parent::setLang($lang);
	}

	/**
	 * Identifies a list of autocomplete options.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param  string  $list
	 * @return Html5
	 */
	public function setList($list)
	{
		return $this->attrib('list', $list);
	}

	/**
	 * Whether to loop the media resource.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param  boolean  $loop
	 * @return Html5
	 */
	public function setLoop($loop = true)
	{
		return $this->attrib('loop', $loop);
	}

	/**
	 * Maximum length of value.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param  int  $maxlength
	 * @return Html5
	 */
	public function setMaxlength($maxlength)
	{
		return $this->attrib('maxlength', $maxlength);
	}

	/**
	 * Sets the mediagroup attribute.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param  string  $group
	 * @return Html5
	 */
	public function setMediagroup($group)
	{
		return $this->attrib('mediagroup', $group);
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
	 * @param  string  $method
	 * @return Html5
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
	 * @param  int  $minlength
	 * @return Html5
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
	 * @param  boolean  $multiple
	 * @return Html5
	 */
	public function setMultiple($multiple = true)
	{
		return $this->attrib('multiple', $multiple);
	}

	/**
	 * Whether to mute the media resource by default.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param  boolean  $muted
	 * @return Html5
	 */
	public function setMuted($muted = true)
	{
		return $this->attrib('muted', $muted);
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
	 * @param  string  $name
	 * @return Html5
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
	 * @param  boolean  $novalidate
	 * @return Html5
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
	 * @param  string  $pattern
	 * @return Html5
	 */
	public function setPattern($pattern)
	{
		return $this->attrib('pattern', $pattern);
	}

	/**
	 * Sets the ping attribute.
	 *
	 * @see a()
	 * @see area().
	 *
	 * @param  string|array  $urls
	 * @return Html5
	 */
	public function setPing($urls)
	{
		return $this->complexAttrib('ping', $urls, ' ', true);
	}

	/**
	 * User-visible label to be placed within the form control.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param  string  $placeholder
	 * @return Html5
	 */
	public function setPlaceholder($placeholder)
	{
		return $this->attrib('placeholder', $placeholder);
	}

	/**
	 * Sets the poster attribute.
	 *
	 * @see video()
	 *
	 * @param  boolean  $poster
	 * @return Html5
	 */
	public function setPoster($source) {
		return $this->attrib('poster', $source);
	}

	const PRELOAD_AUTO = 'auto';
	const PRELOAD_METADATA = 'metadata';
	const PRELOAD_NONE = 'none';

	/**
	 * Sets the preload attribute.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param  string  $value
	 * @return Html5
	 */
	public function setPreload($value)
	{
		return $this->attrib('preload', $value);
	}

	/**
	 * Whether to allow the value to be edited by the user.
	 *
	 * @see text()
	 * @see search()
	 *
	 * @param  boolean  $readonly
	 * @return Html5
	 */
	public function setReadonly($readonly = true)
	{
		return $this->attrib('readonly', $readonly);
	}

	const REL_ALTERNATE = 'alternate';
	const REL_AUTHOR = 'author';
	const REL_BOOKMARK = 'bookmark';
	const REL_EXTERNAL = 'external';
	const REL_HELP = 'help';
	const REL_ICON = 'icon';
	const REL_LICENSE = 'license';
	const REL_NEXT = 'next';
	const REL_NOFOLLOW = 'nofollow';
	const REL_NOREFERRER = 'noreferrer';
	const REL_NOOPENER = 'noopener';
	const REL_PINGBACK = 'pingback';
	const REL_PREFETCH = 'prefetch';
	const REL_PREV = 'prev';
	const REL_SEARCH = 'search';
	const REL_SIDEBAR = 'sidebar';
	const REL_STYLESHEET = 'stylesheet';
	const REL_TAG = 'tag';

	/**
	 * Relationship between the document containing the hyperlink and the destination resource.
	 *
	 * Possible values are the constants starting with REL_.
	 *
	 * @see link()
	 * @see a()
	 * @see area()
	 *
	 * @param  string  $rel
	 * @return Html5
	 */
	public function setRel($rel)
	{
		return $this->complexAttrib('rel', $rel, ' ', true);
	}


	/**
	 * Whether the control is required for form submission.
	 *
	 * @param  boolean  $required
	 * @return Html5
	 */
	public function setRequired($required = true)
	{
		return $this->attrib('required', $required);
	}

	/**
	 * Number the list backwards.
	 *
	 * @see ol()
	 *
	 * @param  boolean  $reversed
	 * @return Html5
	 */
	public function setReversed($reversed = true)
	{
		return $this->attrib('reversed', $reversed);
	}

	public function setRows($rows)
	{
		return $this->attrib('rows', $rows);
	}

	/**
	 * Number of rows that the cell is to span.
	 *
	 * @see td()
	 * @see th()
	 *
	 * @param  int  $rowspan
	 * @return Html5
	 */
	public function setRowspan($rowspan)
	{
		return $this->attrib('rowspan', $rowspan > 1 ? $rowspan : null);
	}

	const SANDBOX_FORMS = 'allow-forms';
	const SANDBOX_POINTER_LOCK = 'allow-pointer-lock';
	const SANDBOX_POPUPS = 'allow-popups';
	const SANDBOX_SAME_ORIGIN = 'allow-same-origin';
	const SANDBOX_SCRIPTS = 'allow-scripts';
	const SANDBOX_TOP_NAVIGATION = 'allow-top-navigation';

	public function setSandbox($sandbox)
	{
		return $this->complexAttrib('sandbox', $sandbox, ' ', true);
	}

	const SCOPE_COL = 'col';
	const SCOPE_COLGROUP = 'colgroup';
	const SCOPE_ROW = 'row';
	const SCOPE_ROWGROUP = 'rowgroup';

	/**
	 * Specifies which cells the header cell applies to.
	 *
	 * Possible values are <ul>
	 * <li>Html5::SCOPE_COL
	 * <li>Html5::SCOPE_COLGROUP
	 * <li>Html5::SCOPE_ROW
	 * <li>Html5::SCOPE_ROWGROUP</ul>
	 *
	 * @see th()
	 *
	 * @param  string  $scope
	 * @return Html5
	 */
	public function setScope($scope)
	{
		return $this->attrib('scope', $scope);
	}

	/**
	 * Sets the srclang attribute.
	 *
	 * @see track()
	 *
	 * @param  string  $language
	 * @return Html5
	 */
	public function setSrclang($language)
	{
		return $this->attrib('srclang', $language);
	}

	/**
	 * Whether the styles apply to the entire document or just the parent subtree.
	 *
	 * @see style()
	 *
	 * @param  string  $scoped
	 * @return Html5
	 */
	public function setScoped($scoped = true)
	{
		return $this->attrib('scoped', $scoped);
	}

	public function setSeamless($seamless = false)
	{
		return $this->attrib('seamless', $seamless);
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
	 * @param  mixed  $selected
	 * @return Html5
	 */
	public function setSelected($selected = true)
	{
		return $this->booleanAttrib('selected', $selected, 'value');
	}

	const SHAPE_RECT = 'rect';
	const SHAPE_CIRCLE = 'circle';
	const SHAPE_POLY = 'poly';

	/**
	 * The kind of shape to be created in an image map.
	 * Possible values are <ul>
	 * <li>Html5::SHAPE_RECT
	 * <li>Html5::SHAPE_CIRCLE
	 * <li>Html5::SHAPE_POLY</ul>
	 *
	 * @see area()
	 * @param  string  $shape
	 * @return Html5
	 */
	public function setShape($shape)
	{
		return $this->attrib('shape', $shape);
	}

	/**
	 * Size of the control.
	 *
	 * @see text()
	 * @see search()
	 * @see select()
	 *
	 * @param  int  $size
	 * @return Html5
	 */
	public function setSize($size)
	{
		return $this->attrib('size', $size);
	}

	/**
	 * Sizes of the icons.
	 *
	 * @see icon()
	 * @see shortcut_icon()
	 *
	 * @param  string  $sizes
	 * @return Html5
	 */
	public function setSizes($sizes)
	{
		return $this->attrib('sizes', $sizes);
	}

	/**
	 * Indicates that the user agent is to allow the user to sort the table.
	 *
	 * @see table()
	 *
	 * @param  boolean  $sortable
	 * @return Html5
	 */
	public function setSortable($sortable = true)
	{
		return $this->attrib('sortable', $sortable);
	}

	const SORTED_REVERSED = 'reversed';

	/**
	 * Column sort direction and ordinality.
	 *
	 * <code>"-1"</code> become <code>"1 reversed"</code>,
	 * <code>"0"</code> become <code>"reversed"</code>
	 *
	 * @see th()
	 *
	 * @param  int|string  $sorted
	 * @return Html5
	 */
	public function setSorted($sorted)
	{
		if (is_int($sorted)) {
			if ($sorted < 0) {
				$sorted = -$sorted . ' ' . self::SORTED_REVERSED;
			}
			else if ($sorted == 0) {
				$sorted = self::SORTED_REVERSED;
			}
		}
		return $this->attrib('sorted', $sorted);
	}

	/**
	 * Number of columns spanned by the element.
	 *
	 * @see colgroup()
	 * @see col()
	 *
	 * @param  int  $span
	 * @return Html5
	 */
	public function setSpan($span)
	{
		return $this->attrib('span', $span);
	}

	/**
	 * Address of the resource.
	 *
	 * @see image()
	 *
	 * @param  string  $src
	 * @return Html5
	 */
	public function setSrc($src)
	{
		return $this->attrib('src', $src);
	}

	public function setSrcdoc($srcdoc)
	{
		return $this->attrib('srcdoc', $srcdoc);
	}

	public function setSrcset($srcset)
	{
		return $this->complexAttrib('srcset', $srcset, ',', true);
	}

	/**
	 * Ordinal value of the first item.
	 *
	 * @see ol()
	 *
	 * @param  int  $start
	 * @return Html5
	 */
	public function setStart($start)
	{
		return $this->attrib('start', $start);
	}

	const TARGET_BLANK = '_blank';
	const TARGET_SELF = '_self';
	const TARGET_PARENT = '_parent';
	const TARGET_TOP = '_top';

	/**
	 * Browsing context for hyperlink navigation or form submission.
	 *
	 * Possible values are: <ul>
	 * <li><code>HTML5::TARGET_BLANK</code>
	 * <li><code>HTML5::TARGET_SELF</code>
	 * <li><code>HTML5::TARGET_PARENT</code>
	 * <li><code>HTML5::TARGET_TOP</code>
	 * <li>framename</ul>
	 *
	 * @see base()
	 * @see a()
	 * @see area()
	 * @see form()
	 *
	 * @param  string  $target
	 * @return Html5
	 */
	public function setTarget($target)
	{
		return $this->attrib('target', $target);
	}

	const TYPE_DECIMAL = '1';
	const TYPE_LOWER_ALPHA = 'a';
	const TYPE_UPPER_ALPHA = 'A';
	const TYPE_LOWER_ROMAN = 'i';
	const TYPE_UPPER_ROMAN = 'I';

	/**
	 * Whether the type attribute and the Content-Type value need to match
	 * for the resource to be used.
	 *
	 * @see object()
	 *
	 * @param  boolean  $typemustmatch
	 * @return Html5
	 */
	public function setTypemustmatch($typemustmatch = true)
	{
		return $this->attrib('typemustmatch', $typemustmatch);
	}

	/**
	 * Name of image map to use.
	 *
	 * @see img()
	 * @see object()
	 *
	 * @param  string  $usemap
	 * @return Html5
	 */
	public function setUsemap($usemap) {
		if (!empty($usemap) && substr($usemap, 0, 1) != '#') {
			$usemap = '#' . $usemap;
		}
		return $this->attrib('usemap', $usemap);
	}

	/**
	 * <ul>
	 * <li><code>li</code>:<br>Ordinal value of the list item
	 * <li><code>data</code>:<br>Machine-readable value
	 * <li><code>param</code>:<br>Value of parameter
	 * <li><code>checkbox()</code>, <code>radio()</code>:<br>Value of the form control
	 * <li><code>option</code>:<br>Value to be used for form submission
	 * </ul>
	 *
	 * @param  string|int  $value
	 * @return Html5
	 */
	public function setValue($value)
	{
		return $this->attrib('value', $value);
	}

	const WRAP_SOFT = 'soft';
	const WRAP_HARD = 'hard';

	/**
	 *
	 * @param  string  $wrap
	 * @return Html5
	 */
	public function setWrap($wrap = self::WRAP_HARD)
	{
		return $this->attrib('wrap', $wrap);
	}
}
