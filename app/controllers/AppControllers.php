<?php


namespace app\controllers;


use app\models\AppModel;
use iShop\base\Controller;

abstract class AppControllers extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModel();
    }
}