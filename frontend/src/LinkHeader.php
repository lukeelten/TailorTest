<?php

namespace TailorTest\Frontend;

class LinkHeader {

    protected $headers = [];

    protected $base;

    public function __construct(string $base) {
        $this->base = $base;
    }

    public function addStylesheet(string $url, $relative = true) : LinkHeader{
        $realUri = (($relative) ? $this->base : "") . $url;
        $this->headers[] = '<' . $realUri . '>; rel="stylesheet"';

        return $this;
    }

    public function addScript(string $url, $relative = true) : LinkHeader {
        $realUri = (($relative) ? $this->base : "") . $url;
        $this->headers[] = '<' . $realUri. '>; rel="fragment-script"';

        return $this;
    }


    public function sendHeaders() {
        $value = join(", ", $this->headers);
        header("Link: " . $value);
    }
}