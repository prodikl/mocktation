<?php
/**
 * Created by PhpStorm.
 * User: keithlarson
 * Date: 3/14/18
 * Time: 3:33 PM
 */

namespace Mocktation;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Invocation as BaseInvocation;
use PHPUnit\Framework\MockObject\InvocationMocker;
use PHPUnit\Framework\MockObject\Matcher\Invocation;
use PHPUnit\Framework\MockObject\MockObject;

class WeaklyMatcher implements Invocation {

    public function __construct(MockObject $mock) {
        $this->mock = $mock;
    }

    /**
     * This should return false if any other matchers exist in the invocation mocker
     *
     * @param BaseInvocation $invocation
     *
     * @return bool
     */
    public function matches(BaseInvocation $invocation)
    {


        //return true;

        $methods = get_class_methods($this->mock);
        $hasMatchers = $this->mock->__phpunit_hasMatchers();
        /** @var InvocationMocker $invocationMocker */
        $invocationMocker = $this->mock->__phpunit_getInvocationMocker();
        $matchers = $invocationMocker->hasMatchers();
        if($invocationMocker->getMatchers()){
            return true;
        } else {
            return false;
        }
    }

    public function hasMatchers(){
        return false;
    }

    /**
     * Registers the invocation $invocation in the object as being invoked.
     * This will only occur after matches() returns true which means the
     * current invocation is the correct one.
     * The matcher can store information from the invocation which can later
     * be checked in verify(), or it can check the values directly and throw
     * and exception if an expectation is not met.
     * If the matcher is a stub it will also have a return value.
     *
     * @param BaseInvocation $invocation Object containing information on a mocked or stubbed method which was invoked
     *
     * @return mixed
     */
    public function invoked(BaseInvocation $invocation) {

    }

    /**
     * Returns a string representation of the object.
     * @return string
     */
    public function toString() {
        return 'invokes if no other matches exist';
    }

    /**
     * Verifies that the current expectation is valid. If everything is OK the
     * code should just return, if not it must throw an exception.
     * @throws ExpectationFailedException
     */
    public function verify() {

    }
}