<?php

namespace App\Middleware;

use App\Services\AuthJWT;

class AuthMiddleware
{
    private $authJwt;

    public function __construct()
    {
        $this->authJwt = new AuthJWT();
    }

    public function handle($request, $next)
    {
        session_start();

        if (isset($_SESSION['access_token'])) {

            $isAuthenticated = $this->authJwt->authenticate($_SESSION['access_token']);

            if ($isAuthenticated) {
                return $next($request);
            }
        }

        header('Location: /admin/login');
        exit();
    }
}
