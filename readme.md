## 目录结构

```
hht-php-frame
|-App
  |-Home
    |-Conf
    |-Controller
      |-IndexController.php
    |-Model
    |-View
|-Data
|-HHTCore
  |-Common
    |-bootstrap.php
    |-function.php
  |-Controller
  |-Model
  
|-index.php
```

## 框架的规范问题

### 类文件

每个类都独立为一个文件，且命名空间至少有一个层次

### 类的方法命名

方法的名称:必须一直使用`camelCase`这种驼峰式

### 类的属性命名

PSR规范中没有做出规定，这里我们采用下划线分隔式` $under_score`

## 框架的使用方法

把你自己写的应用（程序）放在目录`App`里面。取一个项目名字，例如Admin。目录结构可以直接复制Home里面的内容。

### 访问项目的方式

```
http://localhost/index.php?a=项目名&c=控制器名&a=方法名
```

例如：

```
http://localhost/index.php?a=Home&c=Index&a=index
```

### 视图文件

放在目录：

```
App/Home/View
```

里面。

你可以在`View`文件夹里面创建任意子目录。例如我在View里面建立一个Header目录，里面放一个视图文件`index.php`。

#### 给视图文件传递变量并且显示视图

##### render方法

```php
class IndexController extends Controller {
    public function index () {
        $a = array('key1' => 'value1', 'key2' => 'value2');
        $this->render('Header/index.php', $a);
    }
}
```

那么，你就可以在`Header/index.php`视图文件中使用变量`$key1`和变量`$key2`了：

```html
<!DOCTYPE html>
<html>
<head>
	<title>Header index.php</title>
</head>
<body>
<?php echo $key1;?>
<?php echo $key2;?>
</body>
</html>
```

### Model

采用了数据访问对象模式

#### 配置数据库

例如，在`App/项目/Conf/mysql.conf.php`文件中：

```
<?php

return [
'host' => '127.0.0.1', // 主机名(可以试试换成localhost可不可以)
'dbname' => 'test', // 需要连接的数据库的名字
'username' => 'root', // 用户名
'password' => '' // 密码
];
```

#### 使用框架自带的方法

也就是使用框架核心代码`HHTCore/Model/Model.php`中的方法

##### 创建与数据表对应的Model类

假如我有一张数据表，叫作`users`：

```php
<?php

    namespace APP\Home\Model;

    use HHTCore\Model\Model;

    class UsersModel extends Model {
    	protected $tbname = 'users'; // 设置数据表的名字（必须）
    	protected $primary_key = 'id'; // 如果没有用到，可以不用设置
    }
```

##### 读取数据

假设`users`表有如下记录：

| id   | name | status |
| ---- | ---- | ------ |
| 1    | hht  | 1      |
| 2    | hjm  | 1      |
| 3    | zwx  | 1      |
| 4    | lc   | 0      |

比如说我想要查询`status`为1的记录：

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->where('status', '=', 1)->find();
    		var_dump($res);
    	}
    }
```

如果，我想要查询`id`大于2的记录：

```php
$res = $users->where('id', '>', 2)->find();
```

如果，我想要查询`id`大于2并且`id`小于4的记录：

```php
$res = $users->where('id', '>', 2)->where('id', '<', 4)->find();
```

也就是说，查询条件与查询条件默认是`AND`的关系。

##### 更新数据

更新某条记录的某个字段值：

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->where('id', '=', 1)->update(['status' => 0]);
    	}
    }
```

更新多条记录的某个字段值：

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->where('id', '>', 1)->update(['status' => 0]);
    	}
    }
```

更新某条记录的多个字段值：

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->where('id', '=', 1)->update(['status' => 0, 'name' => 'haha']);
    	}
    }
```

##### 增加一条记录

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->insert([['id', 'name', 'status'], [7, 'zg', 1]]);
             var_dump($res);
    	}
    }
```

##### 删除记录

删除id为1的记录：

```php
<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
    		$res = $users->where('id', '=', 1)->delete();
    	}
    }
```

