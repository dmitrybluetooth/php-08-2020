<?php

namespace App\Services;

use DateTimeImmutable;
use Lcobucci\JWT\Configuration;

class JwtService
{
    public function createToken(string $uid, string $system): string
    {
        $config = app()->make(Configuration::class);

        $now   = new DateTimeImmutable();
        $token = $config->builder()
            // Configures the id (jti claim)
            ->identifiedBy($uid)
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 hour'))
            // Configures a new claim, called "uid"
            ->withClaim('system', $system)
            // Builds a new token
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
    }
}
