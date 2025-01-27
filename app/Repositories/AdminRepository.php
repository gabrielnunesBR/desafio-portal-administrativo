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
        return $this->db->fetchAll("SELECT id, nome, email FROM admins");
    }

    public function findById($id)
    {
        $query = "SELECT id, nome, email FROM admins WHERE id = :id";
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
            VALUES (:nome, :email, :senha, NOW(), NOW())",
            $data
        );
    }

    public function update($id, array $data)
    {
        $fields = "nome = :nome, email = :email, updated_at = NOW()";

        $params = [
            'nome'  => $data['nome'],
            'email' => $data['email'],
            'id'    => $id
        ];
    
        if (!empty($data['senha'])) {
            $fields         .= ", senha = :senha";
            $params['senha'] = $data['senha'];
        }
    
        $query = "UPDATE admins SET $fields WHERE id = :id";

        return $this->db->execute($query, $params);
    }

    public function delete($id)
    {
        return $this->db->execute(
            "DELETE FROM admins WHERE id = :id",
            ['id' => $id]
        );
    }
}
