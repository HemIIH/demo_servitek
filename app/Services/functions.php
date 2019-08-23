<?php

if (!function_exists('set_active')) {
    /**
     * Set active status for li items.
     *
     * @param string|array $path
     * @param bool|true $class
     * @param string $active
     * @return string
     */
    function set_active($path, $class = true, $active = 'active')
    {
        $attribute = $class ? "class = $active" : $active;
        return call_user_func_array('Request::is', (array)$path) ? $attribute : '';
    }
}

if (!function_exists('money')) {
    /**
     * Output as in currency format.
     *
     * @param float|int $value
     * @param string $currency
     * @return float
     */
    function money($value, $currency = '€')
    {
        if (!isset($value) || $value === '-' || $value === false)
            return '-';

        return number_format($value, 2, ',', '.') . ($currency ? ' ' . $currency : '');
    }
}

if (!function_exists('calculateCost')) {
    /**
     * Calculate cost based on minutes.
     *
     * @param int $total_min
     * @param float|int $wage
     * @return float
     */
    function calculateCost($total_min, $wage = 10)
    {
        if (!isset($total_min))
            return '-';

        return round($total_min / 60 * $wage, 2);
    }
}

if (!function_exists('getOrderStatus')) {
    /**
     * Get the status for an order.
     *
     * @param $order
     * @return string
     */
    function getOrderStatus($order)
    {
        if ($order->status == 'canceled') {
            return 'bg-yellow-light';
        } elseif ($order->pivot->approved_by_employee == 1) {
            return 'bg-green';
        } elseif ($order->pivot->rejected_by_employee == 1  && $order->status != 'canceled') {
            return 'bg-red';
        } elseif ($order->status != 'canceled') {
            return 'bg-grey-light';
        } else {
            return '';
        }
    }
}

if (!function_exists('toSql')) {
    /**
     * Convert a date in german format to SQL.
     *
     * @param $date
     * @return string
     */
    function toSql($date)
    {
        return \Date::germanToSql($date);
    }
}

if (!function_exists('now')) {
    /**
     * Get a Carbon instance for the current date and time.
     *
     * @return static
     */
    function now()
    {
        return \Carbon\Carbon::now();
    }
}

if (!function_exists('success')) {
    /**
     * Return app instance of Notify and call the success method.
     *
     * @param $message
     */
    function success($message)
    {
        session()->flash('message', trans('notify.' . $message));
        session()->flash('type', 'success');
    }
}

if (!function_exists('error')) {
    /**
     * Return app instance of Notify and call the success method.
     *
     * @param $message
     */
    function error($message)
    {
        session()->flash('message', trans('notify.' . $message));
        session()->flash('type', 'error');
    }
}

if (!function_exists('carbon')) {
    /**
     * Return a carbon instance and parse date.
     *
     * @param $date
     * @return \Carbon\Carbon
     */
    function carbon($date)
    {
        return \Carbon\Carbon::parse($date);
    }
}

if (!function_exists('convert')) {
    /**
     * Convert to a decimal number  -  2,00 => 2.00 .
     *
     * @return string
     */
    function convert($value)
    {
        return preg_replace('/\,/', '.', $value);
    }
}

if (!function_exists('evaluate')) {
    /**
     * Evaluate condition.
     *
     * @param $condition
     * @return mixed
     */
    function evaluate($condition)
    {
        return function () use ($condition) {
            return $condition;
        };
    }
}

