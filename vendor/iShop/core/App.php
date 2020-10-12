<?php


namespace iShop;


class App
{
    public static Registry $app;

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
//        debug($query, 'строка запроса');
        self::$app = Registry::getInstance();
        $this->setParams();
        new ErrorHandler();
        Router::dispatch($query);
    }

    /**
     * записать параметры из params.php
     * в $app(Registry)->$properties = [];
     */
    private function setParams(): void
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    }
}