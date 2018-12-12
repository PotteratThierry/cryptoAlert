<?php

class exErrorDB extends  Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
    }

    // chaîne personnalisée représentant l'objet
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "Connection à la base de données impossible\n";
    }

}
