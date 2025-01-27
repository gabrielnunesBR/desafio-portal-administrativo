<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Contracts\AuthInterface;
use App\Factories\DatabaseFactory;
use App\Repositories\AdminRepository;

require_once dirname(__DIR__) . '/Utils/helpers.php';
loadEnv(dirname(dirname(__DIR__)) . '/.env');

class AuthJWT implements AuthInterface
{
    private $secretKey;
    private $issuedAt;
    private $expirationTime;
    private $adminService;

    public function __construct()
    {
        $this->secretKey      = getenv('JWT_SECRET_KEY');
        $this->issuedAt       = time();
        $this->expirationTime = $this->issuedAt + getenv('JWT_EXPIRATION', 3600);
    }

    public function login(string $email, string $password): ?string
    {
        try {

            $config = include dirname(dirname(__DIR__)) . '/config/config.php';

            $db = DatabaseFactory::create($config['db']);

            $this->adminService = new AdminService(new AdminRepository($db));

            $admin = $this->adminService->getAdminByEmail($email);

            if ($admin && password_verify($password, $admin['senha'])) {
                return $this->generateToken($admin['id']);
            }

            return null;
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function generateToken(int $adminId): string
    {
        try {

            $payload = [
                'iat' => $this->issuedAt,
                'exp' => $this->expirationTime,
                'sub' => $adminId,
            ];
    
            return JWT::encode($payload, $this->secretKey, 'HS256');

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function authenticate(string $token): bool
    {

        if ($token) {

            try {

                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

                return isset($decoded->exp) && $decoded->exp > time();
            } catch (\Exception $e) {
                return false;
            }
        }

        return false;
    }

    public function getLoggedInAdminName(): ?string
    {
        try {

            $token = $_SESSION['access_token'];

            if ($token) {
                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

                if (isset($decoded->sub)) {
                    $adminId = $decoded->sub;
    
                    $config = include dirname(dirname(__DIR__)) . '/config/config.php';
    
                    $db = DatabaseFactory::create($config['db']);
    
                    $this->adminService = new AdminService(new AdminRepository($db));
    
                    $admin = $this->adminService->getAdminById($adminId);
    
                    return $admin['nome'] ?? null;
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }
}
