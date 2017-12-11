<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/7
 * Time: 19:16
 */
namespace houdunwang\model;
/**
 * 数据库操作中间层
 * $name是方法
 * $argument是参数
 */
class Model{
	//魔术方法，找不到方法时，自动调用
	public function __call ( $name , $arguments )
	{
		return self::runParse ($name,$arguments);
	}
	public static function __callStatic ( $name , $arguments )
	{
		return self::runParse ($name,$arguments);
	}
	public static function runParse($name,$argument){
		//获取当前调用的模型的名称，因为我们要使用其作为查询的数据表名
		$class = get_called_class ();
		//p ($class);
		return call_user_func_array ([new Base($class),$name],$argument);
	}
}









