<?php

namespace App\Utils;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class token extends JWT
{
    public static $key = 'JWT_SECRET';
    public static $encryption = 'HS256';

    public function __construct($key, $encryption)
    {
        $this->key = $key;
        $this->encryption = $encryption;
    }
    public static function generate(string $userName, string $password)
    {
        $payload = [
            'iat' => time(),
            'exp' => time() + (24 * 60 * 60),
            'credentials' => [
                'employee_name' => $userName,
            ]
        ];

        $jwt_token = JWT::encode($payload, self::$key, self::$encryption);

        if (!$jwt_token) {
            return false;
        }

        return $jwt_token;
    }

    public static function validateToken($token)
    {
        try {
            if (!$token) {
                return false;
            }

            JWT::$leeway = 60;
            $decoded = JWT::decode($token, new Key(self::$key, self::$encryption));

            if (time() > $decoded->exp) {
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getDataToken($token)
    {
        $decoded = JWT::decode($token, new Key(self::$key, self::$encryption));
        return $decoded->credentials;
    }
}
