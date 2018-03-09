<?php

namespace Mocktation;

/**
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/9/18
 * Time: 4:04 PM
 */
class Example {
    /**
     * Accepts an int $num and returns it
     *
     * @param $num      int     The num to return
     *
     * @return int      The example num
     *
     * @mockReturn      5
     */
    public function getNum($num){
        return $num;
    }
}