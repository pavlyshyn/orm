<?php

namespace Pavlyshyn;

class Model {

    use \Pavlyshyn\Data\Getter,
        \Pavlyshyn\Data\Setter;

    public function getProperties() {
        return get_object_vars($this);
    }

}
