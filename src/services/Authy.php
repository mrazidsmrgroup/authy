<?php

namespace Dsmr\Authy\Services;

use GuzzleHttp\Client;

class Authy
{
    /**
     * @param array $input example: ['email' => 'new_user@gmail.com', 'cellphone' => '12345-455-6789', 'country_code' => 97]
     */
    public static function register(array $input, $hydrate = false)
    {
        $data = [
            'query' => [
                'user' => [
                    "email"                     => $input['email'],
                    "cellphone"                 => $input['cellphone'],
                    "country_code"              => $input['country_code'],
                    "send_install_link_via_sms" => true,
                ]
            ]
        ];

        $client = [
            'base_uri'      => config('authy.authy_api_url'),
            'headers'       => [
                'Content-type' => 'application/json',
                'X-Authy-API-Key' => config('authy.authy_api_key')
            ],
            'http_errors'   => false
        ];

        $rest = new Client($client);

        $response = $rest->post('protected/json/users/new', $data);

        $response = json_decode($response->getBody(), $hydrate);

        return $response;
    }

    /**
     * @param int $authyId example: 123456
     */
    public static function requestSms($authyId, $hydrate = false)
    {
        $client = [
            'base_uri'      => config('authy.authy_api_url'),
            'headers'       => [
                'Content-type' => 'application/json',
                'X-Authy-API-Key' => config('authy.authy_api_key')
            ],
            'http_errors'   => false
        ];

        $rest = new Client($client);

        $response = $rest->get(config('authy.authy_api_url') . "/protected/json/sms/{$authyId}");

        $response = json_decode($response->getBody(), $hydrate);

        return $response;
    }

    /**
     * @param array $input example: ['token' => 'token-string', 'authyId' => 123456]
     */
    public static function verifyToken(array $input, $hydrate = false)
    {
        $client = [
            'base_uri'      => config('authy.authy_api_url'),
            'headers'       => [
                'Content-type' => 'application/json',
                'X-Authy-API-Key' => config('authy.authy_api_key')
            ],
            'http_errors'   => false
        ];

        $token = urlencode($input['token']);
        $authyId = urlencode($input['authyId']);

        (new self)->__validateVerify($token, $authyId);

        $rest = new Client($client);

        $response = $rest->get(config('authy.authy_api_url') . "/protected/json/verify/{$token}/{$authyId}");

        $response = json_decode($response->getBody(), $hydrate);

        return $response;
    }

    private function __validateVerify($token, $authy_id)
    {
        $this->__validate_digit($token, "Invalid Token. Only digits accepted.");
        $this->__validate_digit($authy_id, "Invalid Authy id. Only digits accepted.");
        $length = strlen((string)$token);
        if ($length < 6 or $length > 10) {
            throw new \Exception("Invalid Token. Unexpected length.");
        }
    }

    private function __validate_digit($var, $message)
    {
        if (!is_int($var) && !is_numeric($var)) {
            throw new \Exception($message);
        }
    }
}
