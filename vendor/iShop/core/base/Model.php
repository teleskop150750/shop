<?php


namespace iShop\base;


use iShop\Db;

abstract class Model
{
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];

    public function __construct()
    {
        Db::getInstance();
    }
}