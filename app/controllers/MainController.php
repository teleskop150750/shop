<?php


namespace app\controllers;


use iShop\App;
use iShop\Cache;
use RedBeanPHP\R;

class MainController extends AppControllers
{
    public function indexAction()
    {
        $this->setMeta(
            App::$app->getProperty('shop_name'),
            'описание',
            'ключевые слова',
        );
    }
}