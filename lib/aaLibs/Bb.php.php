<?php
class Bb extends D_Model
{
    public function init()
    {
        $this->table    = 'mall_brand';
        $this->formData = array(
            'id',
            'brand_name',
            'brand_logo',
            'brand_desc',
            'site_url',
            'store_id',
            'status',
        );
    }
    public function datatable($get, $where)
    {
    	$data['select'] = $this->formData;
        $data['sum'] = 'id';
        $data['table'] = $this->table;
        $data['order'] = array('1'=>'brand_name','3'=>'site_url');
        $data['where']['and'] = array('status'=>1);
        $data['where']['or'] = array('brand_name');
        $data['where']['or2'] = array('store_id'=>array(0,1));
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
}
