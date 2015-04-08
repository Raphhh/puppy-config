<?php
namespace Puppy\Config\FileReader;

/**
 * Class IniFileReaderTest
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class IniFileReaderTest extends \PHPUnit_Framework_TestCase
{

    public function testGetFileExtension()
    {
        $fileReader = new IniFileReader();
        $this->assertSame('.ini', $fileReader->getFileExtension());
    }

    public function testRead()
    {
        $fileReader = new IniFileReader();
        $this->assertSame(
            [
                'a' => '1',
                'b' => '5',
                'c' => 'c',
                'd' => 'd',
            ],
            $fileReader->read(__DIR__ . '/resources/config.ini')
        );
    }
}
