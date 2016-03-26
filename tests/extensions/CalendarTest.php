<?php

namespace ML_Express\HTML5\Tests;

require_once 'vendor/ml-express/xml/allIncl.php';
require_once 'vendor/ml-express/xml/tests/Express_TestCase.php';
require_once 'vendor/ml-express/calendar/allIncl.php';
require_once 'src/Html5.php';
require_once 'src/extensions/Calendar.php';

use ML_Express\Tests\Express_TestCase;
use ML_Express\HTML5\Html5;
use ML_Express\HTML5\Extensions\Calendar;
use ML_Express\Calendar\Calendar as Cal;
use ML_Express\Calendar\Day;

class CalendarTest extends Express_TestCase
{
	public function provider()
	{
		return array(
			array(
				Html::createSubL()->calendar(Cal::span('2015-09-29', '2015-10-01')),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-09">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-09">September</time></th>
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
				<td><time datetime="2015-09-29" class="tue">29</time></td>
				<td><time datetime="2015-09-30" class="wed">30</time></td>
				<td colspan="4"></td>
			</tr>
		</tbody>
	</table>
	<table class="month-10">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-10">October</time></th>
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
				<td><time datetime="2015-10-01" class="thu">1</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-09-29', '2015-10-01')),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-09">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-09">September</time></th>
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
				<td><time datetime="2015-09-29" class="tue">29</time></td>
				<td><time datetime="2015-09-30" class="wed">30</time></td>
				<td colspan="4"></td>
			</tr>
		</tbody>
	</table>
	<table class="month-10">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-10">October</time></th>
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
				<td><time datetime="2015-10-01" class="thu">1</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-12-28', '2016-01-03')),
						'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-12">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-12">December</time></th>
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
				<td><time datetime="2015-12-28" class="mon">28</time></td>
				<td><time datetime="2015-12-29" class="tue">29</time></td>
				<td><time datetime="2015-12-30" class="wed">30</time></td>
				<td><time datetime="2015-12-31" class="thu">31</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</section>
<section class="calendar year-2016">
	<h1><time>2016</time></h1>
	<table class="month-01">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2016-01">January</time></th>
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
				<td><time datetime="2016-01-01" class="fri">1</time></td>
				<td><time datetime="2016-01-02" class="sat">2</time></td>
				<td><time datetime="2016-01-03" class="sun">3</time></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(Html::createSubL()->calendar(Cal::span('2015-12-28', '2016-01-03')
					->setMonthFormat('%B %Y')
					->setYearFormat('')),
				'<section class="calendar year-2015">
	<table class="month-12">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-12">December 2015</time></th>
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
				<td><time datetime="2015-12-28" class="mon">28</time></td>
				<td><time datetime="2015-12-29" class="tue">29</time></td>
				<td><time datetime="2015-12-30" class="wed">30</time></td>
				<td><time datetime="2015-12-31" class="thu">31</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</section>
<section class="calendar year-2016">
	<table class="month-01">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2016-01">January 2016</time></th>
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
				<td><time datetime="2016-01-01" class="fri">1</time></td>
				<td><time datetime="2016-01-02" class="sat">2</time></td>
				<td><time datetime="2016-01-03" class="sun">3</time></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()
						->calendar(Cal::span('2016-01-01', '2016-01-01')->setDayFormat('%d')),
				'<section class="calendar year-2016">
	<h1><time>2016</time></h1>
	<table class="month-01">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2016-01">January</time></th>
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
				<td><time datetime="2016-01-01" class="fri">01</time></td>
				<td colspan="2"></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()
						->calendar(Cal::span('2015-09-29', '2015-10-01')->setFirstWeekday(6)),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-09">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-09">September</time></th>
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
				<td><time datetime="2015-09-29" class="tue">29</time></td>
				<td><time datetime="2015-09-30" class="wed">30</time></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
	<table class="month-10">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-10">October</time></th>
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
				<td><time datetime="2015-10-01" class="thu">1</time></td>
				<td colspan="2"></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-02-27', '2015-03-01')
						->setFirstWeekday(6)
						->setWeekdayFormat(['M', 'T', 'W', 'T', 'F', 'S', 'S'])),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-02">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-02">February</time></th>
			</tr>
			<tr class="weekdays">
				<th>S</th>
				<th>M</th>
				<th>T</th>
				<th>W</th>
				<th>T</th>
				<th>F</th>
				<th>S</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="5"></td>
				<td><time datetime="2015-02-27" class="fri">27</time></td>
				<td><time datetime="2015-02-28" class="sat">28</time></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-03">March</time></th>
			</tr>
			<tr class="weekdays">
				<th>S</th>
				<th>M</th>
				<th>T</th>
				<th>W</th>
				<th>T</th>
				<th>F</th>
				<th>S</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><time datetime="2015-03-01" class="sun">1</time></td>
				<td colspan="6"></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL('de')->calendar(Cal::span('2015-02-27', '2015-03-01')),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-02">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-02">Februar</time></th>
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
				<td><time datetime="2015-02-27" class="fri">27</time></td>
				<td><time datetime="2015-02-28" class="sat">28</time></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-03">März</time></th>
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
				<td><time datetime="2015-03-01" class="sun">1</time></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-02-27', '2015-03-01')
						->setFirstWeekday(0)
						->addEntries([
								(new Day('2015-02-28'))
										->setTitle('M. E. Lee\'s birthday')
										->setLink('/birthdays/m-e-lee'),
								(new Day('2015-02-28'))
										->setTitle('Fred Barney\'s birthday')
										->setLink('/birthdays/fred-barney')], 'birthday')
						->addEntries((new Day('2015-03-01'))->setTitle('Foo'), 'foo bar')),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-02">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-02">February</time></th>
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
				<td><time datetime="2015-02-27" class="fri">27</time></td>
				<td><a href="/birthdays/m-e-lee">' .
		'<time datetime="2015-02-28" title="M. E. Lee\'s birthday" class="sat birthday">28</time>' .
		'</a></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-03">March</time></th>
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
				<td><time datetime="2015-03-01" title="Foo" class="sun foo bar">1</time></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-02-27', '2015-03-01')
						->setFirstWeekday(0)
						->addEntries([
								(new Day('2015-02-28'))
										->setTitle('M. E. Lee\'s birthday')
										->setLink('/birthdays/m-e-lee'),
								(new Day('2015-02-28'))
										->setTitle('Fred Barney\'s birthday')
										->setLink('/birthdays/fred-barney')], 'birthday')
						->addEntries((new Day('2015-03-01'))->setTitle('Foo'), 'foo bar'),
						false, true),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-02">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-02">February</time></th>
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
				<td><time datetime="2015-02-27" class="fri">27</time></td>
				<td>
					<time datetime="2015-02-28" class="sat">28</time>
					<ul>
						<li class="birthday"><a href="/birthdays/m-e-lee">M. E. Lee\'s birthday</a></li>
						<li class="birthday"><a href="/birthdays/fred-barney">Fred Barney\'s birthday</a></li>
					</ul>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-03">March</time></th>
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
				<td>
					<time datetime="2015-03-01" class="sun">1</time>
					<ul>
						<li class="foo bar">Foo</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-02-27', '2015-03-01')
						->setFirstWeekday('MV')),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-02">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-02">February</time></th>
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
				<td><time datetime="2015-02-27" class="fri">27</time></td>
				<td><time datetime="2015-02-28" class="sat">28</time></td>
				<td colspan="5"></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
		<thead>
			<tr class="month">
				<th colspan="7"><time datetime="2015-03">March</time></th>
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
				<td><time datetime="2015-03-01" class="sun">1</time></td>
				<td colspan="4"></td>
			</tr>
		</tbody>
	</table>
</section>',
			),
			array(
				Html::createSubL()->calendar(Cal::span('2015-01-01', '2015-01-04'), true),
				'<section class="calendar year-2015">
	<h1><time>2015</time></h1>
	<table class="month-01">
		<thead>
			<tr class="month">
				<th colspan="8"><time datetime="2015-01">January</time></th>
			</tr>
			<tr class="weekdays">
				<th class="week"></th>
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
				<td><time datetime="2015-W01" class="week">01</time></td>
				<td colspan="3"></td>
				<td><time datetime="2015-01-01" class="thu">1</time></td>
				<td><time datetime="2015-01-02" class="fri">2</time></td>
				<td><time datetime="2015-01-03" class="sat">3</time></td>
				<td><time datetime="2015-01-04" class="sun">4</time></td>
			</tr>
		</tbody>
	</table>
</section>'
			),
			array(
				Html::createSubL()->calendar(Cal::span('2016-01-01', '2016-01-03'), 'Wk'),
				'<section class="calendar year-2016">
	<h1><time>2016</time></h1>
	<table class="month-01">
		<thead>
			<tr class="month">
				<th colspan="8"><time datetime="2016-01">January</time></th>
			</tr>
			<tr class="weekdays">
				<th class="week">Wk</th>
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
				<td><time datetime="2015-W53" class="week">53</time></td>
				<td colspan="4"></td>
				<td><time datetime="2016-01-01" class="fri">1</time></td>
				<td><time datetime="2016-01-02" class="sat">2</time></td>
				<td><time datetime="2016-01-03" class="sun">3</time></td>
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

	public static function createSubL($locale = 'en')
	{
		setlocale(LC_TIME, $locale);
		return self::createSub();
	}
}