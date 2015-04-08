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
     * @var FileParams
     */
    private $fileParams;

    /**
     * @param string $env
     * @param FileParams $fileParams
     */
    public function __construct($env = '', FileParams $fileParams = null)
    {
        $this->setEnv($env);
        $this->setFileParams($fileParams ? : new FileParams());
        parent::__construct($this->getData());
    }

    /**
     * Getter of $env
     *
     * @return string
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * Getter of $fileParams
     *
     * @return FileParams
     */
    public function getFileParams()
    {
        return $this->fileParams;
    }

    /**
     * @return string
     */
    public function getMainFilePath()
    {
        return $this->getFileParams()->getDirPath() . DIRECTORY_SEPARATOR . $this->getFileParams()->getMainConfigFileName() . '.php';
    }

    /**
     * @return string
     */
    public function getEnvFilePath()
    {
        return $this->getFileParams()->getDirPath() . DIRECTORY_SEPARATOR . $this->getEnv() . '.php';
    }

    /**
     * @return string
     */
    public function getLocalFilePath()
    {
        return $this->getFileParams()->getDirPath() . DIRECTORY_SEPARATOR . $this->getFileParams()->getLocalConfigFileName() . '.php';
    }

    /**
     * @return array
     */
    private function getData()
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
        $filePath = stream_resolve_include_path($filePath);
        if ($filePath && is_readable($filePath)) {
            return $filePath;
        }
        return '';
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
     * Setter of $fileParams
     *
     * @param FileParams $fileParams
     */
    private function setFileParams(FileParams $fileParams)
    {
        $this->fileParams = $fileParams;
    }
}
 
