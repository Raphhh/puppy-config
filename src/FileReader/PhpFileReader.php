<?php
namespace Puppy\Config\FileReader;

/**
 * Class ArrayFileReader
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PhpFileReader implements IFileReader
{
    /**
     * @return string
     */
    public function getFileExtension()
    {
        return '.php';
    }

    /**
     * @param $filePath
     * @return array
     */
    public function read($filePath)
    {
        return require $filePath;
    }
}
