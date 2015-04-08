<?php
namespace Puppy\Config\FileReader;

/**
 * Class JsonFileReader
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class JsonFileReader implements IFileReader
{
    /**
     * @return string
     */
    public function getFileExtension()
    {
        return '.json';
    }

    /**
     * @param $filePath
     * @return array
     */
    public function read($filePath)
    {
        return json_decode(file_get_contents($filePath), true);
    }
}
