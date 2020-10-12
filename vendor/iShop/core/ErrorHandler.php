<?php


namespace iShop;


use Exception;

class ErrorHandler
{

    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * Обработчик исключений
     * @param Exception $e
     */
    public function exceptionHandler(object $e): void
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    /**
     * Отправляет сообщение об ошибке заданному обработчику ошибок
     * @param string $message
     * @param string $file
     * @param string $line
     */
    protected function logErrors(string $message = '', string $file = '', string $line = ''): void
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n=================\n", 3, ROOT . '/tmp/errors.log');
    }

    /**
     * Отобразить исключение
     * @param string $errno
     * @param string $errstr
     * @param string $errfile
     * @param string $errline
     * @param int $responce
     */
    protected function displayError(string $errno, string $errstr, string $errfile, string $errline, int $responce = 404): void
    {
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        } elseif (DEBUG) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }
}