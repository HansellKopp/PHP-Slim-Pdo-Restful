<?php
namespace App\Controllers;

/**
 *  Base controller
 *  create container instance
 */
class BaseController
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    /*
     * get container instance
     */
    public function getContainer()
    {
        return $this->getContainer();
    }
    /*
     * get slim-pdo instance
     */
    public function getPDO()
    {
        return $this->container->get('pdo');
    }
}
