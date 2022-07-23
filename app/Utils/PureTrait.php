<?php

namespace App\Utils;

trait PureTrait
{
    /**
     * Removes all white spaces except one
     *
     * Example: foo    bar = foo bar
     *
     * @param string $data
     * @param boolean $save - If the function cant return null value
     * @return string|null
     */
    public static function trimmed($data, $save = false)
    {
        if($data !== '' && $data !== null) {
            return trim(preg_replace_callback('/(\s\s+)/u', function($data){ return ' ';}, $data));
        }
        return (($save) ? null : '');
    }
}
