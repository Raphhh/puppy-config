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

    public function testSetWithReplacement()
    {
        $config = new ArrayConfig([
            'key1' => '%key3%',
        ]);

        $config['key2'] = '%key1%';
        $this->assertSame('%key3%', $config['key2']);

        $config['key3'] = 'value';
        $this->assertSame('value', $config['key1']);
        $this->assertSame('value', $config['key2']);
        $this->assertSame('value', $config['key3']);
    }
}
 