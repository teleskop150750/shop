<?php


namespace iShop;


use Exception;

class Router
{
    /**
     * массив  маршрутов
     * @var array
     */
    private static array $routes = [];
    /**
     * текущий маршрут
     * @var array
     */
    private static array $route = [];

    /**
     * добавить маршрут
     * @param string $regexp
     * @param array $route
     */
    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * получить массив маршрутов
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * получить текущий маршрут
     * @return array
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * отправить
     * @param string $url
     * @throws Exception
     */
    public static function dispatch(string $url): void
    {
        $url = self::removeQueryString($url);
//        try {
        if (self::matchRoute($url)) {
//            echo 'ok<br>';
            $controller = "app\\controllers\\"
                . self::$route['prefix']
                . self::$route['controller']
                . 'Controller';
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new Exception("Метод $controller::$action не найден", 404);
                }
            } else {
                throw new Exception("Контрролер $controller не найден", 404);
            }
        } else {
            throw new Exception('Страница не найдена', 404);
        }
//        } catch (Exception $e) {
//            http_response_code($e->getCode());
//            require WWW . '/errors/404.php';
//            die;
//        }
    }

    /**
     * найти соответствие маршруту
     * @param string $url
     * @return bool
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
//                debug($matches, 'matches');
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                /**
                 * нет вида
                 */
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                /**
                 *  префикс не установлен
                 */
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
//                debug(self::$route, 'route');
                return true;
            }
        }
        return false;
    }

    /**
     * upperCamelCase
     * @param string $name
     * @return string
     */
    private static function upperCamelCase(string $name): string
    {
        $name = str_replace(' ', '',
            ucwords(
                str_replace('-', ' ', $name)
            )
        );
//        debug($name);
        return $name;
    }

    /**
     * lowerCamelCase
     * @param string $name
     * @return string
     */
    private static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * удалить строку запроса
     * @param string $url
     * @return string
     */
    protected static function removeQueryString(string $url): string
    {
        /**
         * если $url не пуст
         */
        if ($url) {
            $params = explode('&', $url, 2);
//            debug($params, 'params');

            /**
             * нет '='
             */
            if (strpos($params[0], '=') === false) {
                return rtrim($params[0], '/');
            }
        }
        return '';
    }
}