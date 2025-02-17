<?php

if (! function_exists('convert_to_cents')) {
    function convert_to_cents(float $amount): int
    {
        $value = $amount * 100;

        return (int) $value;
    }
}
