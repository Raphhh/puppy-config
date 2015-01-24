<?php
namespace Puppy\Config;

/**
 * Interface IConfig
 * @package Puppy\Config
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
interface IConfig
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);
}
 