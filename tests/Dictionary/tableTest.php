<?php
use Dictionary\Table;

/**
 * Created by PhpStorm.
 * User: jokechat
 * Date: 2017/7/30
 * Time: 01:43
 */

class TableTest extends PHPUnit_Framework_TestCase
{
    public function testrender()
    {

        // 一个表中 仅仅允许一个自动增长列
        $data   = [
            ['name' => 'id', 'type' => 'int', 'length' => 11, 'decimals' => 0 ,'not_null' => true, 'primary_key' => true, 'auto_increment' => true, 'comment' => '自增主键'],
            ['name' => 'cid', 'type' => 'int', 'length' => 11, 'decimals' => 0 ,'not_null' => true,  'comment' => '自增主键'],
            ['name' => 'price', 'type' => 'float', 'length' => 11, 'decimals' => 2, 'default' => 20.00,'not_null' => true,   'comment' => '价格'],
            ['name' => 'name', 'type' => 'varchar', 'length' => 11,  'default' => "张张",'not_null' => true, 'key' => false,  'comment' => '姓名']

        ];

        $table  = Table::instance();
        $result = $table->setData($data)
                        ->setCharset("utf8")
                        ->setEngine("InnoDB")
                        ->setTableName("hhhh")
                        ->setComment("这是什么样的表结构")
                        ->render();

        print_r($result);
    }
}
