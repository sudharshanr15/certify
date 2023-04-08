<?php

namespace Certify\Certify\models;

class Signature extends Common{
    public function __construct()
    {
        $this->table = "signature";
    }
}