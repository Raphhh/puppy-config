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
        if($data instanceof self){
            parent::__construct($data);
        }else{
            parent::__construct($this->replace($data));
        }
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        parent::offsetSet($key, $value);
        $this->exchangeArray($this->replace(parent::getArrayCopy()));
    }

    /**
     * @param array|\ArrayObject $vars
     * @return array
     */
    private function replace($vars)
    {
        $replacement = $this->formatKeys($vars);
        foreach ($vars as $key => $var) {
            if (is_string($var)) {
                $vars[$key] = strtr($var, $replacement);
            }
        }
        return $vars;
    }

    /**
     * @param array|\ArrayObject $vars
     * @return array
     */
    private function formatKeys($vars)
    {
        $result = [];
        foreach ($vars as $key => $value) {
            if (is_string($value)) {
                $result['%' . $key . '%'] = $value;
            }
        }
        return $result;
    }
}
 