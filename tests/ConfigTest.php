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
        $this->assertSame('value1', $config['key1']);
    }

    public function testGetInEnv()
    {
        $config = new Config('dev');
        $this->assertSame('value1b', $config['key1']);
    }

    public function testGetWithOtherDir()
    {
        $config = new Config('', 'config2');
        $this->assertSame('value1c', $config['key1']);
    }

    public function testGetWithOtherFileName()
    {
        $config = new Config('', 'config3', 'foo');
        $this->assertSame('value1d', $config['key1']);
    }

    public function testGetInMainWithReplacement()
    {
        $config = new Config();
        $this->assertSame('value1', $config['key2']);
    }

    public function testGetInEnvWithReplacement()
    {
        $config = new Config('dev');
        $this->assertSame('value1b', $config['key2']);
    }

    public function testGetWithoutExistingDir()
    {
        $this->assertFalse(is_dir('foo'));

        $config = new Config('', 'foo');
        $this->assertFalse(isset($config['key1']));
    }

    public function testGetWithoutExistingFile()
    {
        $this->assertFalse(is_file('config3/main.php'));
        $this->assertFalse(is_file('config3/bar.php'));

        $config = new Config('', 'config3', 'bar');
        $this->assertFalse(isset($config['key1']));
    }
}
 