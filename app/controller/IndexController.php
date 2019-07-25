<?php

/**
 * Index controller
 */
class IndexController
{
    /**
     * Index function
     *
     * @return void
     */
    public function index()
    {
        $view = new View();
        $view->render(
            'index', [
            'message' => 'Hello there'
            ]
        );
    }
}