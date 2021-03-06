<?php
include_once realpath(__DIR__.'/../').'/CO_DB_Result.php';

// ------------------------------------------------------------------------

/**
 * mysql数据库结果类
 *
 * CO框架核心
 *
 * 继承自CO_DB_Result基类
 *
 * 扩展实现mysql数据库的相应接口
 *
 * @package	comnide(CO)
 * @author B.I.T.
 * @copyright Copyright (c) 2016-2017, B.I.T.
 * @license
 * @link
 * @version v.1.19
 */
class CO_DB_mysql_result extends CO_DB_Result{
	
	/**
	 * 构造函数
	 * @param	object $result mysql结果资源对象
	 */
	function __construct($result){
		parent::__construct($result);
		if(!is_bool($result)){
			$rows = array();
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				array_push($rows , $row);
			}
			if(count($rows)){
				$this->_result = $rows;
				$this->_result_num = count($rows);
			}
			mysql_free_result($result);
		}else{
			$this->_result = $result;
			$this->_result_num = 1;
		}
	}
	
	/**
	 * 获取指定偏移量的数据
	 * 
	 * @param	int $index 偏移量
	 * @return	array 数据数组
	 */
	protected function _getNthData($index){
		if(!$this->_result || !isset($this->_result[$index])) return false;
		return $this->_result[$index];
	}
	
	/**
	 * 返回所有结果集的数据数组
	 * 
	 * @return	mixed 结果集为空则返回null,否则返回数组array
	 */
	public function getData(){
		return is_null($this->_result)?false:$this->_result;
	}
}