<?php

namespace TailorTest\Base;

use Phalcon\DiInterface;
use Phalcon\Mvc\Model\Manager;


/**
 * Class AbstractService
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
abstract class AbstractService implements ServiceInterface {

    /**
     * @var string
     */
    protected static $prefix;

    /**
     * @var DiInterface
     */
    protected $di;

    public static function getPrefix(): string {
        return static::$prefix;
    }

    public function setDI(DiInterface $dependencyInjector) {
        $this->di = $dependencyInjector;
    }

    public function getDI() {
        return $this->di;
    }

    protected function getDb() : Manager {
        return $this->di->getShared("modelsManager");
    }
}