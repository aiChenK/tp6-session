# tp6-session
tp6 session依赖注入实现，不使用中间件，更加灵活，仅需绑定即可正常使用Tp自带Session方法

## 运行环境
- PHP 7.2+
- ThinkPHP 6

## 安装方法
        composer require aichenk/tp6-session
        
## 使用
- 绑定session到app中即可
```php
// app/AppService.php 文件
public function register()
{
    // 服务注册
    $this->app->bind('session', \KaySess\Session::class);
    // ...
}
```
