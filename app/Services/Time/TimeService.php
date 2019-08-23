<?php
namespace App\Services\Time;

/**
 * Class TimeService
 *
 * @package App\Services\Time
 */
class TimeService {

    /**
     * Calculate time difference in minutes (including a break).
     *
     * @param $start
     * @param $end
     * @param int $break in minutes
     * @return float|int|null
     */
    public function calculateDiffInMin($start, $end, $break = 0)
    {
        if (! isset($start, $end, $break))
            return 0;

        $start = strtotime($start);
        $end   = strtotime($end);

        if($end < $start) {
            $end += 24 * 60 * 60;
        }

        return ($end - $start)/60 - $break;
    }

    /**
     * Output given minutes in this format - hh:mm.
     *
     * @param $total_min
     * @return string
     */
    public function output($total_min, $full = true)
    {
        if (! isset($total_min) || $total_min == false)
            return '-';

        $full ? $name = trans('admin.Stunden') : $name = 'Std.';

        return number_format(round($total_min / 60, 2), 2, ',', '.') . ' ' . $name;
    }

    /**
     * Sanitize input.
     *
     * @param $value
     * @return null|string
     */
    public function sanitze($value)
    {
        if ($value == '')
            return null;

        if (preg_match('/^\d{1,2}$/', $value)) {
            $value .= ':00';
        }

        $parts = preg_split('/[\:|\.]/', $value);

        return sprintf('%02d:%02d', $parts[0], isset($parts[1]) ? $parts[1] : 0);
    }

    /**
     * Format time
     *
     * @param $value
     * @return string
     */
    public function format($value)
    {
        if ( ! isset($value)) {
            return '-';
        }

        return number_format($value, 2, ',', '.');
    }
}