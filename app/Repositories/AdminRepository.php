<?php

namespace App\Repositories;

use App\Contracts\DatabaseInterface;

class AdminRepository
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        return $this->db->fetchAll("SELECT * FROM admins");
    }

    public function findById($id)
    {
        $query = "SELECT * FROM admins WHERE id = :id";
        $stmt  = $this->db->query($query, ['id' => $id]);
        
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM admins WHERE email = :email";
        $stmt  = $this->db->query($query, ['email' => $email]);
        
        return $stmt->fetch();
    }

    public function create(array $data)
    {
        return $this->db->execute(
            "INSERT INTO admins (nome, email, senha, created_at, updated_at) 
            VALUES (:name, :email, :password, NOW(), NOW())",
            $data
        );
    }

    public function update($id, array $data)
    {
        return $this->db->execute(
            "UPDATE admins 
            SET nome = :name, email = :email, senha = :password, updated_at = NOW() 
            WHERE id = :id",
            array_merge($data, ['id' => $id])
        );
    }

    public function delete($id)
    {
        return $this->db->execute(
            "DELETE FROM admins WHERE id = :id",
            ['id' => $id]
        );
    }
}
