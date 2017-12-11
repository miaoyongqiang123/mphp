<?php

namespace app\home\controller;

use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\Base;
use houdunwang\view\View;
use system\model\Grade;
use system\model\Ss;


class  Index extends Controller
{
	public function index ()
	{
		echo '我是首页 <hr>';
		//第一步：实例化View类，调用make方法
		//(new View())->runParse();
		//new View();
		//(new Base())->make ();
		//View::make ();//这是首页---->这是view类----->make类---->这是模板页
		//第二步：解决变量问题$argument
		$a = '你好，';
		//$b='hahah';
		$data = [ 'name' => '这是变量' , 'age' => 10 ];
		//p ($data);
		//p (compact ('data'));
		//p ( extract($data));die;
		//p ( extract(compact ('data')));die;
		//return	View::with(compact ('data','a'));die;
		//return	View::__toString(compact ('data'));die;
		//	$s=(new Controller())->setRedirect(u('home/article/add'));
		//	$s=$this->setRedirect(u('home/article/add'));
		//p ($s);
		//首页模板
		return	View::with(compact ('data','a','b'))->make();
		//第三步：封装model
		//测试数据库类
		//$data=Model::getAll();
		//p ($data);
		//$res = Model::q('select * from cc');
		//测试sql命令能不能正常运行
		//return View::make();
		//$res=Model::q('select * from  ss');
		//p ($res);
		//根据主键查询数据
		//$data=Ss::find(6);
		//查询一条数据
		//$data=Ss::one('name');
		//$data=Ss::one();
		//$data=Ss::getAll();
		//$data = Ss::field ();
		//修改数据
		$dat = [
			'age' => 18 , 'name' => '库街' , 'sex' => 'girl' ,
		];
		//$data = Ss::where("id=56")->update ($dat);
		//$data = Ss::where("name='wk'")->delete();
		//$data = Ss::where()->delete();
		//$data = Ss::insert ($dat);
		//$data = Ss::delete();
		//$data = Ss::getpriKey ();
		//查询并排序
		//$data = Ss::orderBy ("id","desc",3);
		//$data = Ss::orderBy ("id","desc");
		//$data = Ss::orderBy ("id");
		//$data = Ss::orderBy (age);
		//$data = Ss::groupBy ("sex");
		//$data = Ss::where ('age=88');
		//$data = Ss::where ('age=67')->one('name');
		//p ( $data );

		//return	View::with(compact ('data','a','b'))->make();
		//第四步：测试读取配置项数据
		//$res=c ('database');
		//$res=c ('database.driver');
		//p ($res);
		//测试结果，c函数可以正常运行
	}

	/**
	 *
	 * 添加函数
	 */
	public function add ()
	{
		//echo 1;
		//链式操作
		//$this->setRedirect ( u ( 'home/article/add' ) );
		//(new Controller())->setRedirect (u ( 'home/article/add' ));
		//$this->setRedirect (u ( 'home/article/add' ))->message('jjdjd');
		//p ( u ( 'home/article/add' ) );
		$this->setRedirect ( u ( 'article/add' ) )->message ( '添加成功' );
		//        $this->message('添加成功');
		//(new Controller())->message('haha');
		//new Controller();

	}

}




