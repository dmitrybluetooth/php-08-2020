<?php

namespace App\Interfaces;

interface ExternalAuthInterface
{
    public function login(string $login, string $password): bool;
}
