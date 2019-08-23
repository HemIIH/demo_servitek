<?php

namespace App\Services\Date;

class DateService
{

    /**
     * Array of aliases and date formats.
     *
     * @var array
     */
    protected $formats = [
        'date'           => 'd.m.Y',
        'time'           => 'H:i',
        'date_time'      => 'd.m.Y H:i',
        'month'          => 'F'

    ];

    public $monthNames = [
        1  => [
            'full' => 'January',
            'abbr' => 'Jan'
        ],
        2  => [
            'full' => 'February',
            'abbr' => 'Feb'
        ],
        3  => [
            'full' => 'March',
            'abbr' => 'Mar'
        ],
        4  => [
            'full' => 'April',
            'abbr' => 'Apr'
        ],
        5  => [
            'full' => 'May',
            'abbr' => 'May'
        ],
        6  => [
            'full' => 'June',
            'abbr' => 'Jun'
        ],
        7  => [
            'full' => 'July',
            'abbr' => 'Jul'
        ],
        8  => [
            'full' => 'August',
            'abbr' => 'Aug'
        ],
        9  => [
            'full' => 'September',
            'abbr' => 'Sep'
        ],
        10 => [
            'full' => 'October',
            'abbr' => 'Oct'
        ],
        11 => [
            'full' => 'November',
            'abbr' => 'Nov'
        ],
        12 => [
            'full' => 'December',
            'abbr' => 'Dec'
        ]
    ];


    /**
     * Format date according to given alias.
     *
     * @param $date
     * @param $alias
     * @return bool|string
     */
    public function format($date, $alias = 'date')
    {
        if (! in_array($alias, array_keys($this->formats)) || ! isset($date) || ! $date) {
            return null;
        }

        return carbon($date)->format($this->formats[$alias]);
    }

    /**
     * Get weekday as two letter string
     *
     * @param $date
     * @return string
     */
    public function weekday($date)
    {
        $daysOfWeek = [
            0 => 'So',
            1 => 'Mo',
            2 => 'Di',
            3 => 'Mi',
            4 => 'Do',
            5 => 'Fr',
            6 => 'Sa',
        ];

        return $daysOfWeek[carbon($date)->dayOfWeek];
    }

    /**
     * Returns an array of dates from a start to an end date.
     *
     * @param \Carbon\Carbon $start
     * @param \Carbon\Carbon $end
     * @return array
     */
    public function between($start, $end)
    {
        $dates = [];

        for ($i = $start->copy(); $i <= $end; $i->addDay()) {
            $dates[$i->format('Y-m-d')] = $this->weekday($i);
        }

        return $dates;
    }

    /**
     * Get start and end date of calendar week of given date.
     *
     * @param $date
     * @return array
     */
    public function getStartAndEndDate($date)
    {
        $date = carbon($date);

        return [
            'start' => $date->startOfWeek()->format('Y-m-d'),
            'end'   => $date->endOfWeek()->format('Y-m-d')
        ];
    }

    /**
     * Get german month name.
     *
     * @param $key
     * @return string
     */
    public function monthName($key, $longForm = true)
    {
        $type = $longForm ? 'full' : 'abbr';

        return $this->monthNames[$key][$type];
    }

    /**
     * Returns a timespan.
     *
     * @param $start
     * @param $end
     * @return bool|string
     */
    public function timespan($start, $end)
    {
        if ($start == $end) {
            return $this->format($start);
        }

        return carbon($start)->format('d.m.') . ' - ' . $this->format($end);
    }

    public function monthNames()
    {
        return $this->monthNames;
    }

    /**
     * Return date with month and year.
     *
     * @param $date
     * @return string
     */
    public function monthYear($date, $longForm = true)
    {
       $date = carbon($date);

        return sprintf('%s %d', $this->monthName($date->month, $longForm), $date->year); // returns Januar 2014 / Jan 2014
    }

    /**
     * Convert date: 20.10.2014 -> 2014-10-20
     *
     * @param $date
     * @return string
     */
    public function germanToSql($date)
    {
        if (! $this->isValidDate($date, 'german')) {
            return null;
        }

        list($day, $month, $year) = explode('.', $date);

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    /**
     * Convert date: 2014-10-20 -> 20.10.2014
     *
     * @param $date
     * @return string
     */
    public function sqlToGerman($date)
    {
        if (! $this->isValidDate($date, 'sql')) {
            return null;
        }

        list($year, $month, $day) = explode('-', $date);

        return sprintf('%02d.%02d.%04d', $day, $month, $year);
    }


    /**
     * Check if date is valid.
     *
     * @param string $date
     * @param string $type
     * @return bool
     */
    private function isValidDate($date, $type)
    {
        switch ($type) {
            case 'german':
                return preg_match('/(\d){1,2}\.(\d){1,2}\.(\d){2,4}/', $date);
                break;
            case 'sql':
                return preg_match('/(\d){4}-(\d){2}-(\d){2}/', $date);
                break;
            default:
                return false;
        }
    }

}