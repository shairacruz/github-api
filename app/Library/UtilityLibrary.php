<?php

namespace App\Library;

class UtilityLibrary
{
    /**
     * @param $mArray
     * @return bool
     */
    public static function isValidArray($mArray)
    {
        return is_array($mArray) === true && !empty($mArray) === true;
    }

    /**
     * @param $mString
     * @return bool
     */
    public static function isValidString($mString)
    {
        return is_string($mString) && !empty($mString);
    }

    /**
     * @param $sDate
     * @return false|string
     */
    public static function convertToMySqlDate($sDate)
    {
        return date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $sDate)));
    }
}
