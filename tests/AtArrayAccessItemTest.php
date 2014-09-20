<?php

namespace AndyTruong\Common\TestCases\Functions;

class AtArrayAccessItemTest extends \PHPUnit_Framework_TestCase
{

    public function testArrayItemAccess()
    {
        $array['path']['to']['item'] = 'value';
        $this->assertEquals('value', at_array_item($array, 'path.to.item'));
        $this->assertEquals('*****', at_array_item($array, 'path.to.item.with.default.value', '*****'));
    }

}
