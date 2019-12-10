<?php


namespace Justmd5\Taobao;


use Hanson\Foundation\Foundation;

class Taobao extends Foundation
{

    public function request($method, $params)
    {
        $session = $params['session']??$this->getConfig('session');
        $api     = new Api(
            $this->getConfig('key'),
            $this->getConfig('secret'),
            $session
        );

        return $api->request($method, $params);
    }

}