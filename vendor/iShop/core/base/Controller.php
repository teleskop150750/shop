<?php


namespace iShop\base;


abstract class Controller
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

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView()
    {
        // var_dump($this->layout);
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);
    }

    /**
     * Записать данные
     * @param array $data
     */
    protected function set(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Записать meta
     * @param string $title
     * @param string $desc
     * @param string $keywords
     */
    protected function setMeta(string $title = '', string $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}