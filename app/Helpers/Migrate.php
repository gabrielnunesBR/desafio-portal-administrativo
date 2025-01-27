<?php

namespace App\Helpers;

class Migrate
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function run()
    {
        $migrationFiles = glob(dirname(__DIR__) . '/Migrations/*.sql');

        foreach ($migrationFiles as $migrationFile) {
            $this->runMigration($migrationFile);
        }
    }

    private function runMigration($migrationFile)
    {
        echo "Executando migração: $migrationFile\n";
        $sql = file_get_contents($migrationFile);

        try {
            $this->db->execute($sql); // Executa o SQL no banco
            echo "Migração executada com sucesso: $migrationFile\n";
        } catch (\PDOException $e) {
            echo "Erro ao executar migração: $migrationFile - " . $e->getMessage() . "\n";
        }
    }
}
