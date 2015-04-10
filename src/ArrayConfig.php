<?php
namespace Puppy\Config;

/**
 * Class SimpleConfig
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ArrayConfig extends \ArrayObject
{

    /**
     * @param array|\ArrayObject $data
     */
    public function __construct($data)
    {
        if(!($data instanceof self)){
            $data = $this->buildConfig($data);
        }
        parent::__construct($data);
    }

    /**
     * restricts the config to a specific visibility.
     *
     * @param string $restriction
     * @param string $separator
     * @return RestrictedConfig
     */
    public function restrict($restriction, $separator = '.')
    {
        return new RestrictedConfig($restriction, $separator, $this);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        parent::offsetSet($key, $value);
        $this->exchangeArray($this->buildConfig(parent::getArrayCopy()));
    }

    /**
     * @param array|\ArrayObject $data
     * @return array
     */
    private function buildConfig($data)
    {
        return $this->replace($data, $this->formatKeys($data));
    }

    /**
     * @param array|\ArrayObject $data
     * @return array
     */
    private function formatKeys($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $result['%' . $key . '%'] = $value;
            }
        }
        return $result;
    }

    /**
     * @param $data
     * @param array $replacements
     * @return mixed
     */
    private function replace($data, array $replacements)
    {
        foreach ($data as $key => $var) {
            if (is_string($var)) {
                $data[$key] = strtr($var, $replacements);
            }elseif(is_array($var)){
                $data[$key] = $this->replace($var, $replacements);
            }
        }
        return $data;
    }
}
 