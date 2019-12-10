<?php


namespace Justmd5\Taobao;


use Hanson\Foundation\Foundation;

class Taobao extends Foundation
{

    public function request($method, $params)
    {
        $api = new Api(
            $this->getConfig('key'),
            $this->getConfig('secret'),
            isset($params['session']) && !empty($params['session']) ? $params['session'] : null
        );

        return $api->request($method, $params);
    }

}