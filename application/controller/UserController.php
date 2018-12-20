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
        $user = new User($this->getDb());   //继承D_Model基类的子类对象
        $name = $this->input->post('name'); //要搜索的字符串
        if($this->input->post('p')){
            $p=$this->input->post('p');// 当前页码数 默认第1页
        }else{
            $p=1;
        }
        $ppc=10;// 每页显示多少条
        $arrRet=array(); //返回给前台ajax的数组

        $data['select'] = array('student.id','name','class_id','student.status','class_name','sex');
        $data['order'] = array('student.id'=>'ASC');
        $data['where']['and'] = array('student.status'=>1,'class_id'=>array(1,2));
        $data['where']['or'] = array('student.id','name');
        // $data['where']['or2'] = array('mm'=>1,'nn'=>array(1,2));
        $data['search'] = $name;
        $data['page'] = $p;
        $data['ppc'] = $ppc;
        $data['join'] = array('class'=>array('student.class_id','class.id'),'sex'=>array('student.sex_id','sex.id'));

        $data = $user->pagination($data);
        $count = $data['data']['count'];
        // var_dump($data);die;
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
