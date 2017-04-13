<?php

namespace TailorTest\Base\Exception;


/**
 * Class HttpException
 * @package TailorTest\Base\Exception
 * @author Tobias Derksen <t.derksen@gmx.de>
 */
class HttpException extends Exception {

    public function __construct(int $code, string $msg) {
        parent::__construct($msg, $code);
    }
}