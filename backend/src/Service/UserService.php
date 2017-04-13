<?php

namespace TailorTest\Service;

use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use TailorTest\Base\AbstractService;
use TailorTest\Base\Exception\HttpException;
use TailorTest\Base\JsonResponse;

class UserService extends AbstractService {

    protected static $prefix = "/user";

    public function getRoutes(): MicroCollection {
        $routes = new MicroCollection();

        $routes->setHandler($this)
            ->setPrefix(static::getPrefix());

        $routes->get("/", "getAll")
            ->get("/{id:[0-9]+}", "getOne");

        return $routes;
    }

    public function getAll() : ResponseInterface {
        $users = $this->getDb()->executeQuery("SELECT id,username,mail FROM TailorTest\\Models\\Users");

        if ($users == null) {
            throw new HttpException(500, "Query returned null.");
        }

        return new JsonResponse($users->toArray());
    }

    public function getOne(int $id) : ResponseInterface {
        if (empty($id) || $id < 0) {
            throw new HttpException(400, "Bad request: Parameter wrong.");
        }

        $users = $this->getDb()->executeQuery("SELECT id,username,mail FROM TailorTest\\Models\\Users WHERE id = :id:", ["id" => $id]);
        if (empty($users) || count($users) == 0) {
            throw new HttpException(404, "Not Found");
        }

        return new JsonResponse($users[0]->toArray());
    }
}