<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/7
 * Time: 19:16
 */

/**
 * 数据库操作类
 */

namespace houdunwang\model;

use Exception;
use PDO;

class Base
{
	private static $pdo = null;
	private        $table;//数据表
	private        $field;//要查询的字段
	private        $where;//where语句

	public function __construct ( $class )
	{
		//		//获取数据表名方式一：
		$this->table = strtolower ( ltrim ( strrchr ( $class , '\\' ) , '\\' ) );
		//获取数据表名方式二：
		//$info          = explode ( '\\' , $class );
		//$this -> table = strtolower ( $info[ 2 ] );
		//p($this->table);
		//		//p ( $class );
		//		p ( $this->table );
		//		//1.连接数据库
		if ( is_null ( self::$pdo ) ) {
			$this->connect ();
		}
		//
	}

	/**
	 * 连接数据库
	 */
	public function connect ()
	{
		try {
			//通过c函数获取数据库信息
			$dsn       = c ( 'database.driver' ) . ":host=" . c ( 'database.host' ) . ";dbname=" .
						 c ( 'database.dbname' );
			$user      = c ( 'database.user' );
			$password  = c ( 'database.password' );
			self::$pdo = new PDO( $dsn , $user , $password );
			//字符集
			self::$pdo->query ( 'set names ' . c ( 'database.charset' ) );
			//设置错误属性
			self::$pdo->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
		} catch ( Exception $e ) {
			//抛出异常
			exit( $e->getMessage () );
		}
	}


	/**
	 * 查询表中所有数据
	 *
	 * @param string $field
	 *
	 * @return mixed
	 */
	public function getAll ( $field = '*' )
	{
		//echo 'getAll';
		//select *  from  ss;
		$sql = "select $field  from  {$this->table}";

		return $this->q ( $sql );
	}

	/**
	 * 选择主键为$pk的一条数据
	 *
	 * @param $pk 主键值
	 *
	 * @return mixed返回一个数组
	 */
	public function find ( $pk )
	{
		$priKey = $this->getPrikey ();
		//p ( $priKey );
		//$sql = 'select * from  ss  where  id=6';
		$sql = "select * from  {$this->table} where  $priKey= {$pk}";
		//$sql = "select {$this->table} from  ss  where  id=6";
		//p($pk);//6
		return current ( $this->q ( $sql ) );
		//	返回结果
		//Array
		//(
		//	[id] => 6
		//    [name] => dd
		//	[age] => 88
		//    [hobby] => 篮球
		//	[birthday] => 1996-06-25
		//    [sex] => boy
		//)
	}

	/**
	 * 获取主键的名字
	 *
	 * @return mixed主键名称
	 */
	public function getpriKey ()
	{
		$sql = "desc {$this->table}";
		//p ( $sql );
		$res = $this->q ( $sql );
		foreach ( $res as $k => $v ) {
			if ( $v[ 'key' ] = 'PRI' ) {
				$priKey = $v[ 'Field' ];
				break;
			}

		}

		return $priKey;
	}

	/**
	 * 查询一条数据
	 *
	 * @param string $field要查询的字段，默认为 *
	 *
	 * @return mixed
	 */
	public function one ( $field = '*' )
	{
		//查询一条数据
		//$sql = "select name  from ss where age=88";
		//$sql = "select {$this->field ($field)}  from {$this->table} where age=88";
		//$sql = "select *  from {$this->table} where age=88";
		//$sql = "select *  from {$this->table} {$this->where}";
		//$sql = "select *  from ss {$this->where}";
		$sql = "select $field  from {$this->table} {$this->where}";
		//p ( $sql );
		//p ( $this->q ( $sql ) );
		return current ( $this->q ( $sql ) );

	}

	/**
	 * 排序查询
	 *
	 * @param string $field字段
	 * @param string $sort升降序
	 * @param string $num限制几条
	 *
	 * @return mixed返回查询并排序后的数组
	 */
	public function orderBy ( $field = "age" , $sort = "asc" , $num = '' )
	{
		//$sql="选择  字段  来自  数据表 where语句  排序   字段  升降序   限制  几条数据";
		//$sql="select *  from  ss  where  age>20  order  by  age  desc limit  2";
		//$sql="select *  from  ss  order by  age ";
		//$sql="select age  from  ss  order by  age desc limit 2";
		//$sql="select *  from  {$this->table}";
		//	p ($field);
		//	p ($sort);
		if ( is_int ( $num ) ) {
			$lim = "limit $num";
		} else {
			$lim = '';
		}
		//p ($lim);
		//$sql="select *  from  {$this->table} order by  {$field} {$sort}";
		$sql = "select *  from  {$this->table} {$this->where} order by  {$field} {$sort} {$lim} ";
		//p ($sql);
		return $this->q ( $sql );
	}

	/**
	 * 分组查询
	 * @param $field分组的字段
	 *
	 * @return mixed
	 */
	public function groupBy ( $field )
	{
		//$res = "select  *  from  ss  group  by  sex  having  sex='boy'";
		//$res = "select  sex  from  ss  group  by  sex  ";
		//$res = "select  sex,count(*)  C  from  ss  group  by  sex  having  sex='boy'";
		//$res = "select  sex,count(*)  C  from  {$this->table}  group  by  sex  having  sex='boy'";
		//$sql = "select  {$field},count(*) C  from  {$this->table}  group  by  $field  having  sex='boy'";
		//$hav="having $field=''";
		echo '分组查询';
		$sql = "select  {$field},count(*) C  from  {$this->table}  group  by  $field ";
		//$sql = "select  *  from  {$this->table}  group  by  $field  having sex='boy'";
		//$sql = "select  sex from  {$this->table}  group  by  $field  ";
		//$sql = "select  sex  from  ss  group  by  sex  ";
		//$sql = "select  * from  ss  group  by  sex  ";
		$res = $this->q ( $sql );

		return $res ;

	}

	/**
	 * @param string $where要查询的where语句
	 *查询where语句
	 *
	 * @return $this
	 */
	public function where ( $where = 'age=88' )
	{
		$this->where = 'where ' . $where;

		//p ( $this->where );
		return $this;

	}

	/**
	 * @param string $field字段名
	 *查找指定列的字段
	 *
	 * @return mixed
	 */
	public function field ( $field = '*' )
	{
		//select * from ss;
		$this->field = $field;
		//$sql         = "select  {$this->field}  from  {$this->table}";
		//return current ( $this->q ( $sql ) );
		return;
	}

	/**
	 * 更新数据
	 *
	 * @param $data要更新的数据
	 *
	 * @return bool|mixed返回影响的条数
	 */
	public function update ( $data )
	{
		//没有where条件，不允许更新
		if ( ! $this->where ) {
			return false;
		}
		$set = '';
		//修改
		//$data = [
		//	'age'=>28,
		//	'sname'=>'王朝修改',
		//	'sex'=>'男',
		//];
		//$res = Student::where('id=1')->update($data);
		//p($res);

		//$sql = "update ss set $data {$this->where}";
		foreach ( $data as $k => $v ) {
			//如果是数就不加引号，字符串加加上引号
			if ( is_int ( $v ) ) {
				$set .= $k . '=' . $v . ',';
			} else {
				$set .= $k . '=' . "'$v'" . ',';
			}

		}
		$set = rtrim ( $set , ',' );
		$sql = "update {$this->table} set $set {$this->where}";

		//p($sql);
		return $this->e ( $sql );

	}

	/**
	 * 插入数据
	 *
	 * @param $data 要插入的数据
	 *
	 * @return mixed
	 */
	public function insert ( $data )
	{
		$field = '';
		$value = '';
		foreach ( $data as $k => $v ) {
			$field .= $k . ',';
			if ( is_int ( $v ) ) {
				$value .= $v . ',';
			} else {
				$value .= "'$v'" . ',';
			}

		}
		$field = rtrim ( $field , ',' );
		//p($field);die;
		$value = rtrim ( $value , ',' );
		//p($value);die;
		//$sql = "insert into student (name,age,sex) values ('超人',1,'男')";
		$sql = "insert into {$this->table} ({$field}) values ({$value})";

		return $this->e ( $sql );

	}

	/**
	 * 删除数据
	 *
	 * @return bool|mixed
	 */
	public function delete ()
	{
		//如果没有where条件，不允许删除
		if ( ! $this->where ) {
			return false;
		}
		//$sql = 'delete  from  ss  where id=0';
		$sql = "delete from {$this->table} {$this->where}";

		return $this->e ( $sql );
	}

	/**
	 * @param $sql命令有结果集查询select
	 *
	 *
	 * @return mixed
	 */
	public function q ( $sql )
	{
		//p ($sql);
		try {
			//执行sql命令
			$res = self::$pdo->query ( $sql );

			//将计算结果取出来并返回
			return $res->fetchAll ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			exit( $e->getMessage () );
		}
	}

	/**
	 * @param $sql无结果集操作命令
	 *insert delete updata
	 *
	 * @return mixed
	 */
	public function e ( $sql )
	{
		try {
			//返回影响的条数
			return self::$pdo->exec ( $sql );
		} catch ( Exception $e ) {
			exit( $e->getMessage () );
		}

	}


}













