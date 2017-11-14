<?php

/**
 * @param null $data
 */
function debugPrint($data = NULL)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}
function replace_space($name) {
    $name = trim($name);
    $str = str_replace(' ', '-', $name);
    $str = str_replace("'", '', $str);
    $str = strtolower($str);

    return $str;
}

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}