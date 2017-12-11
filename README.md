# mphp
## 创建一个自己的框架

  * 文件目录
  ```
    app
    
    houdunwang
    
    public
    
    system
    
  ```
  * 目录内容
    ### 构建框架文件以及目录(目录名全部小写规范)
    ```
    |--app（开发者写代码的地方）
    |    |--home（前台模块）
    |    |    |--controller(控制器类)
    |    |    |--view(视图)
    |--houdunwang（系统核心）
    |    |--core
    |    |--model
    |    |--view
    |--public(入口、静态资源)
    |    |--static(静态资源)
    |    |--view（公共模板文件）
    |--system(配置)
    |    |--config (配置项)
    |    |--model （处理业务的各种模型类）
    

  
  app 应用处理类
    controller 控制器基类
  houdunwang  核心函数库
  public 框架入口类
  system 配置项管理
  