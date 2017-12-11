<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/5
 * Time: 14:47
 */

//命名空间（用反斜杠）
namespace houdunwang\core;

use app\home\controller\Article;
use app\home\controller\Index;

/**
 * Class Boot
 * 启动类文件
 *
 */
class  Boot
{
	//    把函数定义为静态函数，一次加载就可以
	public static function run ()
	{
		//错误提示
		//self::handle ();
		//        1.测试打印是否能成功显示
		//        echo  'run';
		//        2.加载助手函数库
		//            将助手函数放在system文件下
		//        在composer.josn中添加files元素"files":["system/helper.php"],
		//            修改好composer配置文件后，助手函数就可以正常加载
		//                p(12);//打印成功
		//            3.执行初始化动作
		self::init ();
		//           4.执行应用(运行app里面的类库)
		//       修改composer配置文件，app增加到psr-4里面，然后执行composer dump
		//       (new Index())->index ();
		//       这里创建app/home/controller，创建两个类
		//       这里创建app/member/controller，创建1个类
		//      用来作测试用
		//      (new \app\home\controller\Index())->index ();
		//      (new \app\home\controller\Article())->index ();
		//       (new \app\member\controller\Article())->index ();
		//        修改完成后，使用use加载
		//        (new Index())->index();//首页加载成功
		//        (new controller())->message('你好，世界');
		//        (new controller())->add();
		//        (new controller())->add();
		//        (new article())->add();
		//        (new Index())->add();

		//        通过get参数来控制要访问的模块、控制器、方法：？c=Index&a=index&m=home
		//        m是模块，c是控制器类，a是方法
		//        把要访问的get参数地址用一个参数表示
		//        ?s=home/index/index(?s=模块/控制器类/方法）
		if ( isset( $_GET[ 's' ] ) ) {
			//            p($_GET['s']);die;
			//            打印结果home/index/index
			//            定义一个变量接GET参数
			$s = $_GET[ 's' ];
			//            将$s转化为一个数组
			$info = explode ( '/' , $s );
			//            p($info);die;
			//            打印结果Array
			//            (
			//                [0] => home
			//                [1] => index
			//               [2] => index
			// )
			//            拆分数组
			$m = $info[ 0 ];//模块
			$c = ucfirst ( $info[ 1 ] );//控制器类,首字母大写
			$a = $info[ 2 ];//方法
		} else {
			//            如果没有默认参数，就给个默认值
			$m = 'home';
			$c = 'Index';
			$a = 'index';
		}
		//定义define常量，方便后面使用，define常量可以全局使用
		define ( 'MODULE' , $m );
		define ( 'CONTROLLER' , $c );
		define ( 'ACTION' , $a );
		$controller = "\app\\{$m}\\controller\\{$c}";
		//实例化类
		//        (new $controller)->$a;
		//        使用call_user_func_array()函数实例化类
		echo call_user_func_array ( [ new $controller , $a ] , [] );
	}

	/**
	 * 错误提醒
	 */
public static function handle(){
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

}

	/**
	 * 初始化框架
	 */
	public static function init ()
	{
		//1.设置头部
		header ( 'content-type:text/html;charset:utf8' );
		//        2.设置时区(注意：时区可以当做变量提取出来）
		date_default_timezone_set ( 'PRC' );
		//       3.开启session
		//        短路写法，如果有session_id()存在，说明session开启过了
		//        如果session_id()不存在，再开启session
		//        重复开启会报错
		session_id () || session_start ();
		//        初始化完成

	}
}





