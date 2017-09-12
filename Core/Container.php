<?php

namespace Core;

use Core\DataBase;

class Container {

    public static function newController($contoller) {
        $objController = 'App\\Controllers\\' . $contoller;
        return new $objController;
    }

    public static function getModel($model) {
        $objModel = "App\\Models\\" . $model;
        return new $objModel(DataBase::getDataBase());
    }

    public static function pageNotFound() {
        if (file_exists(__DIR__ . "/../App/Views/404.phtml")) {
            return require(__DIR__ . "/../App/Views/404.phtml");
        } else {
            echo "Erro 404: Page not found!";
        }
    }

}
