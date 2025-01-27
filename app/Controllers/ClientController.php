<?php

namespace App\Controllers;

use App\Services\ClientService;
use App\Helpers\Renderer;
use App\Repositories\ClientRepository;
use App\Services\AuthJWT;

class ClientController
{
    private $db;
    private $clientService;
    private $adminName;

    public function __construct($db)
    {
        $this->db = $db;
        $this->clientService = new ClientService(new ClientRepository($this->db));

        $authJwt         = new AuthJWT();
        $this->adminName = $authJwt->getLoggedInAdminName();
    }

    public function index()
    {
        $clients = $this->clientService->getAllClients();
        Renderer::render('clients/index', ['clients' => $clients, 'adminName' => $this->adminName]);
    }

    public function show($id)
    {
        $client = $this->clientService->getClientByIdWithAddresses($id);
        Renderer::render('clients/show', ['client' => $client, 'adminName' => $this->adminName]);
    }

    public function create()
    {
        Renderer::render('clients/create', ['adminName' => $this->adminName]);
    }

    public function store()
    {
        try {

            $data = $_POST;

            $this->clientService->createClient($data);

            http_response_code(201);
            echo json_encode(['message' => 'Cliente cadastrado com sucesso.']);

        } catch(\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $client = $this->clientService->getClientByIdWithAddresses($id);
        Renderer::render('clients/edit', ['client' => $client, 'adminName' => $this->adminName]);
    }

    public function update($id)
    {
        try {

            $input = file_get_contents('php://input');

            $data = [];

            parse_str($input, $data);

            $this->clientService->updateClient($id, $data);

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

            $this->clientService->deleteClient($id);

            http_response_code(204);

        } catch(\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
