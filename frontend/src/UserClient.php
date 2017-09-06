<?php

namespace TailorTest\Frontend;

use Httpful\Request;

class UserClient {

    protected $baseUrl = "http://backend/user";

    public function getAll() : array {

        $response = Request::get($this->baseUrl . "/")
            ->send();

        $users = $response->__toString();

        return json_decode($users, true);
    }

}