<?php

namespace App\Services;

use App\Repositories\AdminRepository;

class AdminService
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAllAdmins()
    {
        return $this->adminRepository->findAll();
    }

    public function getAdminById($id)
    {
        return $this->adminRepository->findById($id);
    }

    public function getAdminByEmail($email)
    {
        return $this->adminRepository->findByEmail($email);
    }

    public function createAdmin(array $data)
    {
        return $this->adminRepository->create($data);
    }

    public function updateAdmin($id, array $data)
    {
        return $this->adminRepository->update($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->adminRepository->delete($id);
    }
}
