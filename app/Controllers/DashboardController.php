<?php

namespace App\Controllers;

use App\Helpers\Renderer;
use App\Services\AuthJWT;

class DashboardController
{
    private $adminName;

    public function __construct()
    {
        $authJwt         = new AuthJWT();
        $this->adminName = $authJwt->getLoggedInAdminName();
    }

    public function index()
    {
        Renderer::render('dashboard/index', ['adminName' => $this->adminName]);
    }
}
