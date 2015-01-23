<?php
namespace Puppy\Config;

/**
 * Class ConfigTest
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    private $cwd;

    public function setUp()
    {
        $this->cwd = getcwd();
        chdir(__DIR__ . '/resources');
    }

    public function tearDown()
    {
        chdir($this->cwd);
    }

    public function testGetInMain()
    {
        $config = new Config();
        $this->assertSame('value1', $config->get('key1'));
    }

    public function testGetInEnv()
    {
        $config = new Config('dev');
        $this->assertSame('value1b', $config->get('key1'));
    }

    public function testGetWithOtherDir()
    {
        $config = new Config('', 'config2');
        $this->assertSame('value1c', $config->get('key1'));
    }

    public function testGetWithOtherFileName()
    {
        $config = new Config('', 'config3', 'foo');
        $this->assertSame('value1d', $config->get('key1'));
    }
}
 