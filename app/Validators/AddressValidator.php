<?php

namespace App\Validators;

use Exception;

class AddressValidator
{
    public static function validate(array $data)
    {
        $errors = [];

        if (!array_key_exists('enderecos', $data)) {
            throw new Exception("É obrigatório cadastrar pelo menos 1 endereço.");
        }

        $enderecos = $data['enderecos'];

        foreach($enderecos as $endereco) {
            if (empty($endereco['logradouro'])) {
                $errors[] = "O campo 'Logradouro' é obrigatório.";
            }

            if (empty($endereco['numero'])) {
                $errors[] = "O campo 'Número' é obrigatório.";
            }

            if (strlen($endereco['numero']) > 10) {
                $errors[] = "O campo 'Número' não pode ter mais de 10 caracteres.";
            }

            if (empty($endereco['bairro'])) {
                $errors[] = "O campo 'Bairro' é obrigatório.";
            }

            if (empty($endereco['cidade'])) {
                $errors[] = "O campo 'Cidade' é obrigatório.";
            }

            if (empty($endereco['estado']) || !preg_match('/^[A-Z]{2}$/', $endereco['estado'])) {
                $errors[] = "O campo 'Estado' é obrigatório e deve conter uma sigla válida (ex: CE, SP).";
            }

            if (empty($endereco['cep']) || !preg_match('/^\d{5}-\d{3}$/', $endereco['cep'])) {
                $errors[] = "O campo 'CEP' é obrigatório e deve conter 8 dígitos numéricos.";
            }
        }

        if (!empty($errors)) {
            throw new Exception(implode(" ", $errors));
        }

        return true;
    }
}
