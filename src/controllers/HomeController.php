<?php
namespace App\Controllers;

class HomeController
{
    public function home($request, $response, $args)
    {
        // prepair return data
        $data[] = [ 'Api' => 'Home route'];
        $response = $response->withJson($data);
        return $response;
    }
}
