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

$taobao = new \Justmd5\Taobao\Taobao(['key' => 'your-key', 'secret' => 'your-secret']);

// 例子
print_r($taobao->request('taobao.tbk.item.get', ['fields' => 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick', 'q' => '便利贴']));

```
