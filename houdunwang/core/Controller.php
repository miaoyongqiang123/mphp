<?php

namespace houdunwang\core;
/**
 * Class Controller
 * 公共父级类
 * 加载消息提示模板文件
 * @package houdunwang\core
 */
class  Controller
{
    private $url;

    /**
     * 友情提示函数
     * @param $msg提示消息
     */
    public function message($msg)
    {
        //加载提示消息模板文件
        p($msg);
        include '../public/view/message.php';
    }

    /**
     * 设置跳转链接
     * @param $url
     */
    public function setRedirect($url = '')
	{
		if ( $url ) {
			//    如果指定了跳转地址
			$this->url = "location.href='$url'";
			//            return $this;
		} else {
			//    如果没有指定，默认返回上一页
			$this->url = "window.history.back()";

		}
		return $this;
	}
}
//(new Controller())->message('haha');