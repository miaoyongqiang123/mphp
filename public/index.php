<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/5
 * Time: 13:44
 */
//单一入口文件
//通过composer来完成文件的加载
//生成vender目录 使用composer  dump命令

//1.加载autoload.php文件
require '../vendor/autoload.php';
//加载完成后并没有显示内容，需要修改配置文件
//Fatal error: Class 'houdunwang\core\boot' not found in D:\phpStudy\WWW\mphp\mphp\public\index.php on line 21
//修改composer配置文件
//手动加入autoload这一项
//autoload里有两个元素files自动加载文件
//psr-4代码规范
//修改后在项目根目录下运行composer dump命令，然后刷新页面
//修改后显示正常 显示run

//2.调用启动类中的run方法
\houdunwang\core\boot::run();


//function __autoload($name){
//    echo $name;
//    include'';
//
//}
//
//(new boot())->run();






