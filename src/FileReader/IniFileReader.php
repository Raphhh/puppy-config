<?php
namespace Puppy\Config\FileReader;

/**
 * Class IniFileReader
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class IniFileReader implements IFileReader
{
    /**
     * @return string
     */
    public function getFileExtension()
    {
        return '.ini';
    }

    /**
     * @param $filePath
     * @return array
     */
    public function read($filePath)
    {
        return parse_ini_file($filePath);
    }
}
