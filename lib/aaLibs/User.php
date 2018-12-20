<?php
class User extends D_Model
{
    public function init()
    {
        $this->table    = 'student';
        $this->formData = array('id','name','class_id','status');
        $this->key = $this->table.'.id';
    }
    public function datatable($get, $where)
    {
    	$data['select'] = array($this->table.'.id','name','class_id',$this->table.'.status','class_name','sex');
    	$data['sum'] = 'id';
    	$data['table'] = $this->table;
    	$data['order'] = array("1"=>$this->table.".id","2"=>"name","3"=>"class_name","4"=>"sex");
    	$data['where']['and'] = array();
    	$data['where']['or'] = array('id','name');
        $data['join'] = array('class'=>array($this->table.'.class_id','class.id'),'sex'=>array($this->table.'.sex_id','sex.id'));
    	$a = new DataTable($get, $data, $this->db);
    	return $a->output();
    }

    public function add($data){
    	return $this->_add($data);
    }

    public function delete($where)
    {
    	return $this->_delete($where);
    }

    public function select($where)
    {

    }
}
