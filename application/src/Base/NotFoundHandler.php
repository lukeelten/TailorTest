<?php

namespace TailorTest\Base;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

/**
 * Handler for NotFound Exception if current URI does not match a route.
 *
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class NotFoundHandler implements InjectionAwareInterface {

    protected $di;

    /**
     * @var string Response body
     */
    protected static $NOTFOUND_BODY = "<!doctype html><html>"
        ."<head><title>404 Not found</title></head><body>"
        . "<h1>Not Found</h1>"
        . "<p>The requested URL was not found on this server.</p>"
        . "<hr>"
        . "<address>REST Service running magically.</address>"
        . "</body></html>";

    /**
     * @var string Type of response content
     */
    protected static $CONTENT_TYPE = "text/html";

    /**
     * Invoke NotFoundHandler and create 404 error response
     *
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface {
        $response = new Response();

        $response->setStatusCode(404)
            ->setContent(static::$NOTFOUND_BODY)
            ->setContentType(static::$CONTENT_TYPE);

        return $response;
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {
        $this->di = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI() {
        return $this->di;
    }
}