# LeanCloud

基于 [LeanCloud-SDK-PHP](https://leancloud.cn/docs/sdk_setup-php.html) 封装

__采用链式操作__

## 安装

```sh
composer require dzlzh/leancloud
```

## 初始化

```php
require_once 'vendor/autoload.php';
require_once 'config.php';

use \leancloud\leancloud;
$leancloud = new leancloud($config);
```

## 增加数据

```php
$data = array(
    'name' => 'xiaoming',
    'age'  => 24,
    'sex'  => 'man',
);
$id = $leancloud->build('test')->set($data)->save();
var_dump($id);
```

## 更新数据

```php
$newData = array(
    'age' => 30,
);

$leancloud->build('test', $id)->set($newData)->save();
```

## 删除数据

```php
$leancloud->build('test', $id)->destroy();
```

## 获取数据

```php
$newData = $leancloud->build('test', $id)->get();
var_dump($newData->get('name'));
var_dump($newData->get('age'));
var_dump($newData->get('sex'));
```

## 查询数据

```php
$sql = 'SELECT * FROM test WHERE age=30';
$data = $leancloud->query($sql);
var_dump($data);
foreach ($data as $value) {
    var_dump($value->getObjectId());
    var_dump($value->get('name'));
    var_dump($value->get('age'));
    var_dump($value->get('sex'));
    var_dump($value->getCreatedAt());
    var_dump($value->getUpdatedAt());
}
```

