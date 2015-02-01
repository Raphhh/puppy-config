<?php
namespace Puppy\Config;

/**
 * Class SimpleConfigTest
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SimpleConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testGetWithArray()
    {
        $config = new SimpleConfig([
            'key1' => [],
            'key2' => '%key1%',
        ]);
        $this->assertSame([], $config->get('key1'));
    }
}
 