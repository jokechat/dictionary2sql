<?php
namespace Dictionary;
class Table
{
    public $columns;

    private $data;

    private $row;

    // 表名称
    private $tableName ="myTable";

    // 表主键
    private $primary_key ;

    // 表编码设置
    private $charset = "utf8";

    // 数据库存储引擎
    private $engine = "InnoDB";

    private $comment = "表注释";

    /**
     * Initializes the table
     * @return static
     */
    public static function instance()
    {
        return new static();
    }

    // 设置数据
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setTableName($name)
    {
        $this->tableName = $name;
        return $this;
    }

    // 设置编码
    public function setCharset($charset = "utf8")
    {
        $this->charset = $charset;
        return $this;
    }

    // 设置数据库存储引擎
    public function setEngine($engine = "InnoDB")
    {
        $this->engine = $engine;
        return $this;
    }

    // 设置表注释内容
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }



    public function render()
    {
        if(count($this->data))
        {
            foreach($this->data as $column)
            {
                $column     = new TableColumn($column);
                $this->row[] = $column->getColumnDefinition();

               if($column->getPrimaryKey()){
                   $this->primary_key .= $column->getPrimaryKey();
               }
            }

            // 此处渲染 创建table 语句
            $this->row = implode(",",$this->row);
            $this->primary_key = rtrim($this->primary_key,',');

            $create_table = "CREATE TABLE `{table_name}` ({table_row}, PRIMARY KEY ({primary_key}) ) ENGINE={engine} DEFAULT CHARSET={charset}  COMMENT ='{table_comment}';";

            $create_table = str_replace("{table_name}",$this->tableName,$create_table);
            $create_table = str_replace("{table_row}",$this->row,$create_table);
            $create_table = str_replace("{primary_key}", $this->primary_key,$create_table);
            $create_table = str_replace("{engine}",$this->engine,$create_table);
            $create_table = str_replace("{charset}",$this->charset,$create_table);
            $create_table = str_replace("{table_comment}",$this->comment,$create_table);


           return $create_table;

        }
    }

}