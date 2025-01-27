<?php

namespace App\Controllers;

use App\Helpers\Renderer;
use App\Repositories\AdminRepository;
use App\Services\AdminService;
use App\Services\AuthJWT;

class AdminController
{
    private $db;
    private $adminService;
    private $loggedInAdminId;
    private $loggedInAdminName;

    public function __construct($db)
    {
        $this->db = $db;
        $this->adminService = new AdminService(new AdminRepository($this->db));

        $authJwt                 = new AuthJWT();
        $this->loggedInAdminName = $authJwt->getLoggedInAdminName();
        $this->loggedInAdminId   = $authJwt->getLoggedInAdminId();
    }

    public function index()
    {
        $admins = $this->adminService->getAllAdmins();
        Renderer::render('admins/index', ['admins' => $admins, 'adminName' => $this->loggedInAdminName]);
    }

    public function show($id)
    {
        $admin = $this->adminService->getAdminById($id);
        Renderer::render('admins/show', ['admin' => $admin, 'adminName' => $this->loggedInAdminName]);
    }

    public function create()
    {
        Renderer::render('admins/create', ['adminName' => $this->loggedInAdminName]);
    }

    public function store()
    {
        try {

            $data = $_POST;

            $this->adminService->createAdmin($data);

            http_response_code(201);
            echo json_encode(['message' => 'Admin cadastrado com sucesso.']);

        } catch(\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $admin = $this->adminService->getAdminById($id);
        Renderer::render('admins/edit', ['admin' => $admin, 'adminName' => $this->loggedInAdminName]);
    }

    public function update($id)
    {
        try {

            $input = file_get_contents('php://input');

            $data = [];

            parse_str($input, $data);

            $this->adminService->updateAdmin($id, $data);

            http_response_code(200);
            echo json_encode(['message' => 'Cliente alterado com sucesso.']);

        } catch(\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            // Verifica se a sessão já está ativa antes de iniciar
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $isLoggedOut = false;

            // Verifica se o administrador logado é o mesmo que está sendo excluído
            if ($this->loggedInAdminId == $id) {

                if (isset($_SESSION['access_token'])) {
                    unset($_SESSION['access_token']);
                }

                session_destroy();

                $isLoggedOut = true;
            }

            $this->adminService->deleteAdmin($id);

            http_response_code(200);
            echo json_encode(['message' => 'Admin excluído com sucesso.', 'logged_out' => $isLoggedOut]);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
