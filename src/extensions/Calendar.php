<?php

namespace ML_Express\HTML5\Extensions;

use ML_Express\Calendar\Calendar as Cal;

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
	 * @param  Cal             $calendar
	 * @param  boolean|string  $showIsoWeeks  Wether ISO 8601 week numbers are displayed or not.
	 *                                        You may use a string for the corresponding column
	 *                                        header, for example <code>'Wk'</code>.
	 * @param  boolean         $listEntries   Wether calendar entries appended as an
	 *                                        <code>ul</code> element or not.
	 *
	 * @return \ML_Express\HTML5\Html5
	 */
	public function calendar(Cal $calendar, $showIsoWeeks = false, $listEntries = false)
	{
		if (is_string($showIsoWeeks)) {
			$weekLabel = $showIsoWeeks;
			$showIsoWeeks = true;
		} else {
			$weekLabel = '';
		}
		$array = $calendar->buildArray();
		$weekdayKeys = array_keys($array['weekdays']);
		foreach ($array['years'] as $year) {
			$section = $this->section()->setClass('calendar year-' . $year['time']);
			if (isset($year['label'])) {
				$section->h1()->inLine()->time($year['label'], $year['time']);
			}
			foreach ($year['months'] as $month) {
				$table = $section->table()->setClass('month-' . $month['month']);
				$thead = $table->thead();

				// month row
				$thead->tr()->setClass('month')
						->th(null, $showIsoWeeks ? 8 : 7)->inLine()
						->time($month['label'], $month['time']);

				// weekdays row
				$tr = $thead->tr()->setClass('weekdays');
				if ($showIsoWeeks) {
					$tr->th($weekLabel)->setClass('week');
				}
				foreach ($array['weekdays'] as $weekday) {
					$tr->th($weekday);
				}

				$tbody = $table->tbody();

				// week rows
				foreach ($month['weeks'] as $week) {
					$tr = $tbody->tr();
					if ($showIsoWeeks) {
						$tr->td(null)->inLine()->setClass('week')
								->time($week['label'], $week['time']);
					}
					// empty cells
					if (isset($week['leading'])) {
						$tr->td('', $week['leading']);
					}

					// day cells
					foreach ($week['days'] as $i => $day) {
						$td = $tr ->td()->setClass($day['weekday']);
						if (isset($day['entries'])) {
							if ($listEntries) {
								$td->time($day['label'], $day['time']);
								$ul = $td->ul();
								foreach ($day['entries'] as $i => $entry) {
									if (isset($entry['title'])) {
										$li = $ul->li()->inline()->setClass(isset($entry['class'])
												? $entry['class']
												: null);
										if (isset($entry['link'])) {
											$li->a($entry['title'], $entry['link']);
										}
										else {
											$li->appendText($entry['title']);
										}
									}
								}
							}
							else {
								$entry = $day['entries'][0];
								$td->inline()
										->setClass(isset($entry['class']) ? $entry['class'] : null);
								$elem = isset($entry['link']) ? $td->a(null, $entry['link']) : $td;
								$elem->time($day['label'], $day['time'])
										->setTitle(isset($entry['title']) ? $entry['title'] : null);
							}
						}
						else {
							$td->inLine()->time($day['label'], $day['time']);
						}
 					}
 					// fill last week; last day of month or in calendar?
 					if (isset($week['following'])) {
 						$tr->td('', $week['following']);
 					}
				}
			}
		}
		return $this;
	}
}