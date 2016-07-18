<?php

namespace Mvc\Controller;

use Mvc\Component\Controller;
use Mvc\Component\Http\Response;

class AppController extends Controller
{
    protected $layout = 'main';

    public function indexAction()
    {
        $content = $this->view->render('index');
        return new Response($content);
    }
}