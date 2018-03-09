<?php
/**
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/9/18
 * Time: 4:36 PM
 */

require("vendor/autoload.php");

$example = new \Mocktation\Example();

$exampleTest = new ExampleTest();

echo $example->getNum(5);