<?php
namespace Puppy\Config;

/**
 * Class Config
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Config extends ArrayConfig
{
    /**
     * @var string
     */
    private $env;

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
     * @param string $env
     * @param string $dirPath
     * @param string $mainConfigFileName
     * @param string $localConfigFileName
     */
    public function __construct(
        $env = '',
        $dirPath = 'config',
        $mainConfigFileName = 'global',
        $localConfigFileName = 'local'
    )
    {
        $this->setEnv($env);
        $this->setDirPath($dirPath);
        $this->setMainConfigFileName($mainConfigFileName);
        $this->setLocalConfigFileName($localConfigFileName);
        parent::__construct($this->getVars());
    }

    /**
     * @return string
     */
    public function getMainFilePath()
    {
        return $this->getRealPath($this->getDirPath() . DIRECTORY_SEPARATOR . $this->getMainConfigFileName() . '.php');
    }

    /**
     * @return string
     */
    public function getEnvFilePath()
    {
        return $this->getRealPath($this->getDirPath() . DIRECTORY_SEPARATOR . $this->getEnv() . '.php');
    }

    /**
     * @return string
     */
    public function getLocalFilePath()
    {
        return $this->getRealPath($this->getDirPath() . DIRECTORY_SEPARATOR . $this->getLocalConfigFileName() . '.php');
    }

    /**
     * @return array
     */
    private function getVars()
    {
        return $this->getFilesContent(
            [
                $this->getMainFilePath(),
                $this->getEnvFilePath(),
                $this->getLocalFilePath(),
            ]
        );
    }

    /**
     * @param string[] $filePaths
     * @return array
     */
    private function getFilesContent(array $filePaths)
    {
        $result = [];
        foreach (array_filter($filePaths) as $filePath) {
            $result = array_merge($result, require $filePath);
        }
        return $result;
    }

    /**
     * @param string $filePath
     * @return string
     */
    private function getRealPath($filePath)
    {
        $filePath = realpath($filePath);
        if (file_exists($filePath) && is_readable($filePath)) {
            return $filePath;
        }
        return '';
    }

    /**
     * Setter of $dirPath
     *
     * @param string $dirPath
     */
    private function setDirPath($dirPath)
    {
        $this->dirPath = (string)$dirPath;
    }

    /**
     * Getter of $dirPath
     *
     * @return string
     */
    private function getDirPath()
    {
        return $this->dirPath;
    }

    /**
     * Setter of $env
     *
     * @param string $env
     */
    private function setEnv($env)
    {
        $this->env = (string)$env;
    }

    /**
     * Getter of $env
     *
     * @return string
     */
    private function getEnv()
    {
        return $this->env;
    }

    /**
     * Setter of $mainConfigFileName
     *
     * @param string $mainConfigFileName
     */
    private function setMainConfigFileName($mainConfigFileName)
    {
        $this->mainConfigFileName = (string)$mainConfigFileName;
    }

    /**
     * Getter of $mainConfigFileName
     *
     * @return string
     */
    private function getMainConfigFileName()
    {
        return $this->mainConfigFileName;
    }

    /**
     * Getter of $localConfigFileName
     *
     * @return string
     */
    private function getLocalConfigFileName()
    {
        return $this->localConfigFileName;
    }

    /**
     * Setter of $localConfigFileName
     *
     * @param string $localConfigFileName
     */
    private function setLocalConfigFileName($localConfigFileName)
    {
        $this->localConfigFileName = (string)$localConfigFileName;
    }

}
 
