<?php


namespace iShop\base;


use Exception;

class View
{
    protected array $route = [];
    protected string $controller = '';
    protected string $model = '';
    protected string $view = '';
    protected string $prefix = '';
    public ?string $layout = '';
    protected array $data = [];
    public array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => '',
    ];

    public function __construct(array $route, ?string $layout = '', string $view = '', array $meta = [])
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->model = $route['controller'];
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layout === null) {
            $this->layout = null;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    /**
     * рендер
     * @param array $data
     * @throws Exception
     */
    public function render(array $data): void
    {
        // debug($data);
        if (is_array($data)) {
            extract($data);
        }
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new Exception("Не найден вид {$viewFile}", 500);
        }

        if ($this->layout !== null) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new Exception("Не найден шаблон {$this->layout}", 500);
            }
        }
    }

    public function getMeta()
    {
        return '<title>' . $this->meta['title'] . '</title>' . PHP_EOL
            . '<meta name="description" content"' . $this->meta['description'] . '">' . PHP_EOL
            . '<meta name="keywords" content"' . $this->meta['keywords'] . '">' . PHP_EOL;
    }
}