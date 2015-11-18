<?php

namespace ML_Express\HTML5\Extensions;

/**
 * @link https://github.com/ml-express/html5-express-php/wiki/Calendar
 */
trait Calendar
{
	/**
	 * Appends a calendar.
	 *
	 * Years are represented by sections, months are represented by tables.
	 *
	 * @link http://php.net/manual/en/function.strftime.php
	 *
	 * @param from \DateTime|string
	 * <p>First day which should be shown on the calendar.<br>
	 * A string of the format <code>Y-m-d</code> or a <code>DateTime</code> object.</p>
	 *
	 * @param till \DateTime|string
	 * <p>Day after the last day which should be shown on the calendar.</p>
	 *
	 * @param firstWeekday int|string [optional]
	 * <p>0 (for Monday) through 6 (for Sunday) or an ISO 3166 country code
	 * for example <code>BR</code> for Brazil, <code>SE</code> for Sweden.</p>
	 *
	 * @param links array [optional]
	 * <p>An assotiative array with ISO 8601 dates <code>YYYY-mm-dd</code> as keys.
	 * For example:<br>
	 * <code>
	 * ['2015-04-03' => ['link' => '/archive/2016/04/foo', 'title' => 'Foo', 'classes' => 'post']]
	 * </code></p>
	 *
	 * @param weekdayFormat string|array [optional]
	 * <p>Neither a format string containing <code>%a</code> or <code>%A</code>
	 * or an array starting with Monday, for example:<br>
	 * <code>['M', 'T', 'W', 'T', 'F', 'S', 'S']</code></p>
	 *
	 * @param monthFormat string [optional]
	 * <p>You may use <code>%b</code>, <code>%B</code> or <code>%m</code>, also in combination with
	 * <code>%Y</code> or <code>%y</code></p>
	 *
	 * @param yearFormat string [optional]
	 * <p>You may use <code>%Y</code>, <code>%y</code> or an empty string.</p>
	 *
	 * @param dayFormat string [optional]
	 * <p>You may use <code>%d</code> or <code>%#d</code>
	 * (<code>%e</code> doesn't work on Windows).</p>
	 *
	 * @param showWeekNumbers boolean|string [optional]
	 * <p>Wether ISO 8601 week numbers are displayed or not.
	 * You may use a string for the corresponding column header, for example <code>'Wk'</code>.</p>
	 */
	public function calendar($from, $till, $firstWeekday = 0, $links = null,
			$weekdayFormat = null, $monthFormat = null, $yearFormat = null,
			$dayFormat = null, $showWeekNumbers = false)
	{
		$dayFormat = $dayFormat === null ? '%#d' : $dayFormat;
		$weekdayFormat = $weekdayFormat === null ? '%a' : $weekdayFormat;
		$monthFormat = $monthFormat === null ? '%B' : $monthFormat;
		$yearFormat = $yearFormat === null ? '%Y' : $yearFormat;

		if (is_string($from)) {
			$from = new \DateTime($from);
		}
		if (is_string($till)) {
			$till = new \DateTime($till);
		}
		if (is_string($firstWeekday)) {
			$firstWeekday = self::getFirstWeekday($firstWeekday);
		}
		if (!is_array($weekdayFormat)) {
			$weekdays = $this->getWeekdays($weekdayFormat);
		}
		else {
			$weekdays = $weekdayFormat;
		}
		if (is_string($showWeekNumbers)) {
			$weekLabel = $showWeekNumbers;
			$showWeekNumbers = true;
		} else {
			$weekLabel = '';
		}

		list($weekdays, $weekdayClasses) = self::reorderWeekdays($firstWeekday, $weekdays);

		$day = clone $from;
		$first = true;
		while ($day != $till) {
			$iso = $day->format('Y-m-d');
			$w = ((int) $day->format('N') - $firstWeekday + 6) % 7;
			$d = (int) $day->format('d');
			$m = $day->format('m');
			$t = $day->format('t');
			$y = $day->format('Y');

			// new year?
			if (($d == 1 && $m == 1) || $first) {
				$section = $this->section()->setClass('calendar year-' . $y);
				if ($yearFormat !== '') {
					$section->h1()->in_line()->time($this->format($day, $yearFormat), $y);
				}
			}

			// new month or first day?
			if ($d == 1 || $first) {
				$table = $section->table()->setClass('month-' . $m);

				$thead = $table->thead();
				$thead->tr()->setClass('month')
						->th(null, $showWeekNumbers ? 8 : 7)->in_line()
						->time($this->format($day, $monthFormat), $y . '-' . $m);

				// weekdays
				$tr = $thead->tr()->setClass('weekdays');
				if ($showWeekNumbers) {
					$tr->th($weekLabel)->setClass('week');
				}
				foreach ($weekdays as $weekdayName) {
					$tr->th($weekdayName);
				}

				$tbody = $table->tbody();
			}

			// new week
			if ($w == 0 || $d == 1 || $first) {
				$tr = $tbody->tr();
				// number of week
				if ($showWeekNumbers) {
					$tr->td(null)->in_line()
							->time($day->format('W'), $day->format('o-\WW'))
							->setClass('week');
				}
				// empty cell
				if ($w > 0) {
					$tr->td('', $w);
				}
			}

			// day
			$td = $tr ->td()->in_line();
			$link = $title = $classes = null;
			if (is_array($links) && isset($links[$iso])) {
				if (isset($links[$iso]['link'])) $link = $links[$iso]['link'];
				if (isset($links[$iso]['title'])) $title = $links[$iso]['title'];
				if (isset($links[$iso]['classes'])) $classes = $links[$iso]['classes'];
			}
			$elem = !empty($link) ? $td->a(null, $link) : $td;
			$time = $elem->time($this->format($day, $dayFormat), $iso);
			$time->setTitle($title);
			$time->setClass($weekdayClasses[$w]);
			$time->setClass($classes);

			// $day is not needed anymore but $next
			$next = $day->add(new \DateInterval('P1D'));

			// fill last week; last day of month or in calendar?
			if ($w != 6 && ($d == $t || $next == $till)) {
				$tr->td('', 6 - $w);
			}
			$first = false;
		}
		return $this;
	}

	/**
	 * Returns first day of the week in a calendar page view for a given country.
	 *
	 * @link http://unicode.org/repos/cldr/trunk/common/supplemental/supplementalData.xml
	 *
	 * @param countryCode string
	 * <p>An ISO 3166 country code
	 * for example <code>BR</code> for Brazil, <code>SE</code> for Sweden.</p>
	 *
	 * @return
	 * <p>0 for Monday trough 6 for Sunday.</p>
	 */
	public static function getFirstWeekday($countryCode)
	{
		$countryCode = strtoupper($countryCode);
		$territories = array(
				array(
						'AD', 'AI', 'AL', 'AM', 'AN', 'AT', 'AX', 'AZ', 'BA', 'BE', 'BG', 'BM',
						'BN', 'BY', 'CH', 'CL', 'CM', 'CR', 'CY', 'CZ', 'DE', 'DK', 'EC', 'EE',
						'ES', 'FI', 'FJ', 'FO', 'FR', 'GB', 'GE', 'GF', 'GP', 'GR', 'HR', 'HU',
						'IS', 'IT', 'KG', 'KZ', 'LB', 'LI', 'LK', 'LT', 'LU', 'LV', 'MC', 'MD',
						'ME', 'MK', 'MN', 'MQ', 'MY', 'NL', 'NO', 'PL', 'PT', 'RE', 'RO', 'RS',
						'RU', 'SE', 'SI', 'SK', 'SM', 'TJ', 'TM', 'TR', 'UA', 'UY', 'UZ', 'VA',
						'VN', 'XK'
				),
				array(), array(), array(), array('BD', 'MV'),
				array(
						'AE', 'AF', 'BH', 'DJ', 'DZ', 'EG', 'IQ', 'IR', 'JO', 'KW', 'LY', 'MA',
						'OM', 'QA', 'SD', 'SY'
				),
				array(
						'AG', 'AR', 'AS', 'AU', 'BR', 'BS', 'BT', 'BW', 'BZ', 'CA', 'CN', 'CO',
						'DM', 'DO', 'ET', 'GT', 'GU', 'HK', 'HN', 'ID', 'IE', 'IL', 'IN', 'JM',
						'JP', 'KE', 'KH', 'KR', 'LA', 'MH', 'MM', 'MO', 'MT', 'MX', 'MZ', 'NI',
						'NP', 'NZ', 'PA', 'PE', 'PH', 'PK', 'PR', 'PY', 'SA', 'SG', 'SV', 'TH',
						'TN', 'TT', 'TW', 'UM', 'US', 'VE', 'VI', 'WS', 'YE', 'ZA', 'ZW'
				)
		);
		foreach ($territories as $i => $territory) {
			if (in_array($countryCode, $territory)) return $i;
		}
		return 0;
	}

	private function getWeekdays($format = '%a')
	{
		$array = array();
		$day = new \DateTime('2014-01-06');
		for ($i = 0; $i < 7; $i++) {
			$array[$i] = $this->format($day, $format);
			$day->add(new \DateInterval('P1D'));
		}
		return $array;
	}

	private function format(\DateTime $day, $format)
	{
		$class = get_class($this->getRoot());
		return \ML_Express\formatDateTime($day, $format, $class::CHARACTER_ENCODING);
	}

	private static function reorderWeekdays($firstWeekday, $weekdayNames)
	{
		$weekdayClasses = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
		if ($firstWeekday > 0) {
			$wdn = $wdc = array();
			for ($i = $firstWeekday; $i < $firstWeekday + 7; $i++) {
				$index = $i % 7;
				$wdn[] = $weekdayNames[$index];
				$wdc[] = $weekdayClasses[$index];
			}
			$weekdayNames = $wdn;
			$weekdayClasses = $wdc;
		}
		return array($weekdayNames, $weekdayClasses);
	}
}