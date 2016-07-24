<?php

namespace Pavlyshyn;

class Model {
    
    use \Pavlyshyn\Data\Getter,
        \Pavlyshyn\Data\Setter;

    public function getProperties() {
        $parameters = get_object_vars($this);
        
        // todo: add types
        
        return $parameters;
    }
}
