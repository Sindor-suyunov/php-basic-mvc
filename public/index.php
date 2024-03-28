<?php

use Core\Routing\BaseRouter;
use Core\Routing\Routes;

require '../vendor/autoload.php';
require '../src/Routes/index.php';

BaseRouter::make()->setRoutes(Routes::$routes);