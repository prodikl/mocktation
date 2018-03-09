<?php

namespace test;

use Mocktation\Example;
use Mocktation\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/9/18
 * Time: 4:07 PM
 */

class ExampleTest extends TestCase {
    public function testGetNum(){
        /** @var Example|MockObject $mock */
        $mock = $this->createMock(Example::class);
        $this->assertEquals(5, $mock->getNum(234));
    }
}