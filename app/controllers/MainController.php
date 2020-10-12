<?php


namespace app\controllers;


use iShop\App;

class MainController extends AppControllers
{
    public function indexAction(): void
    {
        $this->setMeta(
            App::$app->getProperty('shop_name'),
            'описание',
            'ключевые слова',
        );
    }
}