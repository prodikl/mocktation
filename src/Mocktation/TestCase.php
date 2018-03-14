<?php

namespace Mocktation;

use PHPUnit\Framework\MockObject\MockObject;

/**
 *
 *
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/9/18
 * Time: 4:07 PM
 */

abstract class TestCase extends \PHPUnit\Framework\TestCase {

    const MOCK_RETURN_VALUE = "@mockReturn";
    const MOCK_RETURN_ARGUMENT = "@mockReturnArgument";

    /**
     * Returns a test double for the specified class.
     *
     * @param string $originalClassName         The class name to mock
     * @param bool   $fresh                     If TRUE, ignore annotations and return fresh mock
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     * @throws \ReflectionException
     */
    public function createMock($originalClassName, bool $fresh = false) {
        $mock = parent::createMock($originalClassName);
        if($fresh == false) {
            $this->addMockedMethods($mock, $originalClassName);
        }
        return $mock;
    }

    /**
     * Looks through all the method comments for the given class and checks for @mock methods
     *
     * @param $mock                 MockObject      The mock
     * @param $originalClassName    string          The class name
     *
     * @throws \ReflectionException
     */
    private function addMockedMethods(MockObject $mock, string $originalClassName) {
        $ref = new \ReflectionClass($originalClassName);
        foreach($ref->getMethods() as $method){
            $this->checkForMockedMethod($mock, $method);
        }

    }

    /**
     * Looks through each line of the docBlock for a method and looks for @mock annotations.
     *
     * @param $mock         MockObject          The mock object
     * @param $method       \ReflectionMethod   The ReflectionMethod
     */
    private function checkForMockedMethod(MockObject $mock, \ReflectionMethod $method) {
        $docComment = $method->getDocComment();
        $docCommentLines = explode(PHP_EOL, $docComment);
        foreach($docCommentLines as $commentLine){
            $matches = [];
            preg_match("/(@mock\S*)\s*(.*)/", $commentLine,$matches);
            if(count($matches)){
                $this->addMockedMethod($mock, $method, $matches);
            }
        }
    }

    /**
     * Applies the logic for each @mock annotation found
     *
     * @param MockObject        $mock
     * @param \ReflectionMethod $method
     * @param array             $matches
     */
    private function addMockedMethod(MockObject $mock, \ReflectionMethod $method, array $matches) {
        $fullLine = $matches[0];        // e.g.     @mockReturn     5
        $mockMethod = $matches[1];      // e.g.     @mockReturn
        $mockValue = $matches[2];       // e.g.     5

        switch($mockMethod){
            case static::MOCK_RETURN_VALUE:
                //$mock->method($method->name)->willReturn(eval("return " . $mockValue . ';'));
                $expects = $mock->expects(
                    $this->weakly($mock)
                    //static::any()
                );
                $method = $expects->method($method->name);
                $method->will(
                        static::returnValue(
                            eval("return " . $mockValue . ';')));
                break;
            case static::MOCK_RETURN_ARGUMENT:
                $mock->method($method->name)->willReturnArgument((int) $mockValue);
                break;

        }
    }

    /**
     * Returns a matcher that matches when the method is executed
     * zero or more times.
     *
     * @param MockObject $mock
     *
     * @return WeaklyMatcher
     */
    public static function weakly(MockObject $mock)
    {
        return new WeaklyMatcher($mock);
    }
}