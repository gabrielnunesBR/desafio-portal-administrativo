<?php

namespace App\Validators;

use Exception;

class ClientValidator
{
    public static function validate(array $data)
    {
        $errors = [];

        if (empty($data['nome'])) {
            $errors[] = "O campo 'Nome' é obrigatório.";
        }

        if (empty($data['data_nascimento']) || !self::isValidDate($data['data_nascimento'])) {
            $errors[] = "O campo 'Data de Nascimento' é obrigatório e deve ser uma data válida no formato YYYY-MM-DD.";
        }

        if (empty($data['cpf']) || !self::isValidCPF($data['cpf'])) {
            $errors[] = "O campo 'CPF' é obrigatório, deve conter 11 dígitos.";
        }

        if (empty($data['rg'])) {
            $errors[] = "O campo 'RG' é obrigatório.";
        }

        if (strlen($data['rg']) > 20) {
            $errors[] = "O campo 'RG' não pode ter mais de 20 caracteres.";
        }

        if (empty($data['telefone'])) {
            $errors[] = "O campo 'Telefone' é obrigatório.";
        }

        if (strlen(preg_replace('/\D/', '', $data['telefone'])) !== 11) {
            $errors[] = "O campo 'Telefone' deve conter 11 dígitos.";
        }

        if (!empty($errors)) {
            throw new Exception(implode(" ", $errors));
        }

        return true;
    }

    private static function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    private static function isValidCPF($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verifica se possui 11 dígitos e se não são todos iguais (ex: 000.000.000-00)
        if (!preg_match('/^\d{11}$/', $cpf) || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        return true;
    }
}
