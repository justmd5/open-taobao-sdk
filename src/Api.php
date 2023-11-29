<?php


namespace Justmd5\Taobao;



use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;

class Api
{

    const URL = 'https://gw.api.taobao.com/router/rest';

    protected $key;

    protected $secret;
    /**
     * @var null|string
     */
    protected $session;

    public function __construct($key, $secret, $session = null)
    {
        $this->key     = $key;
        $this->secret  = $secret;
        $this->session = $session;
    }

    private function signature($params): string
    {
        ksort($params);

        $sign = $this->secret;
        foreach ($params as $k => $v) {
            if (!is_array($v) && '@' != substr($v, 0, 1)) {
                $sign .= "$k$v";
            }
        }

        $sign .= $this->secret;

        return strtoupper(md5($sign));
    }

    public function request($method, $params): array
    {
        $params['app_key']     = $this->key;
        $params['v']           = '2.0';
        $params['format']      = 'json';
        $params['sign_method'] = 'md5';
        $params['method']      = $method;
        $params['timestamp']   = date('Y-m-d H:i:s');
        if (empty($params['session']) && $this->session) {
            $params['session'] = $this->session;
        }
        $params['sign'] = $this->signature($params);
        /**
         * @var $http PendingRequest
         */
        $http = new HttpFactory();
        $response       = $http->asForm()->post(self::URL, $params);

        return $response->json();
    }

}