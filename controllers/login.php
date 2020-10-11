<?php

namespace controllers;

class Login {

    public function init() {

        echo 'Estoy en init';
        $name = "Matias";

        include ROOT . '/views/login.php';

    }

}