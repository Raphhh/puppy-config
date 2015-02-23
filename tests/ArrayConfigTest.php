<?php
namespace Puppy\Config;

/**
 * Class SimpleConfigTest
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ArrayConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testGetWithArray()
    {
        $config = new ArrayConfig([
            'key1' => [],
            'key2' => '%key1%',
        ]);
        $this->assertSame([], $config['key1']);
    }
}
 