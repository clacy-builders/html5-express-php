<?php
namespace ML_Express\HTML5;

use ML_Express\Xml;
use ML_Express\Shared\ClassAttribute;
use ML_Express\Shared\StyleAttribute;

class Html5 extends Xml
{
	use ClassAttribute, StyleAttribute;

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

	//////// Document metadata ////////

	/**
	 * A head element.
	 */
	public function head()
	{
		$head = $this->append('head', '');
		if (static::SGML_MODE) {
			$head->charset();
		}
		return $head;
	}

	/**
	 * A title element.
	 *
	 * @param    string    $title
	 */
	public function title($title)
	{
		return $this->append('title', $title);
	}

	/**
	 * A base element.
	 *
	 * @param    string         $href      Document base URL.
	 * @param    string|null    $target    Default browsing context for hyperlink
	 *                                     navigation and form submission.<br>
	 *                                     See const declarations starting with TARGET.
	 */
	public function base($href, $target = null)
	{
		return $this
				->append('base')
				->setHref($href)
				->setTarget($target);
	}

	/**
	 * A link element.
	 * @todo crossorigin attribute
	 *
	 * @param    string         $rel         Relationship between the document containing
	 *                                       the hyperlink and the destination resource.
	 *                                       See const declarations starting with REL.
	 * @param    string         $href        Address of the hyperlink.
	 * @param    string|null    $title       Title of the link.
	 * @param    string|null    $type        Hint for the type of the referenced resource.
	 * @param    string|null    $hreflang    Language of the linked resource.
	 * @param    string|null    $media       Applicable media.
	 * @param    string|null    $sizes       Sizes of the icons (for `rel="icon"`).
	 */
	public function link(
			$rel, $href, $title = null, $type = null,
			$hreflang = null, $media = null, $sizes = null)
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
	 * @param    string         $href         Address of the hyperlink.
	 * @param    string|null    $media        Applicable media.
	 * @param    string|null    $title        Title of the link.
	 * @param    boolean        $alternate    Whether it is an alternate stylesheet or not.
	 */
	public function stylesheet($href, $media = null, $title = null, $alternate = false)
	{
		$rel = ($alternate ? 'alternate ' : '') . 'stylesheet';
		return $this->link($rel, $href, $title, null, null, $media);
	}

	/**
	 * A css link.
	 *
	 * @param    string         $href         Address of the hyperlink.
	 * @param    string|null    $media        Applicable media.
	 * @param    string|null    $title        Title of the link.
	 * @param    boolean        $alternate    Whether it is an alternate stylesheet or not.
	 */
	public function css($href, $media = null, $title = null, $alternate = false)
	{
		return $this->stylesheet($href, $media, $title, $alternate);
	}

	/**
	 * A link to an alternative version of the page.
	 *
	 * @param    string         $href        Address of the hyperlink.
	 * @param    string|null    $title       Title of the link.
	 * @param    string|null    $type        Hint for the type of the referenced resource.
	 * @param    string|null    $hreflang    Language of the linked resource.
	 * @param    string|null    $media       Applicable media.
	 */
	public function alternate($href, $title = null, $type = null, $hreflang = null, $media = null)
	{
		return $this->link('alternate', $href, $title, $type, $hreflang, $media);
	}

	/**
	 * A atom feed link.
	 *
	 * @param    string         $href     Address of the hyperlink.
	 * @param    string|null    $title    Title of the link.
	 */
	public function atom($href, $title = null)
	{
		return $this->alternate($href, $title, 'application/atom+xml');
	}

	/**
	 * A rss-feed link
	 *
	 * @param    string         $href     Address of the hyperlink.
	 * @param    string|null    $title    Title of the link.
	 */
	public function rss($href, $title = null)
	{
		return $this->alternate($href, $title, 'application/rss+xml');
	}

	/**
	 * A link to a favicon.
	 *
	 * @param    string         $href        Address of the hyperlink.
	 * @param    string|null    $type        Hint for the type of the referenced resource.
	 * @param    string|null    $sizes       Sizes of the icons.
	 * @param    boolean        $shortcut    Whether to use the <code>shortcut</code> keyword
	 *                                       or not.
	 */
	public function icon($href = 'favicon.ico', $type = null, $sizes = null, $shortcut = false)
	{
		$rel = $shortcut ? 'shortcut icon' : 'icon';
		return $this->link($rel, $href, null, $type, null, null, $sizes);
	}

	/**
	 * A link to a favicon using <code>shortcut icon</code>.
	 *
	 * @param    string         $href     Address of the hyperlink.
	 * @param    string|null    $type     Hint for the type of the referenced resource.
	 * @param    string|null    $sizes    Sizes of the icons.
	 */
	public function shortcut_icon($href = 'favicon.ico', $type = null, $sizes = null)
	{
		return $this->icon($href, $type, $sizes, true);
	}

	/**
	 * A meta element.
	 *
	 * @param    string    $name
	 * @param    string    $content
	 */
	public function meta($name, $content)
	{
		return $this
				->append('meta')
				->setName($name)
				->setContent($content);
	}

	/**
	 * A meta element giving the name of the web application
	 * that the page represents.
	 *
	 * @param    string    $application_name
	 */
	public function application_name($application_name)
	{
		return $this->meta('application-name', $application_name);
	}

	/**
	 * A meta element giving the name of one of the page's authors.
	 *
	 * @param    string    $author
	 */
	public function author($author)
	{
		return $this->meta('author', $author);
	}

	/**
	 * A meta element that describes the page for use in a directory
	 * of pages, e.g. in a search engine.
	 *
	 * @param    string    $description
	 */
	public function description($description)
	{
		return $this->meta('description', $description);
	}

	/**
	 * A meta element that identifies one of the software packages
	 * used to generate the document.
	 *
	 * @param    string    $generator
	 */
	public function generator($generator)
	{
		return $this->meta('generator', $generator);
	}

	/**
	 * A meta element defining keywords relevant to the page.
	 *
	 * @param    string|string[]    $keywords    A string containing comma-separated
	 *                                           tokens, or an array of these tokens.
	 */
	public function keywords($keywords)
	{
		return $this->meta('keywords', \ML_Express\join($keywords, ','));
	}

	/**
	 * A pragma directive.
	 *
	 * @param    string    $http_equiv    Pragma directive.
	 * @param    string    $content       Value of the element.
	 */
	public function pragma($http_equiv, $content)
	{
		return $this
				->append('meta')
				->attrib('http-equiv', $http_equiv)
				->setContent($content);
	}

	/**
	 * A pragma directive which acts as timed redirect.
	 *
	 * @param    string|int     $seconds
	 * @param    string|null    $url
	 */
	public function refresh($seconds, $url = null)
	{
		if ($url) {
			$seconds .= '; URL=' . $url;
		}
		return $this->pragma('refresh', $seconds);
	}

	/**
	 * A meta element specifying the document's character encoding.
	 */
	public function charset()
	{
		if (!static::SGML_MODE) return $this;
		return $this
				->append('meta')
				->attrib('charset', static::CHARACTER_ENCODING);
	}

	/**
	 * A style element.
	 *
	 * @param    string|array    $content    The embeded style information.
	 * @param    boolean         $scoped
	 * @param    string|null     $media      Applicable media.
	 * @param    string|null     $type       Type of embedded resource.
	 */
	public function style(
			$content, $scoped = false,
			$media = null, $type = null)
	{
		return $this
				->append('style')
				->setType($type)
				->setMedia($media)
				->setScoped($scoped)
				->appendLines($content);
	}

	//////// Sections ////////

	/** A body element. */
	public function body()
	{
		return $this->append('body');
	}

	/** An article element. */
	public function article()
	{
		return $this->append('article');
	}

	/** A section element. */
	public function section()
	{
		return $this->append('section');
	}

	/** A nav element. */
	public function nav()
	{
		return $this->append('nav');
	}

	/** An aside element. */
	public function aside()
	{
		return $this->append('aside');
	}

	/**
	 * A h1 element.
	 *
	 * @param    string    $content
	 */
	public function h1($content = '')
	{
		return $this->append('h1', $content);
	}

	/**
	 * A h2 element.
	 *
	 * @param    string    $content
	 */
	public function h2($content = '')
	{
		return $this->append('h2', $content);
	}

	/**
	 * A h3 element.
	 *
	 * @param    string    $content
	 */
	public function h3($content = '')
	{
		return $this->append('h3', $content);
	}

	/**
	 * A h4 element.
	 *
	 * @param    string    $content
	 */
	public function h4($content = '')
	{
		return $this->append('h4', $content);
	}

	/**
	 * A h5 element.
	 *
	 * @param    string    $content
	 */
	public function h5($content = '')
	{
		return $this->append('h5', $content);
	}

	/**
	 * A h6 element.
	 *
	 * @param    string    $content
	 */
	public function h6($content = '')
	{
		return $this->append('h6', $content);
	}

	/** A hgroup element. */
	public function hgroup()
	{
		return $this->append('hgroup');
	}

	/** A header element. */
	public function header()
	{
		return $this->append('header');
	}

	/** A footer element */
	public function footer()
	{
		return $this->append('footer');
	}

	/** An address element */
	public function address()
	{
		return $this->append('address');
	}

	//////// Grouping Content ////////

	/**
	 * A p element.
	 *
	 * @param string $content
	 */
	public function p($content = '')
	{
		return $this->append('p', $content);
	}

	/**
	 * A hr element.
	 */
	public function hr()
	{
		return $this->append('hr');
	}

	/**
	 * A pre element
	 *
	 * @param string $content
	 */
	public function pre($content = '')
	{
		return $this->append('pre', $content)->in_line();
	}

	/**
	 * A blockquote element.
	 *
	 * @param string $cite A valid URL potentially surrounded by space.
	 */
	public function blockquote($content = '', $cite = null)
	{
		return $this->append('blockquote', $content)->setCite($cite);
	}

	/**
	 * An ol element.
	 *
	 * @param    string|null    $type        Kind of list marker.
	 *                                       See const declarations starting with TYPE.
	 * @param    int|null       $start       Ordinal value of the first item.
	 * @param    bool           $reversed    Number the list backwards.
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
	 * An ul element.
	 */
	public function ul()
	{
		return $this->append('ul');
	}

	/**
	 * A li element.
	 *
	 * @param    string      $content
	 * @param    int|null    $value      Ordinal value of the list item.
	 */
	public function li($content = '', $value = null)
	{
		return $this->append('li', $content)->setValue($value);
	}

	/**
	 * Appends <code>li</code> elements.
	 *
	 * @param items array
	 * <p>An array containing the contents for the list elements.</p>
	 *
	 * @param valueAttribute boolean [optional]
	 * <p>Whether to use integer keys as value attribute or not.</p>
	 */
	public function liItems($items, $valueAttribute = false)
	{
		foreach ($items as $value => $content) {
			$this->li($content, $valueAttribute && is_int($value) ? $value : null);
		}
		return $this;
	}

	/**
	 * A dl element.
	 */
	public function dl()
	{
		return $this->append('dl');
	}

	/**
	 * A dt element.
	 *
	 * @param string $content
	 */
	public function dt($content = '')
	{
		return $this->append('dt', $content);
	}

	/**
	 * A dd element
	 *
	 * @param string $content
	 */
	public function dd($content = '')
	{
		return $this->append('dd', $content);
	}

	/**
	 * A figure element.
	 */
	public function figure()
	{
		return $this->append('figure');
	}

	/**
	 * A figcaption element.
	 *
	 * @param string $content
	 */
	public function figcaption($content = '')
	{
		return $this->append('figcaption', $content);
	}

	/**
	 * A main element.
	 */
	public function main()
	{
		return $this->append('main');
	}

	/**
	 * A div element.
	 *
	 * @param string $content
	 */
	public function div($content = '') {
		return $this->append('div', $content);
	}

	//////// Text-level semantics ////////

	/**
	 * An a element.
	 *
	 * @param    string               $content
	 * @param    string               $href        Address of the hyperlink
	 * @param    string|null          $target      Browsing context for hyperlink navigation.
	 *                                             See const declarations starting with TARGET.
	 * @param    string|null          $rel         Relationship between the document containing
	 *                                             the hyperlink and the destination resource.
	 * @param    string|null          $type        Hint for the type of the referenced resource.
	 * @param    string|null          $hreflang    Language of the linked resource.
	 * @param    string|array|null    $ping        URLs to ping (space separated or array).
	 * @param    string|null          $download    Whether to download the resource instead of
	 *                                             navigating to it, and its file name if so.
	 */
	public function a(
			$content, $href,
			$target = null, $rel = null, $type = null,
			$hreflang = null, $ping = null, $download = null)
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
	 * Adds a query string to the href attribute.
	 *
	 * For example: <code><pre>
	 * $li->a('index.php')->addQuery(array(
	 *         's' => 'lorem ipsum',
	 *         'cat' => 'cats & dogs'
	 * ));
	 * </pre></code>
	 *
	 * @param array $queryParts Assotiave array with query arguments.
	 */
	public function addQuery($queryParts) {
		$href = $this->attributes->getAttrib('href');

		$query = array();
		foreach ($queryParts as $key => $value) {
			if (empty($value)) continue;
			$query[] = $key . '=' . urlencode($value);
		}
		$prefix = strpos($href, '?') === false ? '?' : '&';
		$query = $prefix . implode('&', $query);

		$position = strpos($href, '#');
		if ($position === false) {
			return $this->setHref($href . $query);
		}
		return $this->setHref(substr_replace($href, $query, $position, 0));
	}

	/**
	 * An em element.
	 *
	 * @param string $content
	 */
	public function em($content = '')
	{
		return $this->append('em', $content);
	}

	/**
	 * A strong element.
	 *
	 * @param string $content
	 */
	public function strong($content = '')
	{
		return $this->append('strong', $content);
	}

	/**
	 * A small element.
	 *
	 * @param string $content
	 */
	public function small($content = '')
	{
		return $this->append('small', $content);
	}

	/**
	 * A s element.
	 *
	 * @param string $content
	 */
	public function s($content = '')
	{
		return $this->append('s', $content);
	}

	/**
	 * A cite element.
	 *
	 * @param string $content
	 */
	public function cite($content = '')
	{
		return $this->append('cite', $content);
	}

	/**
	 * A q element.
	 *
	 * @param    string         $content
	 * @param    string|null    $cite       Link to the source of the quotation
	 *                                      or more information about the edit.
	 */
	public function q($content = '', $cite = null)
	{
		return $this->append('q', $content)->setCite($cite);
	}

	/**
	 * A dfn element.
	 *
	 * @param    string         $content
	 * @param    string|null    $title      The term being defined.
	 */
	public function dfn($content = '', $title = null)
	{
		return $this->append('dfn', $content)->setTitle($title);
	}

	/**
	 * An abbr element.
	 *
	 * @param    string         $content
	 * @param    string|null    $title      Full term or expansion of abbreviation.
	 */
	public function abbr($content = '', $title = null)
	{
		return $this->append('abbr', $content)->setTitle($title);
	}

	/**
	 * A data element.
	 *
	 * @param    string        $content
	 * @param    mixed|null    $value      Machine-readable value.
	 */
	public function data($content = '', $value = null)
	{
		return $this->append('data', $content)->setValue($value);
	}

	/**
	 * A time element.
	 *
	 * @param    string         $content
	 * @param    string|null    $datetime    Machine-readable value.
	 */
	public function time($content = '', $datetime = null)
	{
		return $this->append('time', $content)
				->setDatetime($datetime == $content ? null : $datetime);
	}

	/**
	 * A code element.
	 *
	 * @param string $content
	 */
	public function code($content = '')
	{
		return $this->append('code', $content);
	}

	/**
	 * A pre element, to which a code element will be appended.
	 *
	 * For example: <code><pre>
	 *     $section
	 *             ->codeblock($html->getMarkup(), '  ')
	 *             ->setClass('html5');
	 * </pre></code>
	 *
	 * @param    string         $content
	 * @param    string|null    $spaces    Replacement for tabs.
	 */
	public function codeblock($content, $spaces = '    ')
	{
		if ($spaces !== null) {
			$content = str_replace("\t", $spaces, $content);
		}
		$content = htmlspecialchars($content);
		return $this->pre()->code($content);
	}

	/**
	 * A var element.
	 *
	 * @param string $content
	 */
	public function v($content = '')
	{
		return $this->append('var', $content);
	}

	/**
	 * A samp element.
	 *
	 * @param string $content
	 */
	public function samp($content = '')
	{
		return $this->append('samp', $content);
	}

	/**
	 * A kbd element.
	 *
	 * @param string $content
	 */
	public function kbd($content = '')
	{
		return $this->append('kbd', $content);
	}

	/**
	 * A sub element.
	 *
	 * @param string $content
	 */
	public function sub($content = '')
	{
		return $this->append('sub', $content);
	}

	/**
	 * A sup element.
	 *
	 * @param string $content
	 */
	public function sup($content = '')
	{
		return $this->append('sup', $content);
	}

	/**
	 * An i element.
	 *
	 * @param string $content
	 */
	public function i($content = '')
	{
		return $this->append('i', $content);
	}

	/**
	 * A b element.
	 *
	 * @param string $content
	 */
	public function b($content = '')
	{
		return $this->append('b', $content);
	}

	/**
	 * An u element.
	 *
	 * @param string $content
	 */
	public function u($content = '')
	{
		return $this->append('u', $content);
	}

	/**
	 * A mark element.
	 *
	 * @param string $content
	 */
	public function mark($content = '')
	{
		return $this->append('mark', $content);
	}

	/**
	 * A ruby element.
	 *
	 * @param string $content
	 */
	public function ruby($content = '')
	{
		return $this->append('ruby', $content);
	}

	/**
	 * A rt element.
	 *
	 * @param string $content
	 */
	public function rt($content = '')
	{
		return $this->append('rt', $content);
	}

	/**
	 * A rp element.
	 *
	 * @param string $content
	 */
	public function rp($content = '')
	{
		return $this->append('rp', $content);
	}

	/**
	 * A bdi element
	 *
	 * @param    string         $content
	 * @param    string|null    $dir        @todo explaining text
	 *                                      See const declarations starting with DIR.
	 */
	public function bdi($content = '', $dir = null)
	{
		return $this->append('bdi', $content)->setDir($dir);
	}

	/**
	 * A bdo element.
	 *
	 * @param    string         $content
	 * @param    string|null    $dir        @todo explaining text
	 *                                      See const declarations starting with DIR.
	 */
	public function bdo($content = '', $dir = null)
	{
		return $this->append('bdo', $content)->setDir($dir);
	}

	/**
	 * A span element.
	 *
	 * @param string $content
	 */
	public function span($content = '')
	{
		return $this->append('span', $content);
	}

	/**
	 * A br element.
	 */
	public function br()
	{
		return $this->append('br');
	}

	/**
	 * A wbr element.
	 */
	public function wbr()
	{
		return $this->append('wbr');
	}

	//////// Edits ////////

	/**
	 * Appends ins element.
	 *
	 * @param string         $content
	 * @param string|null    $datetime    Date and (optionally) time of the change.
	 * @param string|null    $cite        Link to the source of the quotation or more
	 *                                    information about the edit.
	 */
	public function ins($content = '', $datetime = null, $cite = null)
	{
		return $this
				->append('ins', $content)
				->setCite($cite)
				->setDatetime($datetime);
	}

	/**
	 * Appends del element.
	 *
	 * @param string         $content
	 * @param string|null    $datetime    Date and (optionally) time of the change.
	 * @param string|null    $cite        Link to the source of the quotation or more
	 *                                    information about the edit.
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
	 * An img element.
	 * @todo crossorigin attribute
	 *
	 * @param    string                  $src       Address of the resource.
	 * @param    string                  $alt       Replacement text for use when images are not
	 *                                              available.
	 * @param    string|string[]|null    $srcset    Images to use in different situations
	 *                                              (e.g. high-resolution displays,
	 *                                              small monitors, etc)
	 * @param    int|null                $width     Horizontal dimension.
	 * @param    int|null                $height    Vertical dimension.
	 * @param    string|null             $usemap
	 * @param    boolean                 $ismap     Whether the image is a server-side image map.
	 */
	public function img(
			$src, $alt = '', $srcset = null, $width = null, $height = null,
			$usemap = null, $ismap = false)
	{
		return $this
				->append('img')
				->setSrc($src)
				->setSrcset($srcset)
				->setAlt($alt)
				->setWidth($width)
				->setHeight($height)
				->setUsemap($usemap)
				->setIsmap($ismap);
	}

	/**
	 * An iframe element.
	 *
	 * For example: <code><pre>
	 * $body->iframe(
	 *         'inframe.html', 960, 320, 'myframe',
	 *         [Html5::SANDBOX_TOP_NAVIGATION, Html5::SANDBOX_FORMS]);
	 * </pre></code>
	 *
	 * @param    string|null             $src                Address of the resource.
	 * @param    integer|null            $width              Horizontal dimension.
	 * @param    integer|null            $height             Vertical dimension.
	 * @param    string|null             $name               Name of nested browsing context.
	 * @param    string|array|boolean    $sandbox            Security rules for nested content.
	 *                                                       The <code>SANDBOX</code> Constants
	 *                                                       space-separated or in an array.
	 * @param    boolean                 $seamless           Whether to apply the document's styles
	 *                                                       to the nested content.
	 * @param    string|null             $srcdoc             A document to render in the iframe.
	 * @param    boolean                 $allowfullscreen    Whether to allow the iframe's contents
	 *                                                       to use
	 *                                                       <code>requestFullscreen()</code>.
	 */
	public function iframe(
			$src = null, $width = null, $height = null,
			$name = null, $sandbox = false, $seamless = false,
			$srcdoc = null, $allowfullscreen = false)
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
				->setWidth($width)
				->setHeight($height)
				->setName($name)
				->setSandbox($sandbox)
				->setSeamless($seamless)
				->setAllowfullscreen($allowfullscreen);
	}

	/**
	 * An embed element.
	 *
	 * @param    string         $src       Address of the resource.
	 * @param    string|null    $type      Type of embedded resource.
	 * @param    int|null       $width     Horizontal dimension.
	 * @param    int|null       $height    Vertical dimension.
	 */
	public function embed($src, $type = null, $width = null, $height = null)
	{
		return $this
				->append('embed')
				->setSrc($src)
				->setType($type)
				->setWidth($width)
				->setHeight($height);
	}

	/**
	 * An object element.
	 *
	 * @param    string|null    $data             Address of the resource.
	 * @param    string|null    $type             Type of embedded resource (a valid MIME type).
	 * @param    string|null    $name             Name of nested browsing context.
	 * @param    int|null       $width            Horizontal dimension.
	 * @param    int|null       $height           Vertical dimension.
	 * @param    string|null    $form             Associates the control with a form element.
	 * @param    string|null    $usemap           Name of image map to use.
	 * @param    boolean        $typemustmatch    Whether the type attribute and the
	 *                                            Content-Type value need to match for the
	 *                                            resource to be used.
	 */
	public function object(
			$data = null, $type = null, $name = null, $width = null,
			$height = null, $form = null, $usemap = null,
			$typemustmatch = false)
	{
		return $this
				->append('object', '')
				->setData($data)
				->setType($type)
				->setName($name)
				->setWidth($width)
				->setHeight($height)
				->setForm($form)
				->setUsemap($usemap)
				->setTypemustmatch($typemustmatch);
	}

	/**
	 * A param element.
	 *
	 * @param     string    $name     Name of parameter.
	 * @param     string    $value    Value of parameter.
	 * @return    Xml       The created param element or current element if <code>$value</code> is
	 *                      null or false.
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
	 * Appends param elements.
	 *
	 * @param    array    $params    The keys are the names.
	 */
	public function params($params)
	{
		foreach ($params as $name => $value) {
			$this->param($name, $value);
		}
		return $this;
	}

	/**
	 * A video element.
	 *
	 * @param    int|null       $width          Horizontal dimension.
	 * @param    int|null       $height         Vertical dimension.
	 * @param    string|null    $src            Address of the resource.
	 * @param    string|null    $poster         Poster frame to show prior to video playback.
	 * @param    boolean        $autoplay
	 * @param    boolean        $controls       Show user agent controls.
	 * @param    boolean        $loop           Whether to loop the media resource.
	 * @param    boolean        $muted          Whether to mute the media resource by default.
	 * @param    string|null    $preload        Hints how much buffering the media resource
	 *                                          will likely need.
	 *                                          See const declarations starting with PRELOAD.
	 * @param    string|null    $crossorigin    How the element handles crossorigin requests.
	 *                                          See const declarations starting with CROSSORIGIN.
	 * @param    string|null    $mediagroup     Groups media elements together with an
	 *                                          implicit MediaController
	 */
	public function video(
			$width = null, $height = null, $src = null, $poster = null,
			$autoplay = false, $controls = false, $loop = false, $muted = false,
			$preload = null, $crossorigin = null, $mediagroup = null)
	{
		return $this
				->append('video', '')
				->setMediagroup($mediagroup)
				->setSrc($src)
				->setWidth($width)
				->setHeight($height)
				->setPoster($poster)
				->setPreload($preload)
				->setAutoplay($autoplay)
				->setControls($controls)
				->setLoop($loop)
				->setMuted($muted)
				->setCrossorigin($crossorigin);
	}

	/**
	 * An audio element.
	 *
	 * @param    string|null    $src            Address of the resource.
	 * @param    boolean        $autoplay
	 * @param    boolean        $controls       Show user agent controls.
	 * @param    boolean        $loop           Whether to loop the media resource.
	 * @param    boolean        $muted          Whether to mute the media resource by default.
	 * @param    string|null    $preload        Hints how much buffering the media resource
	 *                                          will likely need.
	 *                                          See const declarations starting with PRELOAD.
	 * @param    string|null    $crossorigin    How the element handles crossorigin requests.
	 *                                          See const declarations starting with CROSSORIGIN.
	 * @param    string|null    $mediagroup     Groups media elements together with an
	 *                                          implicit MediaController
	 */
	public function audio(
			$src = null, $autoplay = false, $controls = false, $loop = false,
			$muted = false, $preload = null, $crossorigin = null,
			$mediagroup = null)
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
	 * A source element.
	 *
	 * @param    string               $src      Address of the resource.
	 * @param    string|null          $type     Type of embedded resource.
	 * @param    string|array|null    $media    Applicable media.
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
	 * Appends source elements (to a video or audio element).
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
	 * @param    string               $path
	 * @param    array|null           $types
	 * @param    string|array|null    $media    Applicable media.
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
			$types =
					$this->name == 'video'
					? $default_video_formats
					: $default_audio_formats;
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
	 * A track element to a video element.
	 *
	 * @param    string     $src        Address of the resource
	 * @param    string     $kind       The type of text track.<br>Possible values are <ul>
	 *                                  <li>Html5::KIND_SUBTITLES
	 *                                  <li>Html5::KIND_CAPTIONS
	 *                                  <li>Html5::KIND_DESCRIPTIONS
	 *                                  <li>Html5::KIND_CHAPTERS
	 *                                  <li>Html5::KIND_METADATA
	 * @param    boolean    $default    Enable the track if no other text track is more suitable.
	 * @param    string     $srclang    Language of the text track
	 * @param    string     $label      User-visible label
	 */
	public function track(
			$src, $kind = null, $default = null, $srclang = null,
			$label = null)
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
	 * A map element.
	 *
	 * @see area()
	 * @see rect()
	 * @see circle()
	 * @see poly()
	 *
	 * @param    string    $name    Name of image map to reference from the usemap attribute.
	 */
	public function map($name)
	{
		return $this->append('map')->setName($name);
	}

	/**
	 * An area element to a map element.
	 *
	 * @param    string                $shape       The kind of shape to be created in an image
	 *                                              map.<br>
	 *                                              Possible values are <ul>
	 *                                              <li>Html5::SHAPE_RECT
	 *                                              <li>Html5::SHAPE_CIRCLE
	 *                                              <li>Html5::SHAPE_POLY.
	 *                                              </ul>
	 * @param    string|array          $coords      Coordinates for the shape to be created
	 *                                              in an image map (comma separated).
	 * @param    string|null           $href        Address of the hyperlink.
	 * @param    string|null           $alt         Replacement text for use when images are not
	 *                                              available.
	 * @param    string|null           $target      Browsing context for hyperlink navigation.<br>
	 *                                              Possible values are <ul>
	 *                                              <li>Html5::TARGET_BLANK
	 *                                              <li>Html5::TARGET_SELF
	 *                                              <li>Html5::TARGET_PARENT
	 *                                              <li>Html5::TARGET_TOP
	 *                                              </ul>
	 * @param    string|null           $type        Hint for the type of the referenced resource.
	 * @param    string|null           $download    Whether to download the resource instead of
	 *                                              navigating to it, and its file name if so.
	 * @param    string|null           $rel         Relationship between the document containing
	 *                                              the hyperlink and the destination resource.<br>
	 *                                              For example: <ul>
	 *                                              <li>Html5::REL_ALTERNATE
	 *                                              <li>Html5::REL_NEXT
	 *                                              </ul>
	 * @param    string|null           $hreflang    Language of the linked resource.
	 * @param    string|array|null     $ping        URLs to ping (space separated or array).
	 */
	public function area(
			$shape, $coords, $href = null, $alt = null,
			$target = null, $type = null, $download = null,
			$rel = null, $hreflang = null, $ping = null)
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
	 * An area element. Shape is Html5::SHAPE_RECT
	 */
	public function rect(
			$coords, $href = null, $alt = null,
			$target = null, $type = null, $download = false,
			$rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(
				self::SHAPE_RECT, $coords, $href, $alt, $target,
				$type, $download, $rel, $hreflang, $ping
		);
	}

	/**
	 * An area element. Shape is Html5::SHAPE_CIRCLE.
	 */
	public function circle(
			$coords, $href = null, $alt = null,
			$target = null, $type = null, $download = false,
			$rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(
				self::SHAPE_CIRCLE, $coords, $href, $alt, $target,
				$type, $download, $rel, $hreflang, $ping
		);
	}

	/**
	 * An area element. Shape is Html5::SHAPE_POLY.
	 */
	public function poly(
			$coords, $href = null, $alt = null,
			$target = null, $type = null, $download = false,
			$rel = null, $hreflang = null, $ping = null)
	{
		return $this->area(
				self::SHAPE_POLY, $coords, $href, $alt, $target, $type,
				$download, $rel, $hreflang, $ping
		);
	}

	//////// Tabular Data ////////

	/**
	 * A table element.
	 */
	public function table($sortable = false)
	{
		return $this->append('table', '')->setSortable($sortable);
	}

	/**
	 * A caption element.
	 */
	public function caption($content = '')
	{
		return $this->append('caption', $content);
	}

	/**
	 * A colgroup element.
	 */
	public function colgroup($span = null)
	{
		if ($span === 0) return $this;
		if ($span == 1) return $this->col();
		return $this->append('colgroup')->setSpan($span);
	}

	/**
	 * A col element.
	 */
	public function col($span = null)
	{
		return $this
				->append('col')
				->setSpan($span);
	}

	/**
	 * A tbody element.
	 */
	public function tbody()
	{
		return $this->append('tbody', '');
	}

	/**
	 * A thead element.
	 */
	public function thead()
	{
		return $this->append('thead', '');
	}

	/**
	 * A tfoot element.
	 */
	public function tfoot()
	{
		return $this->append('tfoot', '');
	}

	/**
	 * A tr element.
	 */
	public function tr()
	{
		return $this->append('tr', '');
	}

	/**
	 * A td element or converts a th element to a td element.
	 */
	public function td(
			$content = '', $colspan = null, $rowspan = null,
			$headers = null)
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
	 * A th element or converts a td element to a th element.
	 */
	public function th(
			$content = '', $colspan = null, $rowspan = null,
			$headers = null, $scope = null, $abbr = null,
			$sorted = null)
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

	public function tcells($data, $keys = null,
			$cellCallback = null, $cellCallbackData = null)
	{
		if (!is_array($keys)) {
			$keys = \ML_Express\keys($data, $keys);
		}
		$cell = $cellCallback === true ? 'th' : 'td';
		foreach ($keys as $key) {
			$td = $this->$cell(\ML_Express\value($data, $key));
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
		$keys = \ML_Express\keys($data[0], $keys);
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
	 * <code>&lt;input type="hidden"></code>
	 *
	 * @param    string         $name     Name of form control to use for form submission and
	 *                                    in the form.elements API
	 * @param    mixed          $value    Value of the form control
	 * @param    string|null    $form     Associates the control with a form element
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
	 * Appends a group of hidden input elements.
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
	 * @param    array          $names     See above
	 * @param    array|null     $values    See above
	 * @param    string|null    $form      See setForm()
	 */
	public function hiddens($names, $values = null, $form = null)
	{
		list($names, $values) = \ML_Express\arrays($names, $values);
		foreach ($names as $i => $name) {
			$this->hidden($name, $values[$i], $form);
		}
		return $this;
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

	private function checkables($type, $name, $values, $labels,
			$checked, $required, $disabled, $autofocus)
	{
		list($values, $labels) = \ML_Express\arrays($values, $labels);
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
	 * @param    string        $name         See setName()
	 * @param    array         $values       See above
	 * @param    array|null    $labels       See above
	 * @param    mixed         $checked      Is compared with the value attribute.<br>
	 *                                       Set it to <code>true</code>,
	 *                                       to check all checkboxes.<br>
	 *                                       See setChecked()
	 * @param    boolean       $required     Marks the first item as required.
	 * @param    mixed         $disabled     Is compared with the value attribute.<br>
	 *                                       Set it to <code>true</code>,
	 *                                       to disable all checkboxes.<br>
	 *                                       See setDisabled()
	 * @param    boolean       $autofocus    Marks the first item as autofocus.
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
	 * @param    string        $name         See setName()
	 * @param    array         $values       See checkboxes()
	 * @param    array|null    $labels       See checkboxes()
	 * @param    mixed         $checked      Is compared with the value attribute.<br>
	 *                                       See setChecked()
	 * @param    boolean       $required     Marks the first item as required.
	 * @param    mixed         $disabled     Is compared with the value attribute.<br>
	 *                                       Set it to <code>true</code>,
	 *                                       to disable all checkboxes.<br>
	 *                                       See setDisabled()
	 * @param    boolean       $autofocus    Marks the first item as autofocus.
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
	 * @param    string|null    $name         See setName()
	 * @param    mixed|null     $accept       See setAccept()
	 * @param    boolean        $multiple     See setMultiple()
	 * @param    boolean        $required     See setRequired()
	 * @param    boolean        $disabled     See setDisabled()
	 * @param    boolean        $autofocus    See setAutofocus()
	 * @param    string|null    $form         See setForm()
	 */
	public function file(
			$name = null, $accept = null, $multiple = false, $required = false,
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
	 * @param    string $value
	 * @param    string|null    $name              See setName()
	 * @param    boolean        $autofocus         See setAutofocus()
	 * @param    boolean        $disabled          See setDisabled()
	 * @param    string|null    $formaction        See setFormaction()
	 * @param    string|null    $formmethod        See setFormmethod()
	 * @param    string|null    $formenctype       See setFormenctype()
	 * @param    boolean        $formnovalidate    See setFormnovalidate()
	 * @param    string|null    $formtarget        See setFormtarget()
	 * @param    string|null    $form              See setForm()
	 */
	public function submit(
			$value, $name = null, $autofocus = false, $disabled = false,
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
	 * @param    string         $src               Address of the resource
	 * @param    string|null    $alt               Replacement text for use when images are not
	 *                                             available
	 * @param    int|null       $width             See setWidth()
	 * @param    int|null       $height            See setHeight()
	 * @param    string|null    $name              See setName()
	 * @param    boolean        $autofocus         See setAutofocus()
	 * @param    boolean        $disabled          See setDisabled()
	 * @param    string|null    $formaction        See setFormaction()
	 * @param    string|null    $formmethod        See setFormmethod()
	 * @param    string|null    $formenctype       See setFormenctype()
	 * @param    boolean        $formnovalidate    See setFormnovalidate()
	 * @param    string|null    $formtarget        See setFormtarget()
	 * @param    string|null    $form              See setForm()
	 */
	public function image(
			$src, $alt, $width = null, $height = null,
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
		->setWidth($width)
		->setHeight($height)
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
	 * @param    string         $value        Value of the form control
	 * @param    string|null    $name         See setName()
	 * @param    boolean        $autofocus    See setAutofocus()
	 * @param    boolean        $disabled     See setDisabled()
	 * @param    boolean        $form         See setForm()
	 */
	public function reset(
			$value, $name = null, $autofocus = false, $disabled = false,
			$form = null)
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
	 * @param    string         $value        Value of the form control
	 * @param    string|null    $name         See setName()
	 * @param    boolean        $autofocus    See setAutofocus()
	 * @param    boolean        $disabled     See setDisabled()
	 * @param    boolean        $form         See setForm()
	 */
	public function inpButton(
			$value, $name = null, $autofocus = false, $disabled = false,
			$form = null)
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
	 * @param    string|null            $name            Name of form control to use
	 *                                                   for form submission and in the
	 *                                                   form.elements API
	 * @param    boolean                $required        See setRequired()
	 * @param    string|boolean|null    $autocomplete    See setAutocomplete()
	 * @param    boolean                $disabled        See setDisabled()
	 * @param    boolean                $autofocus       See setAutofocus()
	 * @param    int|null               $size            See setSize()
	 * @param    boolean                $multiple        See setMultiple()
	 * @param    string|null            $form            See setForm()
	 */
	public function select(
			$name = null, $required = false, $autocomplete = null,
			$disabled = false, $autofocus = false, $size = null,
			$multiple = false, $form = null)
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
	 * @param    string|null       $content
	 * @param    string|null       $value       See setValue()
	 * @param    boolean           $selected    See setSelected()
	 * @param    boolean           $disabled    See setDisabled()
	 * @param    string|boolean    $label       User-visible label<br>Set it to <code>true</code>
	 *                                          to use <code>$content</code> as label attribute
	 */
	public function option(
			$content = null, $value = null, $selected = false,
			$disabled = false, $label = false)
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
	 * Appends a group of option elements.
	 *
	 * @see option()
	 *
	 * @param    array          $values               See checkboxes()
	 * @param    array|null     $labels               See checkboxes()
	 * @param    mixed|array    $selected             Is compared with the value attribute.<br>
	 *                                                See setSelected()
	 * @psaram    mixed|array    $disabled             Is compared with the value attribute.<br>
	 *                                                See setDisabled()
	 * @param    boolean        $useLabelAttribute    Set it to <code>true</code> to use label
	 *                                                attribute
	 */
	public function options(
			$values, $labels = null, $selected = false,
			$disabled = false, $useLabelAttribute = false)
	{
		list($values, $labels) = \ML_Express\arrays($values, $labels);
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
	 * @param name string [optional]
	 * <p>Name of form control to use in the <code>form.elements</code> API</p>
	 *
	 * @param disabled boolean [optional]
	 * <p>Whether the form control is disabled</p>
	 *
	 * @param form string [optional]
	 * <p>Associates the control with a <code>form</code> element</p>
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
	 * @param content string [optional]
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
	 * @param string $abbr
	 */
	public function setAbbr($abbr)
	{
		return $this->attrib('abbr', $abbr);
	}

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
	public function setAccept($accept)
	{
		return $this->complexAttrib('accept', $accept, ',', true);
	}

	/**
	 * Character encodings to use for form submission (space separated or in an
	 * array).
	 *
	 * @see form()
	 *
	 * @param    string|array    $accept_charset
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
	 * Hint that the media resource can be started automatically when the page
	 * is loaded.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param boolean $autoplay
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
	 * @param string $cite
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
	 * @see checkbox()
	 * @see radio()
	 * @see checkboxes()
	 * @see radios()
	 *
	 * @param    mixed    $checked
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
	 * @param int $colspan
	 */
	public function setColspan($colspan)
	{
		return $this->attrib('colspan', $colspan > 1 ? $colspan : null);
	}

	/**
	 * Value of the element.
	 *
	 * @see meta()
	 *
	 * @param string $content
	 */
	public function setContent($content)
	{
		return $this->attrib('content', $content);
	}

	/**
	 * Show user agent controls.
	 *
	 * @see video()
	 * @see audio()
	 */
	public function setControls($controls = true)
	{
		return $this->attrib('controls', $controls);
	}

	public function setCoords($coords)
	{
		return $this->attrib('coords', \ML_Express\join($coords, ','));
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
	 * @param string $value
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
	 * @param string $data
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
		return $this->booleanAttrib('disabled', $disabled, 'value');
	}

	/**
	 * Sets the download attribute.
	 *
	 * @see a()
	 * @see area()
	 *
	 * @param  string $filename
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
	 * URL to use for form submission.
	 *
	 * @see submit()
	 *
	 * @param    string    $formaction
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
	 * @param    string    $formenctype
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
	 * @param    string    $formmethod
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
	 * @param    string    $formnovalidate
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
	 * @param    string    $formtarget
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
	 * @param string|array $headers
	 */
	public function setHeaders($headers)
	{
		return $this->attrib('headers', \ML_Express\join($headers));
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

	/**
	 * <ul>
	 * <li><code>link()</code>, <code>a()</code>, <code>area()</code><br>Address of the hyperlink
	 * <li><code>base()</code><br>Document base URL
	 *
	 * @param    string    $href
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
	 * @param string $hreflang
	 */
	public function setHreflang($hreflang)
	{
		return $this->attrib('hreflang', $hreflang);
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
	 * Whether to loop the media resource.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param boolean $loop
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
	 * @param    int    $maxlength
	 */
	public function setMaxlength($maxlength)
	{
		return $this->attrib('maxlength', $maxlength);
	}

	const MEDIA_ALL = 'all';
	const MEDIA_AURAL = 'aural';
	const MEDIA_BRAILLE = 'braille';
	const MEDIA_HANDHELD = 'handheld';
	const MEDIA_PROJECTION = 'projection';
	const MEDIA_PRINT = 'print';
	const MEDIA_SCREEN = 'screen';
	const MEDIA_TTY = 'tty';
	const MEDIA_TV = 'tv';

	/**
	 * @see link()
	 * @see stylesheet()
	 * @see css()
	 * @see alternate()
	 * @see style()
	 * @see source()
	 * @see sources()
	 *
	 * @param    string|array    $media
	 */
	public function setMedia($media)
	{
		return $this->attrib('media', \ML_Express\join($media, ','));
	}

	/**
	 * Sets the mediagroup attribute.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param string $group
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
	 * Whether to mute the media resource by default.
	 *
	 * @see video()
	 * @see audio()
	 *
	 * @param boolean $muted
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
	 * Sets the ping attribute.
	 *
	 * @see a()
	 * @see area().
	 *
	 * @param string|array $urls
	 */
	public function setPing($urls)
	{
		return $this->attrib('ping', \ML_Express\join($urls));
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
	 * Sets the poster attribute.
	 *
	 * @see video()
	 *
	 * @param boolean $poster
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
	 * @param string $value
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
	 * @param    boolean    $readonly
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
	const REL_PINGBACK = 'pingback';
	const REL_PREFETCH = 'prefetch';
	const REL_PREV = 'prev';

	/**
	 * Relationship between the document containing the hyperlink and the destination resource.
	 *
	 * Possible values are the constants starting with REL_.
	 *
	 * @see link()
	 * @see a()
	 * @see area()
	 *
	 * @param    string    $rel
	 */
	public function setRel($rel)
	{
		return $this->attrib('rel', $rel);
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
	 * Number the list backwards.
	 *
	 * @see ol()
	 *
	 * @param boolean $reversed
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
	 * @param int $rowspan
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
		return $this->attrib('sandbox', \ML_Express\join($sandbox));
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
	 * <li>Html5::SCOPE_ROWGROUP
	 * </ul>
	 *
	 * @see th()
	 *
	 * @param string $scope
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
	 * @param string $language
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
	 * @param string $scoped
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
	 * @param    mixed    $selected
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
	 * <li>Html5::SHAPE_POLY
	 * </ul>
	 *
	 * @see area()
	 * @param string $shape
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
	 * @param    int    $size
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
	 * @param string $sizes
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
	 * @param boolean $sortable
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
	 * @param int|string $sorted
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
	 * @param int $span
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
	 * @param    string    $src
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
		return $this->attrib('srcset', \ML_Express\join($srcset, ','));
	}

	/**
	 * Ordinal value of the first item.
	 *
	 * @see ol()
	 *
	 * @param int $start
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

	public function setTitle($title)
	{
		return $this->attrib('title', $title);
	}

	const TYPE_DECIMAL = '1';
	const TYPE_LOWER_ALPHA = 'a';
	const TYPE_UPPER_ALPHA = 'A';
	const TYPE_LOWER_ROMAN = 'i';
	const TYPE_UPPER_ROMAN = 'I';

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
	 * Whether the type attribute and the Content-Type value need to match
	 * for the resource to be used.
	 *
	 * @see object()
	 *
	 * @param    boolean    $typemustmatch
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
	 * @param string $usemap
	 */
	public function setUsemap($usemap) {
		if (!empty($usemap) && substr($usemap, 0, 1) != '#') {
			$usemap = '#' . $usemap;
		}
		return $this->attrib('usemap', $usemap);
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

	/**
	 * Horizontal dimension.
	 *
	 * @see image()
	 *
	 * @param    int    $width
	 */
	public function setWidth($width)
	{
		return $this->attrib('width', $width);
	}

	const WRAP_SOFT = 'soft';
	const WRAP_HARD = 'hard';

	/**
	 *
	 * @param  string  $wrap
	 */
	public function setWrap($wrap = self::WRAP_HARD)
	{
		return $this->attrib('wrap', $wrap);
	}
}
