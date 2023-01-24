<?php

namespace App\Services;

use App\Interfaces\ExternalAuthInterface;
use External\Foo\Auth\AuthWS;
use External\Foo\Exceptions\AuthenticationFailedException;

class FooAuthService implements ExternalAuthInterface
{
    public const LOGIN_PREFIX = 'FOO_';

    private $authService;

    public function __construct(AuthWS $authService)
    {
        $this->authService = $authService;
    }

    public function login(string $login, string $password): bool
    {
        try {
            $this->authService->authenticate($login, $password);
        } catch (AuthenticationFailedException $e) {
            return false;
        }

        return true;
    }
}
