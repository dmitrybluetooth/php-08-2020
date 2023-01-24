<?php

namespace App\Services;

use App\Interfaces\ExternalAuthInterface;
use External\Bar\Auth\LoginService;

class BarAuthService implements ExternalAuthInterface
{
    public const LOGIN_PREFIX = 'BAR_';

    private $authService;

    public function __construct(LoginService $authService)
    {
        $this->authService = $authService;
    }

    public function login(string $login, string $password): bool
    {
        return $this->authService->login($login, $password);
    }
}
