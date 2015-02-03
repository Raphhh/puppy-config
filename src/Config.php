<?php
namespace Puppy\Config;

/**
 * Class Config
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Config implements IConfig
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
     * @var SimpleConfig
     */
    private $simpleConfig;

    /**
     * @param string $env
     * @param string $dirPath
     * @param string $mainConfigFileName
     */
    public function __construct($env = '', $dirPath = 'config', $mainConfigFileName = 'global')
    {
        $this->setEnv($env);
        $this->setDirPath($dirPath);
        $this->setMainConfigFileName($mainConfigFileName);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (null === $this->simpleConfig) {
            $this->initSimpleConfig();
        }
        if(array_key_exists($key, $this->simpleConfig)){
            return $this->simpleConfig[$key];
        }
        return null;
    }

    /**
     *
     */
    private function initSimpleConfig()
    {
        $this->simpleConfig = new SimpleConfig($this->getFilesContent(
            [
                $this->getMainFilePath(),
                $this->getEnvFilePath(),
            ]
        ));
    }

    /**
     * @param string[] $filePaths
     * @return array
     */
    private function getFilesContent(array $filePaths)
    {
        $result = [];
        foreach ($filePaths as $filePath) {
            $filePath = $this->getRealPath($filePath);
            if ($filePath) {
                $result = array_merge($result, require $filePath);
            }
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
     * @return string
     */
    private function getMainFilePath()
    {
        return $this->getDirPath() . DIRECTORY_SEPARATOR . $this->getMainConfigFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getEnvFilePath()
    {
        return $this->getDirPath() . DIRECTORY_SEPARATOR . $this->getEnv() . '.php';
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

}
 
