<?php

namespace AndyTruong\Common\TestCases\Functions;

use PHPUnit_Framework_TestCase;

class AtCamelizeTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider sourceCamelize
     */
    public function testCamelize($input, $output)
    {
        $this->assertEquals(at_camelize($input), $output);
    }

    public function sourceCamelize()
    {
        return array(
            array('', ''),
            array('hello.world', 'Hello_World'),
            array('content_types', 'ContentTypes'),
            array('first__name', 'FirstName'),
            array('last__name', 'LastName'),
        );
    }

}
