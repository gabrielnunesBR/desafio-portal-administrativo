<?php

namespace App\Repositories;

use App\Contracts\DatabaseInterface;

class ClientRepository
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        return $this->db->fetchAll("SELECT * FROM clientes");
    }

    public function findById($id)
    {
        return $this->db->fetch("SELECT * FROM clientes WHERE id = :id", ['id' => $id]);
    }

    public function findByIdWithAddresses($id)
    {
        $sql = "
            SELECT c.*, e.id AS endereco_id, e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep
            FROM clientes c
            LEFT JOIN enderecos e ON e.cliente_id = c.id
            WHERE c.id = :id
        ";

        $result = $this->db->fetchAll($sql, ['id' => $id]);

        if (empty($result)) {
            return null;
        }

        $cliente = $result[0];

        $enderecos = [];

        foreach ($result as $row) {
            $enderecos[] = [
                'id'           => $row['endereco_id'],
                'logradouro'   => $row['logradouro'],
                'numero'       => $row['numero'],
                'complemento'  => $row['complemento'],
                'bairro'       => $row['bairro'],
                'cidade'       => $row['cidade'],
                'estado'       => $row['estado'],
                'cep'          => $row['cep'],
            ];
        }

        $cliente['enderecos'] = $enderecos;

        return $cliente;
    }

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            $data['cpf']      = preg_replace('/\D/', '', $data['cpf']);
            $data['telefone'] = preg_replace('/\D/', '', $data['telefone']);

            $this->db->execute(
                "INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone, created_at, updated_at) 
                VALUES (:name, :birth_date, :cpf, :rg, :phone, NOW(), NOW())",
                [
                    ':name'       => $data['nome'],
                    ':birth_date' => $data['data_nascimento'],
                    ':cpf'        => $data['cpf'],
                    ':rg'         => $data['rg'],
                    ':phone'      => $data['telefone'],
                ]
            );

            $clientId = $this->db->lastInsertId();

            foreach ($data['enderecos'] as $address) {

                $address['cep'] = preg_replace('/\D/', '', $address['cep']);

                $this->db->execute(
                    "INSERT INTO enderecos (cliente_id, cep, logradouro, numero, complemento, bairro, cidade, estado, created_at, updated_at) 
                    VALUES (:client_id, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, NOW(), NOW())",
                    [
                        ':client_id'   => $clientId,
                        ':cep'         => $address['cep'],
                        ':logradouro'  => $address['logradouro'],
                        ':numero'      => $address['numero'],
                        ':complemento' => $address['complemento'],
                        ':bairro'      => $address['bairro'],
                        ':cidade'      => $address['cidade'],
                        ':estado'      => $address['estado'],
                    ]
                );
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();

            throw new \Exception($e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            $this->db->beginTransaction();
    
            $data['cpf']      = preg_replace('/\D/', '', $data['cpf']);
            $data['telefone'] = preg_replace('/\D/', '', $data['telefone']);
    
            $this->db->execute(
                "UPDATE clientes SET nome = :name, data_nascimento = :birth_date, cpf = :cpf, rg = :rg, telefone = :phone, updated_at = NOW()
                WHERE id = :id",
                [
                    ':name'       => $data['nome'],
                    ':birth_date' => $data['data_nascimento'],
                    ':cpf'        => $data['cpf'],
                    ':rg'         => $data['rg'],
                    ':phone'      => $data['telefone'],
                    ':id'         => $id,
                ]
            );
    
            $this->db->execute(
                "DELETE FROM enderecos WHERE cliente_id = :id",
                [':id' => $id]
            );
    
            foreach ($data['enderecos'] as $address) {
                $address['cep'] = preg_replace('/\D/', '', $address['cep']);
    
                $this->db->execute(
                    "INSERT INTO enderecos (cliente_id, cep, logradouro, numero, complemento, bairro, cidade, estado, created_at, updated_at) 
                    VALUES (:client_id, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, NOW(), NOW())",
                    [
                        ':client_id'   => $id,
                        ':cep'         => $address['cep'],
                        ':logradouro'  => $address['logradouro'],
                        ':numero'      => $address['numero'],
                        ':complemento' => $address['complemento'],
                        ':bairro'      => $address['bairro'],
                        ':cidade'      => $address['cidade'],
                        ':estado'      => $address['estado'],
                    ]
                );
            }
    
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
    
            throw new \Exception($e->getMessage());
        }
    }    

    public function delete($id)
    {
        return $this->db->execute(
            "DELETE FROM clientes WHERE id = :id",
            ['id' => $id]
        );
    }
}
