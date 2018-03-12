<?php

use tests\Example;
use Mocktation\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/9/18
 * Time: 4:07 PM
 */

class ExampleTest extends TestCase {
    /** @var Example|MockObject */
    protected $mock;

    public function setUp() {
        /** @var Example|MockObject $mock */
        $this->mock = $this->createMock(Example::class);
    }

    public function testGetNum(){
        $this->assertEquals(5, $this->mock->getNum(234));
    }

    public function testArray(){
        $this->assertEquals(['test'], $this->mock->getArray());
    }

    public function testObject(){
        $this->assertEquals(new stdClass(), $this->mock->getObject());
    }

    public function testGetArgs(){
        $this->assertEquals(2, $this->mock->getArgs(1,2,3));
    }
}