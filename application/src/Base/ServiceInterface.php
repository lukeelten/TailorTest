<?php

namespace TailorTest\Base;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Interface ServiceInterface
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
interface ServiceInterface extends InjectionAwareInterface {

    public static function getPrefix() : string;

    public function getRoutes() : MicroCollection;

    
}