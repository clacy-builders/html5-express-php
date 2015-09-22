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
		);
	}

	/**
	 * @dataProvider trowsProvider
	 */
	public function testTrows($html, $expected)
	{
		$this->test($html, $expected);
	}

	public function trowsProvider()
	{
		$resultsArr = self::$result1;
		$resultsObj = array();
		foreach ($resultsArr as $row) {
			$resultsObj[] = (object) $row;
		}

		$keys = array('town', 'name', 'price');

		$cellCallback1 = function($td, $data, $i, $key) {
			if ($key == 'name') $td->th();
		};
		$cellCallback2 = function($td, $data, $i, $key, $options) {
			if ($key == $options['key']) $td->th();
		};
		$cellOptions = array('key' => 'name');

		$rowCallback1 = function($tr, $data, $i) {
			$tr->attrib('data-name', \ML_Express\value($data[$i], 'name'));
		};
		$rowCallback2 = function($tr, $data, $i, $options) {
			$attribute = 'data-' . $options['attributeName'];
			$tr->attrib($attribute, \ML_Express\value($data[$i], 'name'));
		};
		$rowOptions = array('attributeName' => 'name');

		$expected = array('<table>
	<tr>
		<td>Foo</td>
		<td>Berlin</td>
		<td>20</td>
	</tr>
	<tr>
		<td>Foo</td>
		<td>Berlin</td>
		<td>12</td>
	</tr>
	<tr>
		<td>Foo</td>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr>
		<td>Bar</td>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr>
		<td>Bar</td>
		<td>Hamburg</td>
		<td>15</td>
	</tr>
	<tr>
		<td>Bar</td>
		<td>Hamburg</td>
		<td>15</td>
	</tr>
</table>', '<table>
	<tr>
		<td>Berlin</td>
		<td>Foo</td>
	</tr>
	<tr>
		<td>Berlin</td>
		<td>Foo</td>
	</tr>
	<tr>
		<td>Cologne</td>
		<td>Foo</td>
	</tr>
	<tr>
		<td>Cologne</td>
		<td>Bar</td>
	</tr>
	<tr>
		<td>Hamburg</td>
		<td>Bar</td>
	</tr>
	<tr>
		<td>Hamburg</td>
		<td>Bar</td>
	</tr>
</table>', '<table>
	<tr data-name="Foo">
		<th>Foo</th>
		<td>Berlin</td>
		<td>20</td>
	</tr>
	<tr data-name="Foo">
		<th>Foo</th>
		<td>Berlin</td>
		<td>12</td>
	</tr>
	<tr data-name="Foo">
		<th>Foo</th>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr data-name="Bar">
		<th>Bar</th>
		<td>Cologne</td>
		<td>12</td>
	</tr>
	<tr data-name="Bar">
		<th>Bar</th>
		<td>Hamburg</td>
		<td>15</td>
	</tr>
	<tr data-name="Bar">
		<th>Bar</th>
		<td>Hamburg</td>
		<td>15</td>
	</tr>
</table>');
		return array(
				array(Html5::createSub()->table()->trows($resultsArr), $expected[0]),
				array(Html5::createSub()->table()->trows($resultsObj), $expected[0]),
				array(Html5::createSub()->table()->trows($resultsArr, $keys), $expected[1]),
				array(Html5::createSub()->table()->trows($resultsObj, $keys), $expected[1]),
				array(
						Html5::createSub()->table()->trows(
								$resultsArr, null, $cellCallback2, $cellOptions, $rowCallback1),
						$expected[2]
				),
				array(
						Html5::createSub()->table()->trows(
								$resultsArr, null, $cellCallback2, $cellOptions, $rowCallback1),
						$expected[2]
				)
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