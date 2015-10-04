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
								0, null, null, null,
								['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],
								['Januar', 'Februar', 'März']),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
								function($iso, $d, $m, $y, $w) {
									if ($iso == '2015-02-28') {
										return array(
												'/birthdays/%3$d/%2$02d/m-e-lee',
												'birthday',
												'M. E. Lee\'s birthday'
										);
									}
								}),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
	<table class="month-03">
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
	</table>
</section>'
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
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
	<table class="month-03">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 0,
								array(
										'2015-02-28' => array(
												'link' => '/birthdays/2015/m-e-lee',
												'classes' => 'birthday',
												'title' => 'M. E. Lee\'s birthday'
										)
								)),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
				<td><time datetime="2015-02-28" class="birthday" title="M. E. Lee\'s birthday"><a href="/birthdays/2015/m-e-lee">28</a></time></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="month-03">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 6,
								null, null, true),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
	<table class="month-03">
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
	</table>
</section>'
				),
				array(
						Html::createSub()->setLocale('en')->calendar(
								new DateTime('2015-02-27'),
								new DateTime('2015-03-02'), 6,
								null, null, Html::createSub()->col()->setClass('sun')),
						'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
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
	<table class="month-03">
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
	</table>
</section>'
					),
					array(
							Html::createSub()->setLocale('en')->calendar(
									new DateTime('2015-02-27'),
									new DateTime('2015-03-02'), 'MV',
									null, null, true),
							'<section class="calendar year-2015">
	<h1>2015</h1>
	<table class="month-02">
		<colgroup span="2">
		<col class="sunday">
		<colgroup span="4">
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
		<colgroup span="2">
		<col class="sunday">
		<colgroup span="4">
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