<?php
if(!function_exists('sortString')){
    function sortString($string = ''){
        $extract = explode(',', $string);
        // loại bỏ khoản trắng quanh phaan tử
        $extract = array_map('trim', $extract);
        sort($extract, SORT_NUMERIC);
        $newArray = implode(',', $extract);
        return $newArray;
    }
}