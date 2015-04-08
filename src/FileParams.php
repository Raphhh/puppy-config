<?php
namespace Puppy\Config;

/**
 * Class FileParams
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class FileParams 
{
    /**
     * @var string
     */
    private $dirPath;

    /**
     * @var string
     */
    private $mainConfigFileName;

    /**
     * @var string
     */
    private $localConfigFileName;

    /**
     * @param string $dirPath
     * @param string $mainConfigFileName
     * @param string $localConfigFileName
     */
    public function __construct($dirPath = 'config', $mainConfigFileName = 'global', $localConfigFileName = 'local')
    {
        $this->setDirPath($dirPath);
        $this->setMainConfigFileName($mainConfigFileName);
        $this->setLocalConfigFileName($localConfigFileName);
    }

    /**
     * Setter of $dirPath
     *
     * @param string $dirPath
     */
    public function setDirPath($dirPath)
    {
        $this->dirPath = (string)$dirPath;
    }

    /**
     * Getter of $dirPath
     *
     * @return string
     */
    public function getDirPath()
    {
        return $this->dirPath;
    }


    /**
     * Setter of $mainConfigFileName
     *
     * @param string $mainConfigFileName
     */
    public function setMainConfigFileName($mainConfigFileName)
    {
        $this->mainConfigFileName = (string)$mainConfigFileName;
    }

    /**
     * Getter of $mainConfigFileName
     *
     * @return string
     */
    public function getMainConfigFileName()
    {
        return $this->mainConfigFileName;
    }

    /**
     * Getter of $localConfigFileName
     *
     * @return string
     */
    public function getLocalConfigFileName()
    {
        return $this->localConfigFileName;
    }

    /**
     * Setter of $localConfigFileName
     *
     * @param string $localConfigFileName
     */
    public function setLocalConfigFileName($localConfigFileName)
    {
        $this->localConfigFileName = (string)$localConfigFileName;
    }
}
