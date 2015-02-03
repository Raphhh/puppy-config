<?php
namespace Puppy\Config;

/**
 * Class SimpleConfig
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SimpleConfig extends \ArrayObject
{

    /**
     * @param array $vars
     */
    public function __construct(array $vars)
    {
        parent::__construct($this->replace($vars));
    }

    /**
     * @param array $vars
     * @return array
     */
    private function replace(array $vars)
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
     * @param array $vars
     * @return array
     */
    private function formatKeys(array $vars)
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
 