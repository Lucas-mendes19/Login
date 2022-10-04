<?php

namespace Project\System\Infrastructure\Service;

use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;
use Nowakowskir\JWT\TokenEncoded;

/* 
    Documentação Token
    https://github.com/nowakowskir/php-jwt 
*/

class TokenJwt
{
    private string $code;
    private array $payload;

    public function __construct()
    {
        $this->key = 'lucas';
        $this->payload = [];
    }

    public function setCode(string $code): void
    {
        $this->key = $code;
    }

    public function setExpiration(int $expiration) :void
    {
        $this->payload['exp'] = time() + $expiration;
    }

    public function generateToken(array $payload, array $header = [ "alg" => "HS256", "typ" => "JWT" ] ): TokenEncoded
    {
        foreach ($payload as $key => $value) {
            $this->payload[$key] = $value;
        }

        $tokenDecoded = new TokenDecoded($this->payload, $header);
        $tokenEncoded = $tokenDecoded->encode($this->key, JWT::ALGORITHM_HS256);
        
        return $tokenEncoded;
    }

    public function decodeToken(string $token): array
    {
        $tokenEncoded = new TokenEncoded($token);
        $tokenEncoded->validate($this->key, JWT::ALGORITHM_HS256);

        return $tokenEncoded->decode()->getPayload();
    }
}