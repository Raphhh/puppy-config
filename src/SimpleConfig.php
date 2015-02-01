<?php
namespace Puppy\Config;

/**
 * Class SimpleConfig
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SimpleConfig implements IConfig
{

    /**
     * @var array
     */
    private $vars;

    /**
     * @param array $vars
     */
    public function __construct(array $vars)
    {
        $this->initVars($vars);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return isset($this->vars[$key]) ? $this->vars[$key] : null;
    }

    /**
     *
     */
    private function initVars(array $vars)
    {
        $this->vars = $this->replace($vars);
    }

    /**
     * @param array $vars
     * @return array
     */
    private function replace(array $vars)
    {
        $replacement = $this->formatKeys($vars);
        foreach ($vars as $key => $var) {
            if(is_string($var)){
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
            $result['%' . $key . '%'] = $value;
        }
        return $result;
    }
}
 