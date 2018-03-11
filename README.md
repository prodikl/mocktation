# Mocktation
PHP Mocking using annotations

[![Build Status](https://travis-ci.org/prodikl/mocktation.svg?branch=master)](https://travis-ci.org/prodikl/mocktation)

Mocktation lets you define return values of class methods when mocking, instead of having to define each return value in your tests.

By annotating using `@mockReturn   "test"`, the method will return `"test"` 
by default when calling the method after creating a mock using `$this->createMock(CLASSNAME)` in your tests.

This speeds up development since you can define default mock return values when writing the method, instead of retroactively deciding on mock values.

1. Install Mocktation

    ```bash
    composer require-dev prodikl/mocktation
    ```
        
2. Extend `Mocktation/Testcase` instead of PHPUnit TestCases

    ```php
    use Mocktation\TestCase;
    
    class ExampleTest extends TestCase {
        public function testGetNum(){
            /** @var Example|MockObject $mock */
            $mock = $this->createMock(Example::class);
            $this->assertEquals(5, $mock->getNum(234));
        }
    } 
    ```
    
3. Use annotations to describe mocking in your methods

    ```php
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
    }
    ```
    
Here's a list of Mocktation annotations

- `@mockReturn [returnValue]` - Returns the [returnValue] when called
- `@mockReturnArgument [argumentNumber]` - Returns the [argumentNumber] when called. [argumentNumber] starts from 0.