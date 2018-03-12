<?php

namespace tests;

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
     * @return int      The example num
     *
     * @mockReturn      5
     */
    public function getNum($num){
        return $num;
    }

    /**
     * @param null $array
     *
     * @return array
     *
     * @mockReturn      ['test']
     */
    public function getArray($array = null){
        return $array;
    }

    /**
     * @param $object
     *
     * @return mixed
     *
     * @mockReturn      new \stdClass()
     */
    public function getObject($object = null){
        return $object;
    }

    /**
     * @param $one          mixed       Arg
     * @param $two          mixed       Arg
     * @param $three        mixed       Arg
     *
     * @return mixed
     *
     * @mockReturnArgument              1
     */
    public function getArgs($one, $two, $three){
        return $one;
    }
}