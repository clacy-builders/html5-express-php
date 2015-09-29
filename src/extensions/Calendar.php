<?php

namespace ML_Express\HTML5;

trait Calendar
{
	public function calendar(
			$from, $till, $firstWeekday = 0,
			$cellCallback = null, $cellCallbackArgs = null,
			$weekdayNames = null, $monthNames = null)
	{
		if (!is_array($weekdayNames)) {
			$weekdayNames = $this->getWeekdays();
		}
		if (!is_array($monthNames)) {
			$monthNames = $this->getMonths();
		}

		$day = clone $from;
		$first = true;
		while ($day != $till) {
			$w = ((int) $day->format('N') - $firstWeekday + 6) % 7;
			$d = (int) $day->format('d');
			$iso = $day->format('Y-m-d');

			// new month or first day?
			if ($d == 1 || $first) {
				//if (!isset($table))
				$table = $this->table();
				$m = $day->format('m');
				$t = $day->format('t');
				$y = $day->format('Y');

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
				list($link, $classes, $title) = $cellCallback(
						$iso, $d, $m, $y, $w,
						$cellCallbackArgs
				);
			}
			$td = $tr ->td()->in_line();
			$time = $td->time(null, $iso);
			if (!empty($link)) {
				$time->a(sprintf($link, $d, $m, $y), $d);
				$time->addClass($classes);
				$time->title($title);
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

	private static function getNames($interval, $count, $format, $encoding) {
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

	public static function getWeekdayNames($encoding = self::UTF8) {
		return self::getNames('P1D', 7, '%a', $encoding);
	}


	public static function getMonthNames($encoding = self::UTF8) {
		return self::getNames('P31D', 12, '%B', $encoding);
	}

	protected function getWeekdays() {
		$class = get_class($this->getRoot());
		return self::getWeekdayNames($class::CHARACTER_ENCODING);
	}

	protected function getMonths() {
		$class = get_class($this->getRoot());
		return self::getMonthNames($class::CHARACTER_ENCODING);
	}
}


