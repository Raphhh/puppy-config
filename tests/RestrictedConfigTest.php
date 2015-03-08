<?php
namespace Puppy\Config;

/**
 * Class RestrictedConfigTest
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class RestrictedConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testOffsetExists()
    {
        $data = [
            'a.a' => 'a.a',
            'b.a' => 'b.a'
        ];
        $config = new RestrictedConfig('a', '.', $data);
        $this->assertTrue(isset($config['a']));
        $this->assertFalse(isset($config['a.a']));
        $this->assertFalse(isset($config['b']));
    }

    public function testOffsetGet()
    {
        $data = [
            'a.a' => 'a.a',
            'b.a' => 'b.a'
        ];
        $config = new RestrictedConfig('a', '.', $data);
        $this->assertSame('a.a', $config['a']);
    }

    public function testOffsetSet()
    {
        $data = [
            'a.a' => 'a.a',
            'b.a' => 'b.a'
        ];
        $config = new RestrictedConfig('a', '.', $data);
        $config['b'] = 'a.b';
        $this->assertSame('a.b', $config['b']);//todo: must change in the global config!
    }

    public function testOffsetUnset()
    {
        $data = [
            'a.a' => 'a.a',
            'b.a' => 'b.a'
        ];
        $config = new RestrictedConfig('a', '.', $data);
        $this->assertTrue(isset($config['a']));
        unset($config['a']);//todo: must change in the global config!
        $this->assertFalse(isset($config['a']));
    }

    public function testGetArrayCopy ()
    {
        $data = [
            'a.a' => 'a.a',
            'b.a' => 'b.a'
        ];
        $config = new RestrictedConfig('a', '.', $data);
        $this->assertSame(
            [
                'a' => 'a.a',
            ],
            $config->getArrayCopy()
        );
    }
}
