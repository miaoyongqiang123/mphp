<?php
//这是view类
namespace houdunwang\view;
class View
{
	public function __call ( $name , $arguments )
	{
		//中转方法
		return self::runParse ($name,$arguments);

	}

	public static function __callStatic ( $name , $arguments )
	{
		//中转方法
		return self::runParse ($name,$arguments);

	}

	public static  function runParse ( $name , $argument )
	{
		//echo "我是view类<hr>";
		//实例化Base类
		//$argument是一个数组
		//(new Base())->make ();
		return call_user_func_array ( [ new Base() , $name ] , $argument );
		//return call_user_func_array ( [ new Base() ,  'make'] , $argument );
	//
	}
}