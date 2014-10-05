<?php

namespace AndyTruong\Common\TestCases\Functions;

use PHPUnit_Framework_TestCase;

class AtUnderscoreTest extends PHPUnit_Framework_TestCase
{

    public function testUnderscore()
    {
        $this->assertEquals('hello_world', at_underscore('HelloWorld'));
    }

}
