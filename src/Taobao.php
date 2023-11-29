<?php


namespace Justmd5\Taobao;


use Exception;

class Taobao
{
    protected $key;
    protected $secret;
    protected $session;
    public function __construct(...$params)
    {
        if (!is_array($params[0])) {
            $key = $params[0];
            $secret = $params[1];
            $session = $params[2] ?? null;
        } else {
            $key = $params[0]['key'];
            $secret = $params[0]['secret'];
            $session = $params[0]['session'] ?? null;
        }
        if (empty($key) || empty($secret)) {
            throw new Exception('key or secret is empty');
        }
        $this->key = $key;
        $this->secret = $secret;
        $this->session = $session;
    }

    public function request($method, $params): array
    {
        $api = new Api(
            $this->key,
            $this->secret,
            $this->session
        );

        return $api->request($method, $params);
    }

}