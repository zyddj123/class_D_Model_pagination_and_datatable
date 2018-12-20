<?php

//非法访问
if (!defined('CO_BASE_CHECK')) {
    header('HTTP/1.1 404 Not Found');
    header('Status: 404 Not Found');
    exit;
}

/**
 * Goods首页_控制器.
 *
 * @author            B.I.T
 * @copyright        Copyright (c) 2018 - 2019.
 * @license
 *
 * @see
 * @since                Version 1.19
 */
// ------------------------------------------------------------------------
class UserController extends CO_Controller
{

    /**
     * 控制器初始化.
     */
    protected function _init()
    {
    }

    /**
     * 默认程序入口.
     */
    public function run()
    {
        $this->render('datatable');
    }

    public function ajax_user()
    {
        $get   = $this->input->get();
        $where = array();
        $a     = new User($this->getDb());
        echo json_encode($a->datatable($get, $where));
    }

    public function pagination()
    {
        $this->render('pagetest');
    }

    public function ajax_pagination_data()
    {
        $user = new User($this->getDb());
        $name = $this->input->post('name');
        if($this->input->post('p')){
            $p=$this->input->post('p');// 当前页码数 默认第1页
        }else{
            $p=1;
        }
        $ppc=10;// 每页显示多少条
        $start=($p-1)*$ppc;  //第几条开始查询
        $arrRet=array();

        $param['select'] = array('student.*','class_name','sex');
        $param['page'] = $p;
        $param['order'] = array('student.id'=>'ASC');
        $param['search'] = array('name'=>$name);
        $param['ppc'] = $ppc;
        // $param['where'] = array('student.status'=>1);
        $param['join'] = array('class'=>array('student.class_id','class.id'),'sex'=>array('student.sex_id','sex.id'));

        $data = $user->pagination($param);
        $count = $data['data']['count'];
        $arrRet['data']=$data['data']['data'];//数据
        $arrRet['p']=$p;//当前页
        $arrRet['ppc']=$ppc;    //每页显示数
        $arrRet['all']=$count;//总条数
        $arrRet['entries']=ceil($count/$ppc);//总页数
        echo json_encode($arrRet);
    }

    public function getThemesUrl()
    {
        return HTTP_ROOT_PATH . '/' . VIEW_THEMES_PATH_NAME . '/' . $this->getThemes();
    }
}
