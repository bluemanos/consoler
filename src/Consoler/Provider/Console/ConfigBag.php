<?php

namespace Consoler\Provider\Console;

/**
 * Usage
 * -------.
 *
 * - make some config files in the $dir directory (in __construct($dir))
 *
 * ex : database.php : return [
 *              'connections' => [
 *                  'default' => [
 *                      'host' => '%database.host%'
 *                  ]
 *              ]
 *          ]
 *
 *  - get the key : $configBag->get('database.connections.default.host')
 */
class ConfigBag
{
    /**
     * The directory where to find config files.
     */
    private $dir;

    /**
     * lazy loaded config files.
     */
    private $config = [];

    /**
     * Key already fetched.
     */
    private $cachedConfig = [];

    /**
     * @var string the config dir
     */
    public function __construct($dir)
    {
        $this->dir = rtrim($dir, '/').'/';
    }

    /**
     * @param string $key asked value (ex: "database.default.host")
     */
    public function get($key)
    {
        if (!array_key_exists($key, $this->cachedConfig)) {

            // key as array, ex : ["database", "default", "host"']
            $keys = explode('.', $key);

            // grab the first key, it is the filename (without extension)
            $filename = array_shift($keys);

            // first times we need this file
            if (!isset($this->config[$filename])) {
                $this->config[$filename] = require $this->dir.$filename.'.php';
            }

            // get the global value
            $value = $this->config[$filename];

            // and the right one
            foreach ($keys as $k) {
                $value = $value[$k];
            }

            $this->cachedConfig[$key] = $value;
        }

        return $this->cachedConfig[$key];
    }
}
