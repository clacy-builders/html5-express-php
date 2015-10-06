<?php

require_once __DIR__ . '/../../vendor/autoload.php';

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
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-09">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	<table class="month-10">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar('2015-09-29', '2015-10-02'),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-09">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	<table class="month-10">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar('2015-12-28', '2016-01-04'),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-12">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
		<thead>
			<tr class="month">
				<th colspan="7">December</th>
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
				<td><time datetime="2015-12-28">28</time></td>
				<td><time datetime="2015-12-29">29</time></td>
				<td><time datetime="2015-12-30">30</time></td>
				<td><time datetime="2015-12-31">31</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</section>
<section class="calendar year-2016">
	<h1>2016</h1>
	<table class="month-01">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
		<thead>
			<tr class="month">
				<th colspan="7">January</th>
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
				<td><time datetime="2016-01-01">1</time></td>
				<td><time datetime="2016-01-02">2</time></td>
				<td><time datetime="2016-01-03">3</time></td>
			</tr>
		</tbody>
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-09-29'),
								new DateTime('2015-10-02'),
								6),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-09">
		<col class="sun">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
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
	<table class="month-10">
		<col class="sun">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'),
								0, null,
								['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],
								['Januar', 'Februar', 'März']),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	<table class="month-03">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('de')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02')),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	<table class="month-03">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 0,
								array(
										'2015-02-28' => array(
												'link' => '/birthdays/m-e-lee',
												'classes' => 'birthday',
												'title' => 'M. E. Lee\'s birthday'
										),
										'2015-03-01' => array(
												'link' => null,
												'classes' => 'foo',
												'title' => 'Foo'
										),
										'2015-05-31' => array(
												'link' => '/birthdays/fred-barney',
												'classes' => 'birthday',
												'title' => 'Fred Barney\'s birthday'
										),
								)),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
				<td><a href="/birthdays/m-e-lee">' .
		'<time datetime="2015-02-28" title="M. E. Lee\'s birthday" class="birthday">28</time>' .
		'</a></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<col class="fri">
		<col class="sat">
		<col class="sun">
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
				<td><time datetime="2015-03-01" title="Foo" class="foo">1</time></td>
			</tr>
		</tbody>
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 'MV'),
							'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
		<col class="fri">
		<col class="sat">
		<col class="sun">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<thead>
			<tr class="month">
				<th colspan="7">February</th>
			</tr>
			<tr class="weekdays">
				<th>Fri</th>
				<th>Sat</th>
				<th>Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><time datetime="2015-02-27">27</time></td>
				<td><time datetime="2015-02-28">28</time></td>
				<td colspan="5"></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<col class="fri">
		<col class="sat">
		<col class="sun">
		<col class="mon">
		<col class="tue">
		<col class="wed">
		<col class="thu">
		<thead>
			<tr class="month">
				<th colspan="7">March</th>
			</tr>
			<tr class="weekdays">
				<th>Fri</th>
				<th>Sat</th>
				<th>Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2"></td>
				<td><time datetime="2015-03-01">1</time></td>
				<td colspan="4"></td>
			</tr>
		</tbody>
	</table>
</section>'
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