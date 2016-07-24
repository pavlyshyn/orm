<?php

namespace Pavlyshyn\Data\Type;

use Pavlyshyn\Data\Type;

class Datetime extends Type {

    protected $format;

    public function __construct($name, $format) {
        parent::__construct($name);

        $this->format = $format;
    }

    public function sanitize($value) {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof \DateTime) {
            $value = new \DateTime($value);
        }

        return $value->format($this->format);
    }

}
