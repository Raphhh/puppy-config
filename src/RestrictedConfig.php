<?php
namespace Puppy\Config;

/**
 * Class RestrictedConfig
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class RestrictedConfig extends ArrayConfig
{
    /**
     * @var string
     */
    private $restriction;

    /**
     * @param string $restriction
     * @param string $separator
     * @param array|\ArrayObject $data
     */
    public function __construct($restriction, $separator, $data = array())
    {
        $this->setRestriction($restriction . $separator);
        parent::__construct($data);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return parent::offsetExists($this->getRestriction() . $key);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetGet($key)
    {
        return parent::offsetGet($this->getRestriction() . $key);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        parent::offsetSet($this->getRestriction() . $key, $value);
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key)
    {
        parent::offsetUnset($this->getRestriction() . $key);
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        $result = [];
        foreach(parent::getArrayCopy() as $key => $value){
            if(strpos($key, $this->getRestriction()) === 0){
                $result[str_replace($this->getRestriction(), '', $key)] = $value;
            }
        }
        return $result;
    }

    /**
     * Getter of $restriction
     *
     * @return string
     */
    private function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * Setter of $restriction
     *
     * @param string $restriction
     */
    private function setRestriction($restriction)
    {
        $this->restriction = (string)$restriction;
    }
}
