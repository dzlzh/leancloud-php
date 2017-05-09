<?php
/**
 *  +--------------------------------------------------------------
 *  | Copyright (c) 2017 DZLZH All rights reserved.
 *  +--------------------------------------------------------------
 *  | Author: DZLZH <dzlzh@null.net>
 *  +--------------------------------------------------------------
 *  | Filename: leancloud.php
 *  +--------------------------------------------------------------
 *  | Last modified: 2017-05-06 17:12
 *  +--------------------------------------------------------------
 *  | Description: 
 *  +--------------------------------------------------------------
 */

namespace leancloud;

use \LeanCloud\Client;
use \LeanCloud\Query;

class leancloud
{

    public $object = '';

    //是否开启调试
    private $debug = false;

    /**
     * 初始化
     */
    public function __construct($config)
    {
        Client::initialize($config['appId'], $config['appKey'], $config['masterKey']);

        //是否开启调试
        $this->debug = isset($config['debug']) ? $config['debug'] : $this->debug;
        Client::setDebug($this->debug);
    }

    /**
     * 构建 Object
     */
    public function build($object, $objectId = null)
    {
        $this->object = Object::create($object, $objectId);
        return $this;
    }

    /**
     * 设置 Object 属性
     */
    public function set($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->object->set($key, $value);
            }
        }
        return $this;
    }
    

    /**
     * 保存 Object
     */
    public function save()
    {
        try {
            $this->object->save();
            return $this->object->getObjectId();
        } catch (CloudException $e) {
            if ($this->debug) {
                echo $e;
            }
            return false;
        }
    }

    /**
     * 获取 Object
     */
    public function get()
    {
        $this->object->fetch();
        return $this->object;
    }

    /**
     * 更新 Object
     */
    public function update()
    {
        return $this;
    }

    /**
     * 删除 Object
     */
    public function destroy()
    {
        $this->object->destroy();
    }

    /**
     * 执行 CQL
     */
    public function query($sql)
    {
        try {
            $result = Query::doCloudQuery($sql);
            return $result['results'];
        } catch (CloudException $e) {
            if ($this->debug) {
                echo $e;
            }
            return false;
        }
    }
}
