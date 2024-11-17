<?php

namespace Api\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class Home.
 *
 * This is the default API controller.
 */
class Home extends RestControllers
{
    /**
     * Default action.
     */
    public function index(): ResponseInterface
    {
        return $this->respond('T_ANH');
    }
}
