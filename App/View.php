<?php

declare(strict_types=1);

namespace App;

use App\Exception\ViewNotFoundException;

class View
{

    /**
     * @param string $string
     */
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public static function make(string $view, array $params = []):static
    {
        return new static($view, $params);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if(!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        extract($this->params);

        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}