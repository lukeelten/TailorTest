<?php

namespace TailorTest\Base;


use Phalcon\Di\FactoryDefault;
use Phalcon\DiInterface;
use Phalcon\Mvc\Micro;

/**
 * Class ServiceComposer
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class ServiceComposer {

    /**
     * @var string[]
     */
    protected $services = [];


    /**
     * @return DiInterface
     */
    protected function _initDI() : DiInterface {
        $di = new FactoryDefault();

        // setup config
        $di->setShared("config", function() {
            $config = new ConfigurationLoader(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config");
            return $config->load();
        });

        // Setup db
        $di->setShared("db", function() use($di) {
            $config = $di->get("config");
            $driver = $config->get("db/driver");

            return new $driver([
                "host" => $config->get("db/host"),
                "username" => $config->get("db/username"),
                "password" => $config->get("db/password"),
                "dbname" => $config->get("db/database")
            ]);
        });

        $di->setShared("errorHandler", ErrorHandler::class);
        $di->setShared("notFoundHandler", NotFoundHandler::class);

        return $di;
    }


    /**
     * @param string $service
     * @return ServiceComposer Fluent Interface
     * @see ServiceInterface
     */
    public function addService(string $service) : ServiceComposer {
        $this->services[] = $service;

        return $this;
    }

    protected function _initDefaultRoutes(Micro $app) {
        $app->map("/", function() {
            return new JsonResponse(["status" => true]);
        });
    }


    /**
     * @return void
     */
    public function run() {
        $di = $this->_initDI();

        $app = new Micro($di);
        $app->error($di->getShared("errorHandler"))
            ->notFound($di->getShared("notFoundHandler"));

        foreach ($this->services as $service) {
            $key = sha1($service);
            $uri = $service::getPrefix() . "(/.*)*";

            $di->set($key, $service);

            $app->map($uri, function () use ($key, $di) {
                return $di->get($key);
            });
        }
        $this->_initDefaultRoutes($app);

        $service = $app->handle();
        if ($service instanceof ServiceInterface) {
            $app = new Micro($di);
            $app->error($di->getShared("errorHandler"))
                ->notFound($di->getShared("notFoundHandler"))
                ->mount($service->getRoutes())
                ->handle();
        }
    }

}