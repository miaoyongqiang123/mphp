<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/7
 * Time: 16:08
 */

/**
 * 这个页面处理变量和模板
 */
namespace houdunwang\view;
class Base
{
	private $data=[];//存储变量
	private $file='';//存储模板文件路径
	/**
	 * 分配变量
	 * @param $var变量
	 */
	public function with($var=[]){
		//echo '我是with';
		//接收变量
		$this->data=$var;
		//返回（下一步make方法）
		//p ($this->data);
		//p (extract ($this->data));
		//返回class Base这个对象
		return $this;
	}

	/**
	 *
	 * 显示模板文件
	 */
	public function make ()
	{
		//echo '我是make类';
		//include '../app/home/view/index/index.php';
		$this->file='../app/home/view/index/index.php';
		//返回class Base这个对象
		return $this;
	}

	/**
	 * 变量模板在这里合并
	 * @return string
	 */
	public function __toString ()
	{
		// TODO: Implement __toString() method.
		//p ($this->data);
		//处理出来的变量
		extract ($this->data);
		if ($this->file){
			include $this->file;
		}
		//返回值
		return '';

	}

	public function index ()
	{
		echo 'Base类';
	}
}