<?php

namespace App;

class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        return include "Views/$view.php";
    }
}