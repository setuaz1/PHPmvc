<?php

namespace App;

class View
{

    /**
     * @param string $string
     */
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public function render()
    {
        include $this->view;
    }
}