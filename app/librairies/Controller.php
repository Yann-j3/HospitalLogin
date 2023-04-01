<?php
//Controller de haut niveau

abstract class Controller
{
    public function loadModel(string $model)
    {
        require_once(__DIR__.'/../models/' . $model . '.php');
        $this->model = new $model();
        return $this->model;
    }

    public function render($vue, array $data = [])
    {
        extract($data);
        require_once(__DIR__. '/../views/' . strtolower(get_class($this)) . '/' . $vue . '.php');
    }

}
