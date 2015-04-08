<?php
namespace Puppy\Config\FileReader;

use Symfony\Component\Yaml\Parser;

/**
 * Class YmlFileReader
 * @package Puppy\Config\FileReader
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class YmlFileReader implements IFileReader
{
    /**
     * @var Parser
     */
    private $yaml;

    /**
     * @param Parser $yaml
     */
    public function __construct(Parser $yaml = null)
    {
        $this->yaml = $yaml ? : new Parser();
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return '.yml';
    }

    /**
     * @param $filePath
     * @return array
     */
    public function read($filePath)
    {
        return $this->yaml->parse(file_get_contents($filePath), true);
    }
}
