<?php

//namespace ML_Express\HTML5;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../vendor/ml-express/xml/src/Xml.php';
require_once __DIR__ . '/../../vendor/ml-express/xml/tests/Express_TestCase.php';
require_once __DIR__ . '/../../src/Html5.php';
require_once __DIR__ . '/../../src/extensions/Calendar.php';

use ML_Express\Express_TestCase;
use ML_Express\HTML5\Html5;
use ML_Express\HTML5\Calendar;

class CalendarTest extends Express_TestCase
{
	public function provider()
	{
		return array(
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-09-29'),
								new DateTime('2015-10-02')),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">September</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td><time datetime="2015-09-29">29</time></td>
			<td><time datetime="2015-09-30">30</time></td>
			<td colspan="4"></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">October</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"></td>
			<td><time datetime="2015-10-01">1</time></td>
			<td colspan="3"></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-09-29'),
								new DateTime('2015-10-02'),
								6),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">September</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="2"></td>
			<td><time datetime="2015-09-29">29</time></td>
			<td><time datetime="2015-09-30">30</time></td>
			<td colspan="3"></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">October</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4"></td>
			<td><time datetime="2015-10-01">1</time></td>
			<td colspan="2"></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'),
								0, null, null, null,
								['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],
								['Januar', 'Februar', 'März']),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">Februar</th>
		</tr>
		<tr class="weekdays">
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>
			<th>So</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28">28</time></td>
			<td></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">März</th>
		</tr>
		<tr class="weekdays">
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>
			<th>So</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6"></td>
			<td><time datetime="2015-03-01">1</time></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('de')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02')),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">Februar</th>
		</tr>
		<tr class="weekdays">
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>
			<th>So</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28">28</time></td>
			<td></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">März</th>
		</tr>
		<tr class="weekdays">
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>
			<th>So</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6"></td>
			<td><time datetime="2015-03-01">1</time></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 0,
								function($iso, $d, $m, $y, $w) {
									if ($iso == '2015-02-28') {
										return array(
												'/birthdays/%3$d/%2$02d/m-e-lee',
												'birthday',
												'M. E. Lee\'s birthday'
										);
									}
								}),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">February</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28" class="birthday" title="M. E. Lee\'s birthday"><a href="/birthdays/2015/02/m-e-lee">28</a></time></td>
			<td></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">March</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6"></td>
			<td><time datetime="2015-03-01">1</time></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 0,
								function($iso, $d, $m, $y, $w, $birtdays) {
									foreach ($birtdays as $birthday) {
										if ($iso == $birthday[0]) {
											return array(
													'/birthdays/%3$d/%2$02d/' . $birthday[2],
													'birthday',
													$birthday[1]
											);
										}
									}
								}, [['2015-02-28', 'M. E. Lee\'s birthday', 'm-e-lee']]),
						'<table>
	<thead>
		<tr class="month">
			<th colspan="7">February</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28" class="birthday" title="M. E. Lee\'s birthday"><a href="/birthdays/2015/02/m-e-lee">28</a></time></td>
			<td></td>
		</tr>
	</tbody>
</table>
<table>
	<thead>
		<tr class="month">
			<th colspan="7">March</th>
		</tr>
		<tr class="weekdays">
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6"></td>
			<td><time datetime="2015-03-01">1</time></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 6,
								null, null, true),
						'<table>
	<col class="sunday">
	<colgroup span="6">
	<thead>
		<tr class="month">
			<th colspan="7">February</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28">28</time></td>
		</tr>
	</tbody>
</table>
<table>
	<col class="sunday">
	<colgroup span="6">
	<thead>
		<tr class="month">
			<th colspan="7">March</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><time datetime="2015-03-01">1</time></td>
			<td colspan="6"></td>
		</tr>
	</tbody>
</table>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 6,
								null, null, Html::createSub()->col()->setClass('sun')),
						'<table>
	<col class="sun">
	<thead>
		<tr class="month">
			<th colspan="7">February</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5"></td>
			<td><time datetime="2015-02-27">27</time></td>
			<td><time datetime="2015-02-28">28</time></td>
		</tr>
	</tbody>
</table>
<table>
	<col class="sun">
	<thead>
		<tr class="month">
			<th colspan="7">March</th>
		</tr>
		<tr class="weekdays">
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><time datetime="2015-03-01">1</time></td>
			<td colspan="6"></td>
		</tr>
	</tbody>
</table>'
				),

		);
	}
}

class Html extends Html5
{
	use Calendar;

	public function setLocale($locale)
	{
		setlocale(LC_TIME, $locale);
		return $this;
	}
}