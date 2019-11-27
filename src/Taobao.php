<?php


namespace Justmd5\Taobao;


use Hanson\Foundation\Foundation;

class Taobao extends Foundation
{

    public function request($method, $params)
    {
        $api = new Api($this->getConfig('key'), $this->getConfig('secret'));

        return $api->request($method, $params);
    }

}