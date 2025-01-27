<?php

namespace App\Validators;

use Exception;

class AdminValidator
{
    public static function validate(array $data, bool $ignorarSenha = false)
    {
        $errors = [];

        if (empty($data['nome'])) {
            $errors[] = "O campo 'Nome' é obrigatório.";
        }

        if (empty($data['email'])) {
            $errors[] = "O campo 'E-mail' é obrigatório.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "O campo 'E-mail' não é válido.";
        }

        if (empty($data['senha']) && !$ignorarSenha) {
            $errors[] = "O campo 'Senha' é obrigatório.";
        }

        if (!empty($data['senha']) && !$ignorarSenha && strlen($data['senha']) < 6) {
            $errors[] = "O campo 'Senha' deve ter no mínimo 6 caracteres.";
        }

        if (!empty($errors)) {
            throw new Exception(implode(" ", $errors));
        }

        return true;
    }
}
