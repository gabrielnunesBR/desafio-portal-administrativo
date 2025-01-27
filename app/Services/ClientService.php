<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Validators\AddressValidator;
use App\Validators\ClientValidator;

class ClientService
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients()
    {
        return $this->clientRepository->findAll();
    }

    public function getClientById($id)
    {
        return $this->clientRepository->findById($id);
    }

    public function getClientByIdWithAddresses($id)
    {
        return $this->clientRepository->findByIdWithAddresses($id);
    }

    public function createClient(array $data)
    {
        ClientValidator::validate($data);
        AddressValidator::validate($data);

        return $this->clientRepository->create($data);
    }

    public function updateClient($id, array $data)
    {
        ClientValidator::validate($data);
        AddressValidator::validate($data);

        return $this->clientRepository->update($id, $data);
    }

    public function deleteClient($id)
    {
        return $this->clientRepository->delete($id);
    }
}
