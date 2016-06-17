<?php

namespace Mvc\Controller;

use Mvc\Component\Controller;
use Mvc\Component\Http\Request;
use Mvc\Component\Http\Response;

class IndexController extends Controller
{
    public $layout = 'main';

    public function indexAction(Request $request)
    {
        $content = $this->view->render('index');
        return new Response($content);
    }
}