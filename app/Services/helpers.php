<?php

if (!function_exists('allow_null')) {

    /**
     * Allow null input string Escape HTML entities in a string.
     *
     * @param  string $value
     *
     * @return string
     */
    function allow_null($value)
    {
        $value = (empty($value) ? '' : $value);

        return e($value);
    }
}
