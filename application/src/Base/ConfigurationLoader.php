<?php

namespace TailorTest\Base;

use TailorTest\Base\Exception\ConfigurationException;

/**
 * Class ConfigurationLoader
 *
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class ConfigurationLoader {

    const INVALID_KEY = -65874867451838;

    protected $baseConfig = "base.php";

    protected $dir;
    protected $config;

    public function __construct(string $dir) {
        if (!is_dir($dir)) {
            throw new ConfigurationException("Given parameter does not contain a directory.");
        }

        if (!is_readable($dir)) {
            throw new ConfigurationException("Cannot read given configuration directory.");
        }

        $this->dir = $dir;
    }

    public function get(string $key) {
        $key = explode("/", strtolower($key));

        $current = $this->config;
        foreach ($key as $k) {
            $current = ($current[$k] ?? self::INVALID_KEY);
        }

        if ($current === self::INVALID_KEY) {
            return null;
        }

        return $current;
    }

    public function load() : ConfigurationLoader {
        $this->config = include($this->dir . DIRECTORY_SEPARATOR . $this->baseConfig);

        return $this;
    }
}