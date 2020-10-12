<?php

use iShop\App;

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

new App();

//debug(Router::getRoutes());

//throw new Exception('Страница не найдена', 404);