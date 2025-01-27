<?php

namespace App\Controllers;

use App\Helpers\Renderer;
use App\Services\AuthJWT;

class AuthController
{
    private $authJwt;

    public function __construct()
    {
        $this->authJwt = new AuthJWT();
    }

    public function loginForm()
    {
        Renderer::render('auth/login');
    }

    public function login()
    {
        try {

            session_start();

            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $token = $this->authJwt->login($email, $password);

            if ($token) {
                $_SESSION['access_token'] = $token;

                http_response_code(200);
                echo json_encode(['message' => 'Admin logado com sucesso.']);
                return;
            }

            http_response_code(500);
            echo json_encode(['error' => 'Credenciais inválidas']);

        } catch(\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
