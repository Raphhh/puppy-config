<?php
namespace Puppy\Config\FileReader;

/**
 * Class JsonFileReaderTest
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class JsonFileReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFileExtension()
    {
        $fileReader = new JsonFileReader();
        $this->assertSame('.json', $fileReader->getFileExtension());
    }

    public function testRead()
    {
        $fileReader = new JsonFileReader();
        $this->assertSame(
            [
                'a' => [
                    'b',
                    123,
                ]
            ],
            $fileReader->read(__DIR__ . '/resources/config.json')
        );
    }
}
