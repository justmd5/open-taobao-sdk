<?php


namespace Justmd5\Taobao;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    const URL = 'http://gw.api.taobao.com/router/rest';

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

    private function signature($params)
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

    public function request($method, $params, $files = [])
    {
        $http = $this->getHttp();

        $params['app_key']     = $this->key;
        $params['v']           = '2.0';
        $params['format']      = 'json';
        $params['sign_method'] = 'md5';
        $params['method']      = $method;
        $params['timestamp']   = date('Y-m-d H:i:s');
        if (empty($params['session']) && !empty($this->session)) {
            $params['session'] = $this->session;
        }
        $params['sign'] = $this->signature($params);
        $response       = call_user_func_array([$http, 'post'], [self::URL, $params, $files]);

        return json_decode(strval($response->getBody()), true);
    }

}