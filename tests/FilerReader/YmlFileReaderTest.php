<?php
namespace Puppy\Config\FileReader;

/**
 * Class YmlFileReaderTest
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class YmlFileReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFileExtension()
    {
        $fileReader = new YmlFileReader();
        $this->assertSame('.yml', $fileReader->getFileExtension());
    }

    public function testRead()
    {
        $fileReader = new YmlFileReader();
        $this->assertSame(
            [
                'language' => 'php',
                'php' => [
                    5.4,
                    5.5,
                    5.6,
                ]
            ],
            $fileReader->read(__DIR__ . '/resources/config.yml')
        );
    }
}
