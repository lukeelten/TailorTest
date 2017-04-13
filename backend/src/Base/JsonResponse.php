<?php

namespace TailorTest\Base;

use Phalcon\Http\Response;

/**
 * Class JsonResponse
 * @package TailorTest\Base
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class JsonResponse extends Response {

    public function __construct(array $json) {
        parent::__construct();

        $this->setJsonContent($json);
    }

}