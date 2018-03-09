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

    /**
     * @param string $originalClassName
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     *
     * @throws \ReflectionException
     */
    public function createMock($originalClassName) {
        $mock = parent::createMock($originalClassName);
        $this->addMockedMethods($mock, $originalClassName);
        return $mock;
    }

    /**
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
     * @param MockObject        $mock
     * @param \ReflectionMethod $method
     * @param array             $matches
     */
    private function addMockedMethod(MockObject $mock, \ReflectionMethod $method, array $matches) {
        $fullLine = $matches[0];        // @mockReturn     5
        $mockMethod = $matches[1];      // @mockReturn
        $mockValue = $matches[2];       // 5

        switch($mockMethod){
            case "@mockReturn":
                $mock->method($method->name)->willReturn($mockValue);
                break;
        }
    }
}