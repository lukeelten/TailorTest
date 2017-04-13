<?php

namespace TailorTest\Base;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use TailorTest\Base\Exception\HttpException;

/**
 * Class ErrorHandler
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class ErrorHandler implements InjectionAwareInterface {

    protected $di;

    public function __invoke(\Exception $ex) : ResponseInterface {
        $debug = $this->getDI()->getShared("config")->get("debug");

        $response = new Response();

        if ($ex instanceof HttpException) {
            $response->setStatusCode($ex->getCode(), $ex->getMessage());
        } else {
            $response->setStatusCode(500);
        }

        if ($debug) {
            // In debug mode, send stacktrace in response
            $response->setContent("<pre>" . print_r($ex->getTrace(), true) . "</pre>")
                ->setHeader("X-Exception-File", $ex->getFile())
                ->setHeader("X-Exception-Line", $ex->getLine())
                ->setHeader("X-Exception-Code", $ex->getCode())
                ->setHeader("X-Exception-Type", get_class($ex))
                ->setHeader("X-Exception-Message", $ex->getMessage());

            throw $ex;
        } else {
            // @todo Log exception
        }

        return $response;
    }

    /**
     * Sets the dependency injector
     *
     * @param DiInterface $dependencyInjector
     */
    public function setDI(DiInterface $dependencyInjector) {
        $this->di = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return DiInterface
     */
    public function getDI() {
        return $this->di;
    }
}