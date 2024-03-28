<?php

if (!function_exists('dd')) {
    /**
     * @param  mixed  $data
     * @return void
     */
    function dd(mixed $data): void
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit;
    }
}

if (!function_exists('is_param')) {
    /**
     * @param  string  $string
     * @return bool
     */
    function is_param(string $string): bool
    {
        return str_ends_with($string, "}") and str_starts_with($string,"{");
    }
}