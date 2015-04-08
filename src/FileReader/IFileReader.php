<?php
namespace Puppy\Config\FileReader;

/**
 * Interface IFileReader
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
interface IFileReader 
{
    /**
     * @return string
     */
    public function getFileExtension();

    /**
     * @param $filePath
     * @return array
     */
    public function read($filePath);
}
