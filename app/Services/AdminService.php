<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Validators\AdminValidator;

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
        AdminValidator::validate($data);

        $data['senha'] = password_hash($data['senha'], PASSWORD_BCRYPT);

        return $this->adminRepository->create($data);
    }

    public function updateAdmin($id, array $data)
    {
        AdminValidator::validate($data, true);

        if (array_key_exists('senha', $data)) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_BCRYPT);
        }

        return $this->adminRepository->update($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->adminRepository->delete($id);
    }
}
