<?php
namespace Puppy\Config;

use Puppy\Config\FileReader\IFileReader;
use Puppy\Config\FileReader\PhpFileReader;

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
     * @var IFileReader
     */
    private $fileReader;

    /**
     * @param string $env
     * @param FileParams $fileParams
     * @param IFileReader $fileReader
     */
    public function __construct($env = '', FileParams $fileParams = null, IFileReader $fileReader = null)
    {
        $this->setEnv($env);
        $this->setFileParams($fileParams ? : new FileParams());
        $this->setFileReader($fileReader ? : new PhpFileReader());
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
     * Getter of $fileReader
     *
     * @return IFileReader
     */
    public function getFileReader()
    {
        return $this->fileReader;
    }

    /**
     * @return string
     */
    public function getMainFilePath()
    {
        return $this->getFileParams()->getDirPath()
                . DIRECTORY_SEPARATOR
                . $this->getFileParams()->getMainConfigFileName()
                . $this->getFileReader()->getFileExtension();
    }

    /**
     * @return string
     */
    public function getEnvFilePath()
    {
        return $this->getFileParams()->getDirPath()
                . DIRECTORY_SEPARATOR
                . $this->getEnv()
                . $this->getFileReader()->getFileExtension();
    }

    /**
     * @return string
     */
    public function getLocalFilePath()
    {
        return $this->getFileParams()->getDirPath()
                . DIRECTORY_SEPARATOR
                . $this->getFileParams()->getLocalConfigFileName()
                . $this->getFileReader()->getFileExtension();
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
                $result = array_merge($result, $this->getFileReader()->read($filePath));
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

    /**
     * Setter of $fileReader
     *
     * @param IFileReader $fileReader
     */
    private function setFileReader(IFileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }
}
 
