<?php

namespace AndyTruong\Common\TestCases\Functions;

use PHPUnit_Framework_TestCase;

class FunctionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @cover at_id()
     */
    public function testId()
    {
        $this->assertEquals('DateTimeZone', get_class(at_id(new \DateTime())->getTimezone()));
    }

    /**
     * @cover at_camelize()
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

    /**
     * @cover at_underscore()
     */
    public function testUnderscore()
    {
        $this->assertEquals('hello_world', at_underscore('HelloWorld'));
    }

    /**
     * @cover at_array_item()
     */
    public function testArrayItemAccess()
    {
        $array = [];
        $array['path']['to']['item'] = 'value';
        $this->assertEquals('value', at_array_item($array, 'path.to.item'));
        $this->assertEquals('*****', at_array_item($array, 'path.to.item.with.default.value', '*****'));
    }

}
