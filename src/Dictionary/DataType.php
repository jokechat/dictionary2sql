<?php
namespace Dictionary;

class DataType
{
    private $type;

    private $length;

    private $decimals;

    public function __construct($type,$length,$decimals = 0)
    {
        $this->type     = $type;
        $this->length   = $length;
        $this->decimals = $decimals;
    }

    public function getDataType()
    {
        if($this->decimals > 0){
            $result = $this->type ."(".$this->length.",".$this->decimals.")";
        }else
        {
            $result = $this->type ."(".$this->length.")";
        }
        return $result;
    }


}