<?php

namespace App\Services;

use App\Interfaces\ExternalAuthInterface;
use External\Baz\Auth\Authenticator;
use External\Baz\Auth\Responses\Success;

class BazAuthService implements ExternalAuthInterface
{
    public const LOGIN_PREFIX = 'BAZ_';

    private $authService;

    public function __construct(Authenticator $authService)
    {
        $this->authService = $authService;
    }

    public function login(string $login, string $password): bool
    {
        return $this->authService->auth($login, $password) instanceof Success;
    }
}
