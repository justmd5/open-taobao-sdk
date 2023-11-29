# open-taobao-sdk
淘宝开放平台SDK

## 安装

```
composer require justmd5/open-taobao-sdk -vvv
```

### 使用

```php
<?php

include __DIR__.'/../vendor/autoload.php';

$taobao = new \Justmd5\Taobao\Taobao(['key' => 'your-key', 'secret' => 'your-secret','session'=>null]);

// 例子
print_r($taobao->request('taobao.areas.get', ['fields' => 'id,type,name']));

```
