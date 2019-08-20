<?php

class Controller
{
    public function view($view, $data = [])
    {
        $dir = 'app/views/' . $view . '.php';
        if (is_readable($dir))
            require_once $dir;
        else
            return false;
    }

    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model;
    }

    public function sideBar($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }
}