<?php
/**
 * D_Model.php.
 */
/**
 * 模型层基类.
 *
 * @author B.I.T.
 * @copyright Copyright (c) 2018-2019, B.I.T.
 * @license
 *
 * @see 新增left join
 *
 * @version v.2.1
 */
class D_Model
{
    protected $table = '';
    protected $formData = array();
    public $key='';

    public function __construct($db)
    {
        $this->db = $db;
        $this->init();
    }

    public function _add($data)
    {
        $data = $this->_parseData($data);
        if ($data) {
            return $this->db->insert($this->table, $data);
        }
        return false;

    }

    public function _select($where=array(), $param=array())
    {
        $where = $this->_parseData($where);
        return $this->db->select($this->table, $where, $param);

        // if ($where) {
            
        // }
        // return false;

    }
    public function _delete($where, $param=array())
    {
        $where = $this->_parseData($where);
        if ($where) {
            return $this->db->delete($this->table, $where,$param);
        }
        return false;

    }
    public function _update($where,$data, $param=array())
    {
        $data = $this->_parseData($data);
        if ($where) {
            return $this->db->update($this->table, $where, $data,$param);
        }
        return false;
    }

    /**
     * 过滤一下字段.
     *
     * @param [type] $data
     */
    protected function _parseData($data)
    {
        $ret = array();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (in_array($key, $this->formData)) {
                    $ret[$key] = $value;
                }
            }

            return $ret;
        } else {
            return false;
        }
    }
    /**
     * 分页查询,可联合查询,也可以创建视图
     *
     * @param array $param['where']  array("id"=>"12");
     * @param integer $param['page'] 要查询的页数
     * @param array $param['order']  排序规则 array("title"=>"desc")
     * @param array $param['search'] 要模糊查询的字段 array("title"=>"adsf")
     * @param integer $param['ppc']  每页显示的数据条数
     * @param array $param['select'] 查询的字段 array("id","title")
     * @param array $param['join']   左连接 array('class'=>array('student.class_id','class.id'),'sex'=>array('student.sex_id','sex.id'))
     * @return array  里面有status msg data
     */
    public function pagination($param)
    {
        if ((int)$param['page']<=0) {
            $ret['status']="error";
            $ret['msg']="页数最小是1";
            return $ret;
        }
        $sql="";
        if($this->key){
            $cSql="SELECT count(".$this->key.") as count FROM ".$this->table;
        }else{
            $cSql="SELECT count(id) as count FROM ".$this->table;
        }
        if (is_array($param['select'])&&!empty($param['select'])) {
            $stmp=array();
            foreach ($param['select'] as $key => $value) {
                $stmp[]=$value;
            }
            $sql.="SELECT ".implode(",", $stmp)." FROM ".$this->table;
        } else {
            $sql.="SELECT * FROM ".$this->table;
        }
           
        if (is_array($param['join'])&&!empty($param['join'])) {
            $joinSql = array(); 
            foreach ($param['join'] as $key => $value) {
                array_push($joinSql, " LEFT JOIN {$key} ON {$value[0]} = {$value[1]} ");
            }
            $sql.=implode(" ", $joinSql);
            $cSql.=implode(" ", $joinSql);
        }
        $tmp=array();
        if (is_array($param['where'])&&!empty($param['where'])) {
            $sql.=" WHERE ";
            $cSql.=" WHERE ";
            foreach ($param['where'] as $key => $value) {
                if ($value) {
                    $tmp[]=$key." = '".$value."'";
                }
            }
        }
        if (is_array($param['search'])&&!empty($param['search'])) {
            foreach ($param['search'] as $key => $value) {
                if ($value) {
                    $tmp[]=$key." LIKE '%".$value."%'";
                }
            }
        }
        $sql.=implode(" AND ", $tmp);
        $cSql.=implode(" AND ", $tmp);
        if (is_array($param['order'])&&!empty($param['order'])) {
            $sql.=" ORDER BY ";
            $tmp=array();
            foreach ($param['order'] as $key => $value)
            {
                if($value){
                    $tmp[]=$key." ".$value."";
                }
            }
            $sql.=implode(" , ", $tmp);
        }
        $countData=$this->db->query($cSql);
        $count=0;
        if (is_array($countData)&&count($countData)==1) {
            $count=(int)$countData[0]['count'];
        } else {
            $ret['status']="error";
            $ret['msg']="查询总数错误";
            return $ret;
        }
        $max=ceil($count/$param['ppc']);
        if ($param['page']>$max) {
            $param['page']=$max;
        }
        if($param['page']<1){
            $param['page']=1;
        }
        $start=($param['page']-1)*$param['ppc'];
        $sql.=" LIMIT ".$start.",".$param['ppc'];
        // var_dump($sql);die;
        $data=$this->db->query($sql);
        if (is_array($data)) {
            $ret['status']="ok";
            $ret['msg']="成功";
            $ret['data']=array(
                "count"=>$count,
                "ppc"=>$param['ppc'],
                "page"=>$param['page'],
                "data"=>$data
            );
            return $ret;
        } else {
            $ret['status']="error";
            $ret['msg']="查询数据错误";
            return $ret;
        }
    }
}
