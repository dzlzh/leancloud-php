<?php
/**
 *  +--------------------------------------------------------------
 *  | Copyright (c) 2017 DZLZH All rights reserved.
 *  +--------------------------------------------------------------
 *  | Author: DZLZH <dzlzh@null.net>
 *  +--------------------------------------------------------------
 *  | Filename: test.php
 *  +--------------------------------------------------------------
 *  | Last modified: 2017-05-08 15:31
 *  +--------------------------------------------------------------
 *  | Description: 
 *  +--------------------------------------------------------------
 */

require_once 'vendor/autoload.php';
require_once 'config.php';

use \leancloud\leancloud;
$leancloud = new leancloud($config);

$data = array(
    'name' => 'xiaoming',
    'age'  => 24,
    'sex'  => 'man',
);
//增加数据
$id = $leancloud->build('test')->set($data)->save();
var_dump($id);

$newData = array(
    'age' => 30,
);
//更新数据
var_dump($leancloud->build('test', $id)->set($newData)->save());

//查询数据
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

//获取数据
$newData = $leancloud->build('test', $id)->get();
var_dump($newData->get('name'));
var_dump($newData->get('age'));
var_dump($newData->get('sex'));

//删除
$leancloud->build('test', $id)->destroy();
