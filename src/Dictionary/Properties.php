<?php
namespace Dictionary;

use Dictionary\Util\Dump;

class Properties
{
    private $properties;

    // 添加列属性
    public function add($property, $value)
    {
        $this->properties[$property] = $value;
        return $this;
    }

    // 列定义属性进行转换
    public function render()
    {
        $properties = $this->properties;

        $temp_result = " ";

        if(isset($properties['not_null'])){
            $temp_result .= $properties['not_null'] ? "NOT NULL " : " ";
        }

        if(isset($properties['default'])){

            $default_value = $properties['default'];
            if(!is_numeric($default_value)){
                $default_value = " '".$properties['default']."' ";
            }
            $temp_result .= $properties['default'] ? " DEFAULT ".$default_value : " ";
        }

        if(isset($properties['auto_increment'])){
            if($properties['auto_increment']){
                $temp_result .= " AUTO_INCREMENT  ";
            }
        }

        if(isset($properties['comment'])){
            $temp_result .= " COMMENT '".$properties['comment'] . "' ";
        }

        return $temp_result;
    }
}