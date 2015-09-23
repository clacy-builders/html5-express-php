<?php

namespace ML_Express\HTML5;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../src/Html5.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;

class Html5TabularDataTest extends Express_TestCase
{
	protected static $result1 = array(
			array('name' => 'Foo', 'town' => 'Berlin', 'amount' => 20),
			array('name' => 'Foo', 'town' => 'Berlin', 'amount' => 12),
			array('name' => 'Foo', 'town' => 'Cologne', 'amount' => 12),
			array('name' => 'Bar', 'town' => 'Cologne', 'amount' => 12),
			array('name' => 'Bar', 'town' => 'Hamburg', 'amount' => 15),
			array('name' => 'Bar', 'town' => 'Hamburg', 'amount' => 15)
	);
	protected static $result2 = array(
			array('name' => 'Foo', 'town' => 'Berlin'),
			array('name' => 'Bar', 'town' => 'Cologne'),
			array('name' => 'Bar', 'town' => 'Hamburg'),
			array('name' => 'Foo', 'town' => 'Cologne')
	);

	public function provider()
	{
		return array(
				// Basics
				array(Html5::createSub()->table(true), '<table sortable></table>'),
				array(Html5::createSub()->caption('content'), '<caption>content</caption>'),
				array(
						Html5::createSub()->caption()->p('content'),
						"<caption>\n\t<p>content</p>\n</caption>"
				),
				array(
						Html5::createSub()->colgroup(5)->col(2)->getRoot(),
						"<colgroup span=\"5\">\n\t<col span=\"2\">\n</colgroup>"
				),
				array(Html5::createSub()->tbody(), '<tbody></tbody>'),
				array(Html5::createSub()->thead(), '<thead></thead>'),
				array(Html5::createSub()->tfoot(), '<tfoot></tfoot>'),
				array(Html5::createSub()->tr(), '<tr></tr>'),
				array(
						Html5::createSub()->td('content', 2, 3, 'something'),
						'<td colspan="2" rowspan="3" headers="something">content</td>'
				),
				array(
						Html5::createSub()
								->th('content', 2, 3, null, null, 'c')
								->td(null, null, null, 'something'),
						'<td headers="something">content</td>'
				),
				array(
						Html5::createSub()
								->th('content', 2, 3, 'something', Html5::SCOPE_COL, 'cont.', -2),
						'<th colspan="2" rowspan="3" headers="something"' .
						' scope="col" abbr="cont." sorted="2 reversed">content</th>'
				),
				array(
						Html5::createSub()->th('content')->setSorted(0),
						'<th sorted="reversed">content</th>'
				),
				array(
						Html5::createSub()->th('content')->setSorted('1 reversed'),
						'<th sorted="1 reversed">content</th>'
				),
				array(
						Html5::createSub()
								->td('content', 2, 3)
								->th(null, null, null, 'something', null, 'c'),
						'<th headers="something" abbr="c">content</th>'
				),

				// tcells()
				array(
						Html5::createSub()
								->table()->tr()
								->tcells(array_keys(self::$result1[1])),
						"<table>\n\t<tr>" .
						"\n\t\t<td>name</td>\n\t\t<td>town</td>\n\t\t<td>amount</td>" .
						"\n\t</tr>\n</table>"
				),
				array(
						Html5::createSub()
								->table()->tr()
								->tcells(array_keys(self::$result1[1]), [1, 2], true),
						"<table>\n\t<tr>" .
						"\n\t\t<th>town</th>\n\t\t<th>amount</th>" .
						"\n\t</tr>\n</table>"
				),
				array(
						Html5::createSub()
								->table()->tr()
								->tcells((object) self::$result1[1]),
						"<table>\n\t<tr>" .
						"\n\t\t<td>Foo</td>\n\t\t<td>Berlin</td>\n\t\t<td>12</td>" .
						"\n\t</tr>\n</table>"
				),
				array(
						Html5::createSub()
								->table()->tr()
								->tcells(self::$result1[1], ['name', 'town']),
						"<table>\n\t<tr>" .
						"\n\t\t<td>Foo</td>\n\t\t<td>Berlin</td>" .
						"\n\t</tr>\n</table>"
				),
				array(
						Html5::createSub()
								->table()->tr()
								->tcells(self::$result1[1], null,
										function($td, $data, $key) {
											if ($key == 'name') $td->th();
										}),
						"<table>\n\t<tr>" .
						"\n\t\t<th>Foo</th>\n\t\t<td>Berlin</td>\n\t\t<td>12</td>" .
						"\n\t</tr>\n</table>"
				),
				array(
						Html5::createSub()
								->table()->tr()
								->tcells((object) self::$result1[1], null,
										function($td, $data, $key, $options) {
											if ($key == $options['key']) $td->th();
										}, ['key' => 'name']),
						"<table>\n\t<tr>" .
						"\n\t\t<th>Foo</th>\n\t\t<td>Berlin</td>\n\t\t<td>12</td>" .
						"\n\t</tr>\n</table>"
				),

				// trows()
				array(
						Html5::createSub()->table()->trows(self::$result2),
						"<table>" .
						"\n\t<tr>\n\t\t<td>Foo</td>\n\t\t<td>Berlin</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Bar</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Bar</td>\n\t\t<td>Hamburg</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Foo</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n</table>"
				),
				array(
						Html5::createSub()
								->table()
								->trows(self::$result2, ['town', 'name', 'city']),
						"<table>" .
						"\n\t<tr>\n\t\t<td>Berlin</td>\n\t\t<td>Foo</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Cologne</td>\n\t\t<td>Bar</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Hamburg</td>\n\t\t<td>Bar</td>\n\t</tr>" .
						"\n\t<tr>\n\t\t<td>Cologne</td>\n\t\t<td>Foo</td>\n\t</tr>" .
						"\n</table>"
				),
				array(
						Html5::createSub()
								->table()
								->trows(self::$result2, null, null, null,
										function($tr, $data, $i) {
											$tr->setClass('r' . ($i % 2 + 1));
										}),
						"<table>" .
						"\n\t<tr class=\"r1\">\n\t\t<td>Foo</td>\n\t\t<td>Berlin</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<td>Bar</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n\t<tr class=\"r1\">\n\t\t<td>Bar</td>\n\t\t<td>Hamburg</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<td>Foo</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n</table>"
				),
				array(
						Html5::createSub()
								->table()
								->trows(self::$result2, null, null, null,
										function($tr, $data, $i, $options) {
											$tr->setClass($options['class'] . ($i % 2 + 1));
										}, ['class' => 'r']),
						"<table>" .
						"\n\t<tr class=\"r1\">\n\t\t<td>Foo</td>\n\t\t<td>Berlin</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<td>Bar</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n\t<tr class=\"r1\">\n\t\t<td>Bar</td>\n\t\t<td>Hamburg</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<td>Foo</td>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n</table>"
				),
				array(
						Html5::createSub()
								->table()
								->trows(self::$result2, null,
										function($td, $data, $key, $options) {
											if ($key == $options['key']) $td->th();
										}, ['key' => 'name'],
										function($tr, $data, $i, $options) {
											$tr->setClass($options['class'] . ($i % 2 + 1));
										}, ['class' => 'r']),
						"<table>" .
						"\n\t<tr class=\"r1\">\n\t\t<th>Foo</th>\n\t\t<td>Berlin</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<th>Bar</th>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n\t<tr class=\"r1\">\n\t\t<th>Bar</th>\n\t\t<td>Hamburg</td>\n\t</tr>" .
						"\n\t<tr class=\"r2\">\n\t\t<th>Foo</th>\n\t\t<td>Cologne</td>\n\t</tr>" .
						"\n</table>"
				),
		);
	}

	public function testRowspans()
	{
		$html = Html5::createSub();
		$html->table()->trows(self::$result1)->rowspans();
		$expected = '<table>
	<tr>
		<td rowspan="3">Foo</td>
		<td rowspan="2">Berlin</td>
		<td>20</td>
	</tr>
	<tr>
		<td>12</td>
	</tr>
	<tr>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr>
		<td rowspan="3">Bar</td>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr>
		<td rowspan="2">Hamburg</td>
		<td>15</td>
	</tr>
	<tr>
		<td>15</td>
	</tr>
</table>';
		$this->assertEquals($expected, $html->getMarkup());
	}
}