<?php

namespace ML_Express\HTML5;

trait Calendar
{
	public function calendar($from, $till,
			$firstWeekday = 0, $cellCallback = null, $cellCallbackArgs = null,
			$cols = null, $weekdayNames = null, $monthNames = null)
	{
		if (is_string($firstWeekday)) {
			$firstWeekday = self::getFirstWeekday($firstWeekday);
		}
		if (!is_array($weekdayNames)) {
			$weekdayNames = $this->getWeekdays();
		}
		if (!is_array($monthNames)) {
			$monthNames = $this->getMonths();
		}

		$day = clone $from;
		$first = true;
		while ($day != $till) {
			$iso = $day->format('Y-m-d');
			$w = ((int) $day->format('N') - $firstWeekday + 6) % 7;
			$d = (int) $day->format('d');
			$m = $day->format('m');
			$t = $day->format('t');
			$y = $day->format('Y');

			// new month or first day?
			if ($d == 1 || $first) {
				$table = $this->table();

				// distinguish weekdays
				if ($cols === true) {
					$table->markSundays($firstWeekday);
				}
				elseif ($cols instanceof Html5) {
					$table->inject($cols);
				}

				$thead = $table->thead();
				// name of month
				$thead->tr()->setClass('month')->th($monthNames[$m - 1], 7);

				// weekdays
				$tr = $thead->tr();
				for ($i = $firstWeekday; $i < $firstWeekday + 7; $i++) {
					$tr->setClass('weekdays')->th($weekdayNames[$i % 7]);
				}

				$tbody = $table->tbody();
			}

			// new week
			if ($w == 0 || $d == 1 || $first) {
				$tr = $tbody->tr();
				// empty cell
				if ($w > 0) {
					$tr->td('', $w);
				}
			}

			// day
			if (is_callable($cellCallback)) {
				list($link, $classes, $title) =
						$cellCallback($iso, $d, $m, $y, $w, $cellCallbackArgs);
			}
			elseif (is_array($cellCallback) && isset($cellCallback[$iso])) {
				$link    = $cellCallback[$iso]['link'];
				$classes = $cellCallback[$iso]['classes'];
				$title   = $cellCallback[$iso]['title'];
			}
			$td = $tr ->td()->in_line();
			$time = $td->time(null, $iso);
			if (!empty($link)) {
				$time->a($d, sprintf($link, $d, $m, $y));
				$time->addClass($classes);
				$time->setTitle($title);
				$link = null;
			}
			else {
				$time->appendText($d);
			}

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

	private static function getNames($interval, $count, $format, $encoding)
	{
		$array = array();
		$day = new \DateTime('2014-01-06');
		for ($i = 0; $i < $count; $i++) {
			$array[$i] = strftime($format, $day->getTimestamp());
			if ($encoding == self::UTF8) {
				$array[$i] = utf8_encode($array[$i]);
			}
			$day->add(new \DateInterval($interval));
		}
		return $array;
	}

	public static function getWeekdayNames($encoding = self::UTF8)
	{
		return self::getNames('P1D', 7, '%a', $encoding);
	}


	public static function getMonthNames($encoding = self::UTF8)
	{
		return self::getNames('P31D', 12, '%B', $encoding);
	}

	/**
	 * Data from: http://unicode.org/repos/cldr/trunk/common/supplemental/supplementalData.xml
	 *
	 * @param   string  $countryCode
	 * @return  int     0 for Monday 6 for sunday
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

	private function getWeekdays()
	{
		$class = get_class($this->getRoot());
		return self::getWeekdayNames($class::CHARACTER_ENCODING);
	}

	private function getMonths()
	{
		$class = get_class($this->getRoot());
		return self::getMonthNames($class::CHARACTER_ENCODING);
	}

	private function markSundays($firstWeekday)
	{
		$this->colgroup(6 - $firstWeekday);
		$this->col()->setClass('sunday');
		$this->colgroup($firstWeekday);
		return $this;
	}
}