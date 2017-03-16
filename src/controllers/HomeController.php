<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function home($request, $response, $args)
    {
        return $this->getViewRender()->render($response, 'index.html');
    }
}
