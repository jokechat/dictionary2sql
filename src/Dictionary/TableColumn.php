<?php
namespace Dictionary;

class TableColumn
{
    // 列名
    private $col_name ;

    // 列类型
    private $data_type ;

    // 列定义
    private $data_definition;

    // 主键
    private $primary_key ;

    private $data ;

    public function __construct(&$data)
    {
        $this->col_name     = '`'.$data['name'] .'`';

        $decimals   = 0;
        if(isset($data['decimals'])){
            $decimals   = $data['decimals'];
        }
        $dataTYpe           = new DataType($data['type'], $data['length'],$decimals);
        $this->data_type    = $dataTYpe->getDataType();

        unset($data['type']);
        unset($data['length']);
        unset($data['decimals']);
        $this->data = $data;
    }


    // 获取列定义语句
    public function getColumnDefinition()
    {
        $properties  = new Properties();
        foreach($this->data as $k => $v)
        {
            if($k == "primary_key"){
                $this->primary_key .= $this->data['name'] . ",";
                unset($this->data['name']);
            }
            $properties->add($k,$v);
        }

        $this->data_definition = $this->col_name . " " . $this->data_type . " " . $properties->render();
        return $this->data_definition;
    }

    //获取主键key
    public function getPrimaryKey()
    {
        return $this->primary_key;
    }

}